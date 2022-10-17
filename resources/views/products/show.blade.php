@extends('layouts/app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3 style="color: #00008b"> {{ $product->user->name }} </h3>
        <p> {{ $product -> created_at }} </p>
        <img src="{{ URL::asset('../resources/img/sample.png') }}" alt="sample">
        <ul class="category">
        @foreach($product->categories as $category)
            <li> {{ $category->name }} </li>
        @endforeach
        </ul>
        <h4> {{ $product->title }} </h4>
        <p> {{ $product -> price }} </p>
        <div>{{ $product -> description }} </div>
    </div>
</div>
@endsection