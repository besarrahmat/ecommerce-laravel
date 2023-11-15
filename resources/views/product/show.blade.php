@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Product Detail') }}</div>

                    <div class="card-body">
                        <div class="d-flex justify-content-around">
                            <div class="">
                                <img src="{{ url('storage/products/' . $product->image) }}" alt="{{ $product->image }}"
                                    width="200px">
                            </div>
                            <div class="">
                                <h1>{{ $product->name }}</h1>
                                <h6>{{ $product->description }}</h6>
                                <h3>Rp{{ $product->price }}</h3>
                                <hr>
                                <p>{{ $product->stock }} left</p>

                                @if (!Auth::user()->is_admin)
                                    <form action="{{ route('cart.store', $product) }}" method="post">
                                        @csrf

                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" aria-describedby="basic-addon2"
                                                name="amount" value=1>

                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="submit">Add to
                                                    Cart</button>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <form action="{{ route('product.edit', $product) }}" method="GET">
                                        <button type="submit" class="btn btn-primary">Edit Product</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
