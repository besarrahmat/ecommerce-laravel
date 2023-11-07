<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
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

    public function show(Product $product): View
    {
        return view('product.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        return view('product.edit', compact('product'));
    }

    public function update(ProductUpdateRequest $request, Product $product): RedirectResponse
    {
        $request->validated();

        $file = $request->file('image');
        $filename = date('U') . '-' . $request->name . '.' . $file->getClientOriginalExtension();

        Storage::putFileAs('products', $file, $filename);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $filename,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);

        $request->session()->flash('product.id', $product->id);

        return redirect()->route('product.show', compact('product'));
    }

    public function destroy(Product $product): void
    {
    }
}
