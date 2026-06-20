<?php

use Illuminate\Support\Facades\Route;

use App\Models\Product;

Route::get('/', function () {
    $bestsellers = Product::latest()->take(4)->get();
    return view('home', compact('bestsellers'));
});

// Shop / Public
Route::get('/shop', function (\Illuminate\Http\Request $request) {
    $query = App\Models\Product::query();
    $selectedCategories = $request->input('categories', []);
    
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%');
        });
    }
    
    if ($request->has('category') && !empty($request->category)) {
        $selectedCategories = array_merge($selectedCategories, (array) $request->category);
    }
    
    if (!empty($selectedCategories)) {
        $query->whereIn('category', $selectedCategories);
    }
    
    $products = $query->paginate(12)->appends($request->query());
    $categories = App\Models\Product::select('category', \DB::raw('count(*) as total'))->groupBy('category')->get();
    
    return view('shop', compact('products', 'categories', 'selectedCategories'));
})->name('shop.index');

Route::get('/categories', function () {
    $categories = \App\Models\Product::select('category')->distinct()->whereNotNull('category')->pluck('category');
    return view('categories', compact('categories'));
})->name('categories.index');

Route::get('/shop/{product}', function (Product $product) {
    return view('show', compact('product'));
})->name('shop.show');

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;

// Auth Routes (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Protected Routes (Auth)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Profil Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Keranjang & Order (Protected)
    Route::get('/checkout', function (Illuminate\Http\Request $request) {
        $user = auth()->user();
        if (empty($user->name) || empty($user->phone) || empty($user->address) || empty($user->city) || empty($user->province)) {
            return redirect()->route('profile')->withErrors('Silakan lengkapi Data Diri dan Alamat Utama Anda terlebih dahulu sebelum melakukan checkout.');
        }

        $productId = $request->query('product_id') ?? session('checkout_product_id');
        $items = [];
        
        if ($productId) {
            // Direct buy single product
            session(['checkout_product_id' => $productId]);
            $product = App\Models\Product::find($productId);
            if ($product) {
                // Wrapper object to mimic Cart relation
                $items[] = (object)[
                    'id' => 'temp',
                    'product' => $product,
                    'quantity' => 1
                ];
            }
        } else {
            // Use cart items
            session()->forget('checkout_product_id');
            $cartIds = session('checkout_cart_items', []);
            if (!empty($cartIds)) {
                $items = \App\Models\Cart::where('user_id', $user->id)->whereIn('id', $cartIds)->with('product')->get();
            } else {
                return redirect()->route('cart')->withErrors('Pilih minimal satu produk untuk melanjutkan checkout.');
            }
        }

        return view('checkout', compact('items'));
    })->name('checkout');

    Route::get('/cart/add/{product}', [CartController::class, 'store'])->name('cart.add');
    Route::post('/cart/update/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/remove/{cart}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/cart', function () {
        session()->forget('checkout_product_id');
        $items = \App\Models\Cart::where('user_id', auth()->id())->with('product')->get();
        return view('cart', compact('items'));
    })->name('cart');

    Route::post('/cart/checkout', function (\Illuminate\Http\Request $request) {
        $selected = $request->input('selected_items', []);
        if (empty($selected)) {
            return redirect()->back()->withErrors('Silakan pilih produk yang akan dicheckout.');
        }
        session(['checkout_cart_items' => $selected]);
        return redirect()->route('checkout');
    })->name('cart.checkout');

    Route::post('/checkout/process', function (\Illuminate\Http\Request $request) {
        $user = auth()->user();
        $productId = session('checkout_product_id');
        $cartIds = session('checkout_cart_items', []);
        $paymentMethod = tap($request->input('payment'), function($p) { return empty($p) ? 'qris' : $p; }) ?? 'qris';
        $transactionIds = [];
        
        if ($productId) {
            $product = \App\Models\Product::find($productId);
            if ($product) {
                $transaction = \App\Models\Transaction::create([
                    'user_id' => $user->id,
                    'invoice_number' => 'INV-' . time() . '-' . rand(1000, 9999),
                    'total_amount' => $product->price,
                    'payment_method' => $paymentMethod,
                    'status' => 'pending'
                ]);
                \App\Models\TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->price
                ]);
                $transactionIds[] = $transaction->id;
            }
            session()->forget('checkout_product_id');
        } else {
            $items = \App\Models\Cart::where('user_id', $user->id)->whereIn('id', $cartIds)->with('product')->get();
            foreach ($items as $item) {
                if ($item->product) {
                    $itemTotal = $item->product->price * $item->quantity;
                    $transaction = \App\Models\Transaction::create([
                        'user_id' => $user->id,
                        'invoice_number' => 'INV-' . time() . '-' . rand(1000, 9999),
                        'total_amount' => $itemTotal,
                        'payment_method' => $paymentMethod,
                        'status' => 'pending'
                    ]);
                    \App\Models\TransactionItem::create([
                        'transaction_id' => $transaction->id,
                        'product_id' => $item->product->id,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price
                    ]);
                    $transactionIds[] = $transaction->id;
                }
            }
            \App\Models\Cart::whereIn('id', $cartIds)->delete();
            session()->forget('checkout_cart_items');
        }

        return redirect()->route('payment.waiting', ['ids' => implode(',', $transactionIds)]);
    })->name('checkout.process');

    Route::get('/payment-waiting', function (\Illuminate\Http\Request $request) {
        $ids = explode(',', $request->query('ids', ''));
        $transactions = \App\Models\Transaction::whereIn('id', $ids)->where('user_id', auth()->id())->get();
        if ($transactions->isEmpty()) abort(403);
        $totalPrice = $transactions->sum('total_amount');
        // use the first transaction to preselect invoice/payment method for display
        $transaction = $transactions->first();
        return view('payment_waiting', compact('totalPrice', 'transaction', 'ids'));
    })->name('payment.waiting');

    Route::post('/payment-confirm', function (\Illuminate\Http\Request $request) {
        $ids = explode(',', $request->input('ids', ''));
        \App\Models\Transaction::whereIn('id', $ids)->where('user_id', auth()->id())->update(['status' => 'paid']);
        return redirect()->route('orders')->with('success', 'Pembayaran berhasil dikonfirmasi!');
    })->name('payment.confirm');

    Route::get('/orders', function (\Illuminate\Http\Request $request) {
        $status = $request->query('status', 'all');
        $query = \App\Models\Transaction::where('user_id', auth()->id())->with('items.product')->orderBy('created_at', 'desc');
        
        if ($status !== 'all') {
            if ($status === 'processing') {
                $query->whereIn('status', ['paid', 'processing']);
            } else {
                $query->where('status', $status);
            }
        }
        
        $orders = $query->get();
        return view('orders', compact('orders', 'status'));
    })->name('orders');

    Route::put('/orders/{transaction}/complete', function (\App\Models\Transaction $transaction) {
        if ($transaction->user_id !== auth()->id()) abort(403);
        $transaction->update(['status' => 'completed']);
        return redirect()->back()->with('success', 'Pesanan berhasil dikonfirmasi sebagai diterima.');
    })->name('orders.complete');
    Route::get('/chat', [\App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/fetch', [\App\Http\Controllers\ChatController::class, 'fetch'])->name('chat.fetch');
    Route::post('/chat/send', [\App\Http\Controllers\ChatController::class, 'store'])->name('chat.send');
});

// Admin Routes
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login']);
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        
        // Products CRUD
        Route::resource('products', AdminProductController::class)->except(['show']);
        
        // Orders
        Route::get('orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
        Route::put('orders/{transaction}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.updateStatus');

        // Chat
        Route::get('chat', [\App\Http\Controllers\Admin\ChatController::class, 'index'])->name('chat.index');
        Route::get('chat/{user}', [\App\Http\Controllers\Admin\ChatController::class, 'show'])->name('chat.show');
        Route::get('chat/{user}/fetch', [\App\Http\Controllers\Admin\ChatController::class, 'fetch']);
        Route::post('chat/{user}/send', [\App\Http\Controllers\Admin\ChatController::class, 'store']);
    });
});
