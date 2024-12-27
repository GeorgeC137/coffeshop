@extends('layouts.app')

@section('content')
    <section class="home-slider owl-carousel">
        <div class="slider-item" style="background-image: url({{ asset('assets/images/bg_3.jpg') }});">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">

                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Product Detail</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home</a></span> <span>Product
                                Detail</span></p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div class="container">
        @if (session('success'))
            <p class="alert {{ session('alert-class', 'alert-info') }}">{{ session('success') }}</p>
        @endif
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 ftco-animate">
                    <a href="{{ asset('assets/images/'.$product->image.'') }}" class="image-popup"><img src="{{ asset('assets/images/'.$product->image.'') }}" class="img-fluid"
                            alt="Colorlib Template"></a>
                </div>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3 class="text-white">{{ $product->name }}</h3>
                    <p class="price"><span>${{ $product->price }}</span></p>
                    <p>
                        {{ $product->description }}
                    </p>
                    <form action="{{ route('add.cart', $product) }}" method="POST">
                        @csrf
                        <input type="hidden" name="prod_id" value="{{ $product->id }}">
                        <input type="hidden" name="name" value="{{ $product->name }}">
                        <input type="hidden" name="image" value="{{ $product->image }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">

                        @if (isset(Auth::user()->id))
                            @if ($cartItems == 0)
                                <button type="submit" name="submit" class="btn btn-primary py-3 px-5">Add to Cart</button>
                            @else
                                <button style="background-color: black" class="text-white btn btn-warning py-3 px-5" disabled>Added to Cart</button>
                            @endif
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section ftco-animate text-center">
                    <span class="subheading">Discover</span>
                    <h2 class="mb-4">Related products</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
                        the blind texts.</p>
                </div>
            </div>
            <div class="row">
                @foreach ($relatedProducts as $relatedProduct)
                    <div class="col-md-3">
                        <div class="menu-entry">
                            <a href="{{ route('single.product', $relatedProduct) }}" class="img" style="background-image: url({{ asset('assets/images/'.$relatedProduct->image.'') }});"></a>
                            <div class="text text-center pt-4">
                                <h3><a href="{{ route('single.product', $relatedProduct) }}">{{ $relatedProduct->name }}</a></h3>
                                <p>
                                    {{ $relatedProduct->description }}
                                </p>
                                <p class="price"><span>${{ $relatedProduct->price }}</span></p>
                                <p><a href="{{ route('single.product', $relatedProduct) }}" class="btn btn-primary btn-outline-primary">Show</a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
