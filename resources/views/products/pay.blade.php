@extends('layouts.app')

@section('content')
    <section class="home-slider owl-carousel">

        <div class="slider-item" style="background-image: url({{ asset('assets/images/bg_3.jpg') }});">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">

                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Pay with PayPal</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home</a></span> <span>Pay with
                                PayPal</span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <!-- Replace "test" with your own sandbox Business account app client ID -->
        <script
            src="https://www.paypal.com/sdk/js?client-id=AVT49cD4RIwitKAPCiwxKZ4YLR4h5JJoFclcV-z8WokRHroiD-FzmkFSjjk6QDoiB1TgPEQNTt_rkSeT&currency=USD">
        </script>
        <!-- Set up a container element for the button -->
        <div id="paypal-button-container"></div>
        <script>
            paypal.Buttons({
                // Sets up the transaction when a payment button is clicked
                createOrder: (data, actions) => {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: '{{ Session::get('price') }}' // Can also reference a variable or function
                            }
                        }]
                    });
                },
                // Finalize the transaction after payer approval
                onApprove: (data, actions) => {
                    return actions.order.capture().then(function(orderData) {

                        window.location.href = 'http://localhost:8000/products/success';
                    });
                }
            }).render('#paypal-button-container');
        </script>

    </div>
@endsection
