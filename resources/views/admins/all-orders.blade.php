@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        @if (session('updated'))
                            <p class="alert {{ session('alert-class', 'alert-info') }}">{{ session('updated') }}</p>
                        @endif
                    </div>
                    <div class="container">
                        @if (session('deleted'))
                            <p class="alert {{ session('alert-class', 'alert-info') }}">{{ session('deleted') }}</p>
                        @endif
                    </div>
                    <h5 class="card-title mb-4 d-inline">Orders</h5>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">first_name</th>
                                <th scope="col">last_name</th>
                                <th scope="col">city</th>
                                <th scope="col">state</th>
                                <th scope="col">phone</th>
                                <th scope="col">street_address</th>
                                <th scope="col">total_price</th>
                                <th scope="col">status</th>
                                <th scope="col">change status</th>
                                <th scope="col">delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allOrders as $order)
                                <tr>
                                    <th scope="row">{{ $order->id }}</th>
                                    <td>{{ $order->first_name }}</td>
                                    <td>{{ $order->last_name }}</td>
                                    <td>{{ $order->city }}</td>
                                    <td>{{ $order->state }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>${{ $order->price }}</td>

                                    <td>{{ $order->status }}</td>
                                    <td><a href="{{ route('edit.order', $order) }}" class="btn btn-warning text-white text-center ">change status</a></td>
                                    <td>
                                        <form action="{{ route('delete.order', $order) }}" method="POST" onsubmit="return confirmDelete();">
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
