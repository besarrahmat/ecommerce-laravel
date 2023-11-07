<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::all();

        return view('product.index', compact('products'));
    }

    public function create(): View
    {
        return view('product.create');
    }

    public function store(ProductStoreRequest $request): RedirectResponse
    {
        $request->validated();

        $file = $request->file('image');
        $filename = date('U') . '-' . $request->name . '.' . $file->getClientOriginalExtension();

        Storage::putFileAs('products', $file, $filename);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $filename,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);

        $request->session()->flash('product.id', $product->id);

        return redirect()->route('product.index');
    }

    public function show(Product $product): void
    {
    }

    public function edit(Product $product): void
    {
    }

    public function update(Request $request, Product $product): void
    {
    }

    public function destroy(Product $product): void
    {
    }
}
