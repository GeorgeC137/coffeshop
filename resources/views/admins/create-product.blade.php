@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Create Product</h5>
                    <form method="POST" action="{{ route('store.product') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Email input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="name" id="form2Example1" class="form-control"
                                placeholder="name" />
                            @if ($errors->has('name'))
                                <span class="error" style="color:red">{{ $errors->first('name') }}</span>
                            @endif

                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="price" id="form2Example1" class="form-control"
                                placeholder="price" />
                            @if ($errors->has('price'))
                                <span class="error" style="color:red">{{ $errors->first('price') }}</span>
                            @endif

                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="file" name="image" id="form2Example1" class="form-control" />
                            @if ($errors->has('image'))
                                <span class="error" style="color:red">{{ $errors->first('image') }}</span>
                            @endif

                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            @if ($errors->has('description'))
                                <span class="error" style="color:red">{{ $errors->first('description') }}</span>
                            @endif
                        </div>

                        <div class="form-outline mb-4 mt-4">

                            <select name="type" class="form-select  form-control" aria-label="Default select example">
                                <option selected>Choose Type</option>
                                <option value="drinks">drinks</option>
                                <option value="desserts">desserts</option>
                            </select>
                        </div>

                        <br>



                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
