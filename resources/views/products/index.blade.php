@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        
                        <div class="text-end">
                            <a class="btn btn-primary" href="{{ route('products.create') }}">Add Product</a>
                            <a class="btn btn-primary" href="{{ route('home') }}">Back</a>
                        </div>

                        <h2>{{ __('Products List') }}</h2>

                    </div>

                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Active Status</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                        
                                @foreach($products as $product)                        
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->c_name}}</td>
                                        <td>
                                            <form action="{{ route('products.status',$product->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                    @if ($product->is_active == 0)
                                                        <button type="submit" class="btn btn-danger">Deactive</button>
                                                    @else
                                                        <button type="submit" class="btn btn-success">active</button>
                                                    @endif
                                            </form>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-info m-1" href="{{ route('products.show',$product->id) }}">Show</a>
                                                <a class="btn btn-primary m-1" href="{{ route('products.edit',$product->id) }}">Edit</a>
                                            
                                                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                        <button type="submit" class="btn btn-danger m-1">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
