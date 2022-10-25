@extends('admins/dashboard')

@section('content')
<div class="container" style="padding-top:29px;">
    
    <a class="btn btn-info gap" href="{{ route('products.export') }}"> Download Product Data </a> <br><br>
    <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="csvFile" class="form-control @error('csvFile') is-invalid @enderror col-5 float-left">
                @error('csvFile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }} </strong>
                                </span>
                @enderror
                <button class="btn btn-success mx-3">Import</button>
    </form>
    <br>
    <form action="{{ route('products.search') }}" method="GET">
        <input type="text" name="search" required />
        <button type="submit">Search</button>
    </form>
    <br>
    <div class="row justify-content-center">
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>User Name</th>
                <th>Category</th>
                <th>Title</th>
                <th>Image</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td> {{ $product->id }} </td>
                    <td> {{ $product->user->name }} </td>
                    <td> @foreach($product->categories as $category)
                        <a class="btn btn-sm btn-secondary"> {{ $category->name }} </a>
                         @endforeach
                    </td>
                    <td> {{ $product->title }} </td>
                    <td> <img src="{{ asset($product->image?->path) }}" width= '70' height='70' class="img img-responsive"/> </td>
                    <td> {{ $product->description }} </td>
                    <td> {{ $product->price }} </td>
                    <td>
                    <a href="{{ route('admins.products.edit',$product->id) }}">Edit</a> 
                    <a onclick="return confirm('Are you sure to delete?')" href="{{ url('products/delete/'.$product->id) }}">Delete</a> </td> 
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex">
                {{ $products->links() }}
        </div>
    </div>
</div>

@endsection