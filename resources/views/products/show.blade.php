@extends('layouts/app')

@section('content')
<div class="container">
    <div class="justify-content-center clearfix">       
        <h3 style="color: #00008b"><a href="" class="text-decoration-none"> {{$product->user->name}} </a></h3>
        <p> {{ $product -> created_at }} </p>
        <div class="clearfix">
            <div class="float-start border-end border-success" style="width:50%; height:470px; ">
            @if($product->image?->path == null) 
                <img src="{{ asset('/images/product.jpg') }}" width= '700' height='550' class="img img-responsive" alt="Image"/>
            @else
                <img src="{{ asset($product->image?->path) }}" alt="sample" width= '450' height='400' class="img img-responsive m-5"/>
            @endif
            </div>
            <div class="float-start mx-3" style="width: 47%;">
                <ul class="category">
                @foreach($product->categories as $category)
                    <li><a class="btn btn-xs btn-secondary"> {{ $category->name }} </a></li>
                @endforeach
                </ul>
                <div class="content mx-4">
                    <h4> {{ $product->title }} </h4>
                    <p> {{ $product -> price }} </p>
                    <div>{{ $product -> description }} </div>
                </div>
            </div>
        </div> <br> <br>
        <a class="btn btn-info" href="{{ url('/products/index') }}"><i class="fa fa-arrow-left"></i>  Back </a>
    </div>
</div>
@endsection