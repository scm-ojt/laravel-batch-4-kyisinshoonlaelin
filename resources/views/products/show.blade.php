@extends('layouts/app')

@section('content')
<div class="container">
    <div class="card justify-content-center clearfix p-5">       
        <h3 style="color: #00008b"><a href="{{ route('users.show', $product->user->id) }}" class="text-decoration-none px-5"> {{$product->user->name}} </a></h3>
        <p class="px-5"> {{ $product -> created_at }} </p>
        <div class="border clearfix rounded p-5 mx-5 mt-5 shadow-sm">
            <div class="float-start border-end border-secondary" style="width:50%; height:470px; ">
            @if($product->image?->path == null) 
                <img src="{{ asset('/images/product.jpg') }}" width= '450' height='400' class="img img-responsive" alt="Image"/>
            @else
                <img src="{{ asset($product->image?->path) }}" alt="sample" width= '450' height='400' class="img img-responsive m-5"/>
            @endif
            </div>
            <div class="float-start mx-3" style="width: 46%;">
                <div class="content mx-4">
                    <h4 class="fw-bold"> {{ $product->title }} </h4>
                    <div>
                    @foreach($product->categories as $category)
                        <a class="btn btn-sm btn-secondary"> {{ $category->name }} </a>
                    @endforeach
                    </div>
                    <br>
                    <p><span class="fw-bold"><i class="fa fa-tag" aria-hidden="true"></i> Price - </span> {{ $product -> price }} </p>
                    <div><h5 class="fw-bold"> Description </h5> {{ $product -> description }} </div>
                </div>
            </div>
            
        </div> <br> <br>
        <a class="btn btn-primary mx-5" href="{{ url('/products/index') }}" style="width:78px"><i class="fa fa-arrow-left"></i>  Back </a>
    </div>
</div>
@endsection