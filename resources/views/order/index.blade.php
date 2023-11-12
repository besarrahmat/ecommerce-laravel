@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Orders') }}</div>

                    <div class="card-body m-auto">
                        @foreach ($orders as $order)
                            <div class="card mb-2" style="width: 30rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Order ID {{ $order->id }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">By {{ $order->user->name }}</h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
