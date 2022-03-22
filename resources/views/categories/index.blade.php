@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">                
                    <div class="card-header">
                        
                        <div class="text-end">
                            <a class="btn btn-primary" href="{{ route('categories.create') }}">Add Category</a>
                            <a class="btn btn-primary" href="{{ route('home') }}">Back</a>
                        </div>

                        <h2>{{ __('Categories List') }}</h2>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Active Status</th>
                                <th width="280px">Action</th>
                            </tr>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->c_name }}</td>
                                    <td>
                                        <form action="{{ route('categories.status',$category->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                                @if ($category->is_active == 0)
                                                    <button type="submit" class="btn btn-danger">Deactive</button>
                                                @else
                                                    <button type="submit" class="btn btn-success">active</button>
                                                @endif
                                        </form>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-info m-1" href="{{ route('categories.show',$category->id) }}">Show</a>
                                            <a class="btn btn-primary m-1" href="{{ route('categories.edit',$category->id) }}">Edit</a>
                                        
                                            <form action="{{ route('categories.destroy',$category->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger m-1">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach                    
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
