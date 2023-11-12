@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Order Detail') }}</div>

                    <div class="card-body">
                        <h5 class="card-title">Order ID {{ $order->id }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">By {{ $order->user->name }}</h6>

                        <hr>
                        @foreach ($order->transactions as $transaction)
                            <p>{{ $transaction->product->name }} - {{ $transaction->amount }} pcs</p>
                        @endforeach
                        <hr>

                        @if ($order->is_paid == 0 && $order->payment_receipt == null)
                            <form action="{{ route('order.receipt', $order) }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Upload Your Payment Receipt</label>
                                    <input type="file" name="payment_receipt" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
