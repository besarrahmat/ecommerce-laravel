<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartStoreRequest;
use App\Http\Requests\CartUpdateRequest;
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

        $existing_cart = Cart::where('product_id', $product_id)
            ->where('user_id', $user_id)
            ->first();

        $request->validated();

        if ($existing_cart == null) {
            $cart = Cart::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'amount' => $request->amount,
            ]);

            $request->session()->flash('cart.id', $cart->id);
        } else {
            $existing_cart->update([
                'amount' => $existing_cart->amount + $request->amount,
            ]);

            $request->session()->flash('cart.id', $existing_cart->id);
        }

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

    public function update(CartUpdateRequest $request, Cart $cart): RedirectResponse
    {
        $cart->update([
            'amount' => $request->amount,
        ]);

        $request->session()->flash('cart.id', $cart->id);

        return redirect()->route('cart.show');
    }

    public function destroy(Cart $cart): RedirectResponse
    {
        $cart->delete();

        return redirect()->back();
    }
}
