<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartStoreRequest;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): void
    {
    }

    public function create(): void
    {
    }

    public function store(CartStoreRequest $request, Product $product): RedirectResponse
    {
        $user_id = $request->user()->id;
        $product_id = $product->id;

        $request->validated();

        $cart = Cart::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'amount' => $request->amount,
        ]);

        $request->session()->flash('cart.id', $cart->id);

        return redirect()->route('product.index');
    }

    public function show(Request $request): View
    {
        $user_id = $request->user()->id;
        $carts = Cart::where('user_id', $user_id)
            ->get();

        return view('cart.show', compact('carts'));
    }

    public function edit(Cart $cart): void
    {
    }

    public function update(Request $request, Cart $cart): void
    {
    }

    public function destroy(Cart $cart): void
    {
    }
}
