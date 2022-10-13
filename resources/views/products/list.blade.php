@extends('layouts/app')

@section('content')
</script>
<div class="container">
    <div class="row justify-content-center">
        <table>
            <thead>
            <tr>
                <th>Id</th>
                <th>User Id</th>
                <th>Category</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                @if($product['deleted_at'] == null)
                <tr>
                    <td> {{ $product['id'] }} </td>
                    <td> {{ $product['user_id'] }} </td>
                    <td> {{ $product->categories}}</td>
                    <td> {{ $product['title'] }} </td>
                    <td> {{ $product['description'] }} </td>
                    <td> {{ $product['price'] }} </td>
                    <td><a href="{{ url('products/edit/'.$product->id) }}">Edit</a> 
                    <a onclick="return confirm('Are you sure to delete?')" href="{{ url('products/delete/'.$product->id) }}">Delete</a> </td> 
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection