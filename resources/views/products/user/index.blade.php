@extends('layouts/app')

@section('content')
<div class="container">
<a class="btn btn-primary gap" href="{{ route('products.create') }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Product </a>
<div class="float-end">
<form action="{{ route('products.user.index') }}" method="GET">
        <input name="search" type="search" required />
        <button class="bg-gray border-0 rounded p-1 text-primary" name="searchSubmit" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button> <br><br>
</form>
</div>
    <div class="row">
    @foreach($products as $product)
        <div class="col-sm-3 justify-content-center">
            <div class="card mb-4">
                @if($product->image?->path == null) 
                    <img class="card-img-top" src="{{ asset('/images/product.jpg') }}" width= '250' height='250' class="img img-responsive card-img-top p-2" alt="Image"/>
                @else
                    <img src="{{ asset($product -> image?->path) }}" class="img img-responsive card-img-top p-2" width= '250' height='250' alt="Image"/>
                @endif
                <div class="card-body">
                    <h5 class="card-title fw-bold"> {{ $product -> title }} </h5>
                    <div class="panel-footer">{{ $product -> price }}</div> <br>
                    <div class="text-center">                        
                            <a class="btn btn-sm btn-secondary" href="{{ url('products/detail/'.$product->id) }}"><i class="fa fa-info-circle" aria-hidden="true"></i> Detail</a>
                        @can('product-edit', $product) 
                            <a class="btn btn-sm btn-success" href="{{ url('products/edit/'.$product->id) }}"><i class="fas fa-edit"></i> Edit</a>
                        @endcan
                        @can('product-delete', $product)
                            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?')" href="{{ url('products/delete/'.$product->id) }}"><i class="fa fa-trash"></i> Delete</a>
                        @endcan
                    </div>
                </div>
                
                
            </div>
        </div>
    @endforeach
    </div>
    <div class="d-flex">
        {{ $products->links() }}
    </div>
</div>
@endsection