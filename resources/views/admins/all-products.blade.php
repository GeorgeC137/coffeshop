@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <div class="container">
                @if (session('success'))
                    <p class="alert {{ session('alert-class', 'alert-info') }}">{{ session('success') }}</p>
                @endif
            </div>
            <div class="container">
                @if (session('deleted'))
                    <p class="alert {{ session('alert-class', 'alert-info') }}">{{ session('deleted') }}</p>
                @endif
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">Foods</h5>
                    <a href="{{ route('create.product') }}" class="btn btn-primary mb-4 text-center float-right">Create Products</a>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">image</th>
                                <th scope="col">price</th>
                                <th scope="col">type</th>
                                <th scope="col">delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <th scope="row">{{ $product->id }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td><img src="{{ asset('assets/images/'.$product->image.'') }}" width="70" height="70" alt="{{ $product->name }}"></td>
                                    <td>${{ $product->price }}</td>
                                    <td>{{ $product->type }}</td>
                                    <td>
                                        <form action="{{ route('delete.product', $product) }}" method="POST" onsubmit="return confirmDelete();">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger text-center">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this record?');
        }
    </script>
@endsection
