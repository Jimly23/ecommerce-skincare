<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|between:0,5',
            'description' => 'nullable|string',
            'main_ingredients' => 'nullable|string',
            'how_to_use' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'images' => 'nullable|array|max:3',
        ]);

        $data = $request->except('images');
        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $imagePaths[] = $img->store('products', 'public');
            }
        }
        $data['images'] = $imagePaths;

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|between:0,5',
            'description' => 'nullable|string',
            'main_ingredients' => 'nullable|string',
            'how_to_use' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'images' => 'nullable|array|max:3',
        ]);

        $data = $request->except('images');
        $imagePaths = is_array($product->images) ? $product->images : [];

        if ($request->hasFile('images')) {
            // Jika mau mengganti seluruh gambar saat upload baru:
            // foreach ($imagePaths as $oldImg) { Storage::disk('public')->delete($oldImg); }
            // $imagePaths = [];
            
            foreach ($request->file('images') as $img) {
                if (count($imagePaths) < 3) { // Max 3 gambar
                    $imagePaths[] = $img->store('products', 'public');
                }
            }
        }
        $data['images'] = $imagePaths;

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if (is_array($product->images)) {
            foreach ($product->images as $img) {
                Storage::disk('public')->delete($img);
            }
        }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
