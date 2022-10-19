@extends('adminLte/dashboard')

@section('content')
<div class="container">
    <a class="btn btn-info gap" href="{{ route('products.create') }}"> Add Product </a>
    <a class="btn btn-info gap" href="{{ route('products.export') }}"> Download Product Data </a>
    <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import Product Data</button>
            </form>
    <form action="{{ route('products.search') }}" method="GET" style="float:right">
        <input type="text" name="search" required/>
        <button type="submit">Search</button>
    </form>

    <div class="row justify-content-center">
        <table>
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
                    <td> <img src="{{ asset($product->image?->path) }}" width= '50' height='50' class="img img-responsive"/> </td>
                    <td> {{ $product->description }} </td>
                    <td> {{ $product->price }} </td>
                    <td>
                    <a href="{{ url('products/edit/'.$product->id) }}">Edit</a> 
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