@extends('layouts.app')

@section('content')
    <section class="home-slider owl-carousel">

        <div class="slider-item" style="background-image: url( {{ asset('assets/images/bg_3.jpg') }});">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">

                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Our Menu</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home</a></span> <span>Menu</span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="ftco-intro">
        <div class="container-wrap">
            <div class="wrap d-md-flex align-items-xl-end">
                <div class="info">
                    <div class="row no-gutters">
                        <div class="col-md-4 d-flex ftco-animate">
                            <div class="icon"><span class="icon-phone"></span></div>
                            <div class="text">
                                <h3>000 (123) 456 7890</h3>
                                <p>A small river named Duden flows by their place and supplies.</p>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex ftco-animate">
                            <div class="icon"><span class="icon-my_location"></span></div>
                            <div class="text">
                                <h3>198 West 21th Street</h3>
                                <p> 203 Fake St. Mountain View, San Francisco, California, USA</p>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex ftco-animate">
                            <div class="icon"><span class="icon-clock-o"></span></div>
                            <div class="text">
                                <h3>Open Monday-Friday</h3>
                                <p>8:00am - 9:00pm</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row">


                <div class="col-md-6">
                    <h3 class="mb-5 heading-pricing ftco-animate">Desserts</h3>
                    @foreach ($desserts as $dessert)
                        <div class="pricing-entry d-flex ftco-animate">
                            <div class="img" style="background-image: url({{ asset('assets/images/'.$dessert->image.'') }});"></div>
                            <div class="desc pl-3">
                                <div class="d-flex text align-items-center">
                                    <h3><span>{{ $dessert->name }}</span></h3>
                                    <span class="price">${{ $dessert->price }}</span>
                                </div>
                                <div class="d-block">
                                    <p>{{ $dessert->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-md-6">
                    <h3 class="mb-5 heading-pricing ftco-animate">Drinks</h3>
                    @foreach ($drinks as $drink)
                        <div class="pricing-entry d-flex ftco-animate">
                            <div class="img" style="background-image: url({{ asset('assets/images/'.$drink->image.'') }});"></div>
                            <div class="desc pl-3">
                                <div class="d-flex text align-items-center">
                                    <h3><span>{{ $drink->name }}</span></h3>
                                    <span class="price">${{ $drink->price }}</span>
                                </div>
                                <div class="d-block">
                                    <p>{{ $drink->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-menu mb-5 pb-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">Discover</span>
                    <h2 class="mb-4">Our Products</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
                        the blind texts.</p>
                </div>
            </div>
            <div class="row d-md-flex">
                <div class="col-lg-12 ftco-animate p-md-5">
                    <div class="row">
                        <div class="col-md-12 nav-link-wrap mb-5">
                            <div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab"
                                role="tablist" aria-orientation="vertical">

                                <a class="nav-link active" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2"
                                    role="tab" aria-controls="v-pills-2" aria-selected="false">Drinks</a>

                                <a class="nav-link" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3"
                                    role="tab" aria-controls="v-pills-3" aria-selected="false">Desserts</a>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex align-items-center">

                            <div class="tab-content ftco-animate" id="v-pills-tabContent">



                                <div class="tab-pane fade show active" id="v-pills-2" role="tabpanel"
                                    aria-labelledby="v-pills-2-tab">
                                    <div class="row">
                                        @foreach ($drinks as $drink)
                                            <div class="col-md-4 text-center">
                                                <div class="menu-wrap">
                                                    <a href="{{ route('single.product', $drink->id) }}" class="menu-img img mb-4"
                                                        style="background-image: url({{ asset('assets/images/'.$drink->image.'') }});"></a>
                                                    <div class="text">
                                                        <h3><a href="{{ route('single.product', $drink->id) }}">{{ $drink->name }}</a></h3>
                                                        <p>
                                                            {{ $drink->description }}
                                                        </p>
                                                        <p class="price"><span>${{ $drink->price }}</span></p>
                                                        <p><a href="{{ route('single.product', $drink->id) }}" class="btn btn-primary btn-outline-primary">Add
                                                                to cart</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="v-pills-3" role="tabpanel"
                                    aria-labelledby="v-pills-3-tab">
                                    <div class="row">
                                        @foreach ($desserts as $dessert)
                                            <div class="col-md-4 text-center">
                                                <div class="menu-wrap">
                                                    <a href="{{ route('single.product', $dessert) }}" class="menu-img img mb-4"
                                                        style="background-image: url({{ asset('assets/images/'.$dessert->image.'') }});"></a>
                                                    <div class="text">
                                                        <h3><a href="{{ route('single.product', $dessert) }}">{{ $dessert->name }}</a></h3>
                                                        <p>
                                                            {{ $dessert->description }}
                                                        </p>
                                                        <p class="price"><span>${{ $dessert->price }}</span></p>
                                                        <p><a href="{{ route('single.product', $dessert) }}" class="btn btn-primary btn-outline-primary">Add
                                                                to cart</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
