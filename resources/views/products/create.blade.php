@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-info fs-5">{{ __('Create Product') }}</div>

                <div class="card-body offset-md-1">
                        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                    <label for="categories" class="mb-3">{{ __('Select Category:') }}</label>
                                    <select id="categories" class="selectpicker @error('categories') is-invalid @enderror col-md-6" multiple data-live-search="true" name="categories[]">
                                        @foreach($categories as $category)
                                            <option value="{{ $category['id'] }}" {{in_array( $category->id, old("categories") ?: []) ? "selected": ""}}>{{ $category['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('categories')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }} </strong>
                                    </span>
                                    @enderror
                            </div>
                            <br>
                            <div class="col-md-10">
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/x-png,image/gif,image/jpeg">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }} </strong>
                                    </span>
                                @enderror
                            </div>
                        
                        <br>
                        <div class="row mb-3">
                            <label for="title" class="col-form-label text-md-start">{{ __('Title') }}</label>

                            <div class="col-md-10">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}"  autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-form-label text-md-start">{{ __('Description') }}</label>

                            <div class="col-md-10">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}"  autocomplete="description" autofocus>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price" class="col-form-label text-md-start">{{ __('Price') }}</label>

                            <div class="col-md-10">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}"  autocomplete="price" autofocus>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-3">                               
                                <button type="submit" class="btn btn-info">
                                    {{ __('Create') }}
                                </button>
                                <a href="{{ route('products.user.index') }}" class="btn btn-secondary">
                                    {{ __('Back') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection