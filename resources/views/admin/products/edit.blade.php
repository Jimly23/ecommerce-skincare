@extends('layouts.admin')

@section('title', 'Edit Product')
@section('header_title', 'Edit Product')

@section('content')
<div class="bg-white rounded-2xl border border-rose-100 shadow-[0_4px_20px_rgb(0,0,0,0.03)] overflow-hidden max-w-3xl">
    <div class="p-6 border-b border-rose-100">
        <h3 class="text-lg font-medium text-zinc-800">Edit Product: {{ $product->name }}</h3>
    </div>
    
    <div class="p-6">
        @if($errors->any())
            <div class="bg-red-50 text-red-500 p-4 rounded-xl mb-6 text-sm border border-red-100">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full px-4 py-2 rounded-xl border border-rose-200 bg-rose-50/50 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category" class="w-full px-4 py-2 rounded-xl border border-rose-200 bg-rose-50/50 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all">
                        <option value="">Pilih Kategori</option>
                        <option value="Parfum" {{ old('category', $product->category) == 'Parfum' ? 'selected' : '' }}>Parfum</option>
                        <option value="Micellar Water" {{ old('category', $product->category) == 'Micellar Water' ? 'selected' : '' }}>Micellar Water</option>
                        <option value="Skincare" {{ old('category', $product->category) == 'Skincare' ? 'selected' : '' }}>Skincare</option>
                        <option value="Makeup" {{ old('category', $product->category) == 'Makeup' ? 'selected' : '' }}>Makeup</option>
                        <option value="Haircare" {{ old('category', $product->category) == 'Haircare' ? 'selected' : '' }}>Haircare</option>
                        <option value="Bodycare" {{ old('category', $product->category) == 'Bodycare' ? 'selected' : '' }}>Bodycare</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Rating (0-5)</label>
                    <input type="number" name="rating" value="{{ old('rating', $product->rating) }}" min="0" max="5" step="0.1" class="w-full px-4 py-2 rounded-xl border border-rose-200 bg-rose-50/50 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all">
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price (Rp)</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" required min="0" step="0.01" class="w-full px-4 py-2 rounded-xl border border-rose-200 bg-rose-50/50 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required min="0" class="w-full px-4 py-2 rounded-xl border border-rose-200 bg-rose-50/50 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all">
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2 rounded-xl border border-rose-200 bg-rose-50/50 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all">{{ old('description', $product->description) }}</textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Main Ingredients</label>
                <textarea name="main_ingredients" rows="3" class="w-full px-4 py-2 rounded-xl border border-rose-200 bg-rose-50/50 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all">{{ old('main_ingredients', $product->main_ingredients) }}</textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">How to Use</label>
                <textarea name="how_to_use" rows="3" class="w-full px-4 py-2 rounded-xl border border-rose-200 bg-rose-50/50 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all">{{ old('how_to_use', $product->how_to_use) }}</textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Images</label>
                @if(is_array($product->images) && count($product->images) > 0)
                    <div class="flex flex-wrap gap-4 mb-4">
                        @foreach($product->images as $img)
                            <div class="w-24 h-24 rounded-lg overflow-hidden border border-rose-200">
                                <img src="{{ Storage::url($img) }}" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-zinc-500 mb-4">No images uploaded yet.</p>
                @endif
                
                <label class="block text-sm font-medium text-gray-700 mb-1">Add More Images (Max 3 total)</label>
                <input type="file" name="images[]" multiple accept="image/*" class="w-full px-4 py-2 rounded-xl border border-rose-200 bg-rose-50/50 focus:outline-none text-sm focus:ring-2 focus:ring-pink-400 transition-all file:mr-2 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-pink-50 file:text-pink-600 hover:file:bg-pink-100">
                <p class="text-xs text-zinc-500 mt-1">If you select new images, they will be appended.</p>
            </div>
            
            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-rose-100">
                <a href="{{ route('admin.products.index') }}" class="px-6 py-2 text-sm font-medium text-zinc-600 hover:text-zinc-800 transition">Cancel</a>
                <button type="submit" class="bg-pink-500 text-white px-6 py-2 rounded-xl text-sm font-medium hover:bg-pink-600 transition shadow-lg shadow-pink-500/30">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
