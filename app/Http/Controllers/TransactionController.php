<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index(): void
    {
    }

    public function create(): void
    {
    }

    public function store(Request $request): RedirectResponse
    {
        $user_id = $request->user()->id;
        $carts = Cart::where('user_id', $user_id)
            ->get();

        if ($carts == null) {
            return redirect()->back();
        }

        $order = Order::create([
            'user_id' => $user_id,
        ]);

        foreach ($carts as $cart) {
            $product = Product::find($cart->product_id);

            $product->update([
                'stock' => $product->stock - $cart->amount,
            ]);

            $transaction = Transaction::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'amount' => $cart->amount,
            ]);

            $request->session()->flash('transaction.id', $transaction->id);

            $cart->delete();
        }

        return redirect()->back();
    }

    public function show(Request $request): void
    {
    }

    public function edit(Transaction $transaction): void
    {
    }

    public function update(Request $request, Transaction $transaction): void
    {
    }

    public function destroy(Transaction $transaction): void
    {
    }
}
