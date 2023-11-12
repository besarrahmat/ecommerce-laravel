<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderPaymentReceiptRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::all();

        return view('order.index', compact('orders'));
    }

    public function create(): void
    {
    }

    public function store(Request $request): void
    {
    }

    public function show(Order $order): View
    {
        return view('order.show', compact('order'));
    }

    public function edit(Order $order): void
    {
    }

    public function update(Request $request, Order $order): void
    {
    }

    public function destroy(Order $order): void
    {
    }

    public function payment_receipt(OrderPaymentReceiptRequest $request, Order $order): RedirectResponse
    {
        $request->validated();

        $file = $request->file('payment_receipt');
        $filename = date('U') . '-' . $order->id . '.' . $file->getClientOriginalExtension();

        Storage::putFileAs('receipts', $file, $filename);

        $order->update([
            'payment_receipt' => $filename,
        ]);

        $request->session()->flash('order.id', $order->id);

        return redirect()->back();
    }

    public function confirm_payment(Request $request, Order $order): RedirectResponse
    {
        $order->update([
            'is_paid' => 1,
        ]);

        $request->session()->flash('order.id', $order->id);

        return redirect()->back();
    }
}
