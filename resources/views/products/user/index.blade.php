@extends('layouts/app')

@section('content')
<div class="container">
<a class="btn btn-info gap" href="{{ route('products.create') }}"> Add Product </a>
    <div class="row">
    @foreach($products as $product)
        <div class="col-sm-3 justify-content-center">
            <div class="card-panel">
                @if($product->image?->path == null) 
                    <div class="panel-body"><img src="{{ asset('/images/product.jpg') }}" width= '250' height='250' class="img img-responsive" alt="Image"/></div>
                @else
                <div class="panel-body"><img src="{{ asset($product -> image?->path) }}" width= '250' height='250' class="img img-responsive" alt="Image"/></div>
                @endif
                <div class="panel-heading">{{ $product -> title }}</div>
                <div class="panel-footer">{{ $product -> price }}</div>
                <a class="btn btn-sm btn-secondary" href="{{ url('products/detail/'.$product->id) }}"><i class="fa fa-info-circle" aria-hidden="true"></i> Details</a> 
                <a class="btn btn-sm btn-success" href="{{ url('products/edit/'.$product->id) }}"><i class="fas fa-edit"></i> Edit</a>
                <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?')" href="{{ url('products/delete/'.$product->id) }}"><i class="fa fa-trash"></i> Delete</a>
            </div>
        </div>
    @endforeach
    </div>

</div>
@endsection