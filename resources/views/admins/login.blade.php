@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <div class="container">
                @if (session('error'))
                    <p class="alert {{ session('alert-class', 'alert-info') }}">{{ session('error') }}</p>
                @endif
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mt-5">Login</h5>
                    <form method="POST" class="p-auto" action="{{ route('login.admin') }}">
                        @csrf
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" name="email" id="form2Example1" class="form-control"
                                placeholder="Email" />
                            @if ($errors->has('email'))
                                <span class="error" style="color:red">{{ $errors->first('email') }}</span>
                            @endif

                        </div>


                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" name="password" id="form2Example2" placeholder="Password"
                                class="form-control" />
                            @if ($errors->has('password'))
                                <span class="error" style="color:red">{{ $errors->first('password') }}</span>
                            @endif

                        </div>



                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>


                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
