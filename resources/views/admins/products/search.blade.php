@extends('admins.dashboard')

@section('content')
<div class="container" style="padding-top: 40px">
@if($searchedProducts->isNotEmpty())
    <a class="btn btn-info gap" href="{{ route('products.export') }}"> Download Product Data </a> <br><br>
    <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="csvFile" class="form-control @error('csvFile') is-invalid @enderror">
                @error('csvFile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }} </strong>
                                </span>
                @enderror
                <br>
                <button class="btn btn-success">Import</button>
    </form>
        <div class="row justify-content-center">
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>User Name</th>
                <th>Category</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach($searchedProducts as $product)
                    <tr>
                        <td> {{ $product->id }} </td>
                        <td> {{ $product->user->name }} </td>
                        <td> @foreach($product->categories as $category)
                            <a class="btn btn-sm btn-secondary"> {{ $category->name }} </a>
                            @endforeach
                        </td>
                        <td> {{ $product->title }} </td>
                        <td> {{ $product->description }} </td>
                        <td> {{ $product->price }} </td>
                        <td><a href="{{ route('admins.products.edit',$product->id) }}">Edit</a> 
                        <a onclick="return confirm('Are you sure to delete?')" href="{{ ('route('admins.products.delete/'.$product->id) }}">Delete</a> </td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
    @else
        <div class="row justify-content-center">
            <h2>No posts found. </h2>
        </div>
@endif
    <br>
    <a class="btn btn-info gap" href="{{ route('admins.products.index') }}"> Back </a>
    </div>
@endsection
