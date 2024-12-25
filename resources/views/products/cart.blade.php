@extends('layouts.app')

@section('content')
    <section class="home-slider owl-carousel">

        <div class="slider-item" style="background-image: url({{ asset('assets/images/bg_3.jpg') }});">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">

                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Cart</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div class="container">
        @if (session('delete'))
            <p class="alert {{ session('alert-class', 'alert-info') }}">{{ session('delete') }}</p>
        @endif
    </div>

    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table-dark" style="width: 1100px">
                            <thead style="background-color: #c49b63; height: 60px" >
                                <tr class="text-center">
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($cartProducts->count() > 0)
                                    @foreach ($cartProducts as $cartProduct)
                                        <tr class="text-center" style="height: 140px">
                                            <td class="product-remove"><a href="{{ route('delete.cart', $cartProduct->prod_id) }}"><span class="icon-close"></span></a></td>

                                            <td class="image-prod">
                                                <img src="{{  asset('assets/images/'.$cartProduct->image.'') }}" width="100" height="80"></img>
                                            </td>

                                            <td class="product-name">
                                                <h3>{{ $cartProduct->name }}</h3>
                                                <p>{{ $cartProduct->description }}</p>
                                            </td>

                                            <td class="price">${{ $cartProduct->price }}</td>

                                            <td>
                                                <div class="input-group mb-3">
                                                    <input disabled type="text" name="quantity"
                                                        class="quantity form-control input-number" value="1" min="1"
                                                        max="100">
                                                </div>
                                            </td>

                                            <td class="total">${{ $cartProduct->price }}</td>
                                        </tr><!-- END TR-->
                                    @endforeach
                                @else
                                    <p class="alert alert-success">You don't have items in your cart yet.</p>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Cart Totals</h3>
                        <p class="d-flex">
                            <span>Subtotal</span>
                            <span>${{ $totalPrice }}</span>
                        </p>
                        <p class="d-flex">
                            <span>Delivery</span>
                            <span>$0.00</span>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span>${{ $totalPrice }}</span>
                        </p>
                    </div>
                    @if ($cartProducts->count() > 0)
                        <form action="{{ route('prepare.checkout') }}" method="POST">
                            @csrf
                            <input type="hidden" name="price" value="{{ $totalPrice }}">
                            <button type="submit" name="submit" class="btn btn-primary py-3 px-4">Proceed to Checkout</button>
                        </form>
                    @else
                        <p class="alert alert-success">Please add products to cart before checking out</p>
                    @endif

                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
