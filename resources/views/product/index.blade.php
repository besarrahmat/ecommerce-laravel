@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Products') }}</div>

                    <div class="card-group m-auto">
                        @foreach ($products as $product)
                            <div class="card m-3" style="width: 18rem;">
                                <img class="card-img-top" src="{{ url('storage/products/' . $product->image) }}"
                                    alt="{{ $product->image }}">

                                <div class="card-body">
                                    <p class="card-text">{{ $product->name }}</p>

                                    <form action="{{ route('product.show', $product) }}" method="GET">
                                        <button type="submit" class="btn btn-primary">Detail</button>
                                    </form>

                                    @if (Auth::check() && Auth::user()->is_admin)
                                        <form action="{{ route('product.destroy', $product) }}" method="post">
                                            @method('delete')
                                            @csrf

                                            <button type="submit" class="btn btn-danger mt-2">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
