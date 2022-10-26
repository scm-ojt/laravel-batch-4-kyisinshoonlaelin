@extends('layouts/app')

@section('content')
<div class="container">
    <div class="justify-content-center">       
        <h3 style="color: #00008b"><a href="" class="text-decoration-none"> {{ $product->user->name }} </a></h3>
        <p> {{ $product -> created_at }} </p>
        <div class="float-start border-end border-success pe-3">
        @if($product->image?->path == null) 
            <img src="{{ asset('/images/product.jpg') }}" width= '700' height='550' class="img img-responsive" alt="Image"/>
        @else
            <img src="{{ asset($product->image?->path) }}" alt="sample" width= '700' height='550' class="img img-responsive"/>
        @endif
        </div>
        <div class="float-start mx-3">
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
    </div>
</div>
@endsection