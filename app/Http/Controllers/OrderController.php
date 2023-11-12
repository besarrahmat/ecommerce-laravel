<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
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
}
