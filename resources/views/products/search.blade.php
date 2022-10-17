@extends('layouts/app')

@section('content')
<div class="container">
@if($searchedProducts->isNotEmpty())
        <div class="row justify-content-center">
        <table>
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
                        <td><a href="{{ url('products/edit/'.$product->id) }}">Edit</a> 
                        <a onclick="return confirm('Are you sure to delete?')" href="{{ url('products/delete/'.$product->id) }}">Delete</a> </td> 
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
    <a class="btn btn-info gap" href="{{ route('products.list') }}"> Back </a>
    </div>
@endsection
