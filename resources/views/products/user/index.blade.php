@extends('layouts/app')

@section('content')
<div class="container">
<a class="btn btn-info gap" href="{{ route('products.create') }}"> Add Product </a>
    <div class="row">
    @foreach($products as $product)
        <div class="col-sm-3 justify-content-center">
            <div class="card-panel">
                <div class="panel-body"><img src="{{ asset($product -> image?->path) }}" width= '250' height='250' class="img img-responsive" alt="Image"/></div>
                <div class="panel-heading">{{ $product -> title }}</div>
                <div class="panel-footer">{{ $product -> price }}</div>
                <a href="{{ url('products/detail/'.$product->id) }}">Details</a> 
                <a href="{{ url('products/edit/'.$product->id) }}">Edit</a>
                <a onclick="return confirm('Are you sure to delete?')" href="{{ url('products/delete/'.$product->id) }}">Delete</a>
            </div>
        </div>
    @endforeach
    </div>

</div>
@endsection