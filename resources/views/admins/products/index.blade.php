@extends('admins/dashboard')

@section('content')
<div class="container" style="padding-top:29px;">
    
    
    <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="csvFile" class="form-control @error('csvFile') is-invalid @enderror col-8 float-left" accept=".csv">
                
                <button type="submit" class="btn btn-info mx-3">Import</button>
                @error('csvFile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }} </strong>
                                </span>
                @enderror
    </form>
    <br>
    <form action="{{ route('admins.products.index') }}" method="GET">
        <input name="search" type="search" required value="{{ $search }}" />
        <button name="searchSubmit" type="submit">Search</button> <br><br>
        <button class="btn btn-info" name="export" type="submit">Export</button> <br><br>
    </form>
    
    <br>
    <div class="row justify-content-center">
        <table class="table table-success table-striped">
            <thead class="table-light">
            <tr>
                <th class="align-middle text-center">Id</th>
                <th class="align-middle"> User Name</th>
                <th class="align-middle text-center">Category</th>
                <th class="align-middle text-center">Title</th>
                <th class="align-middle text-center">Image</th>
                <th class="align-middle text-center">Description</th>
                <th class="align-middle text-center">Price</th>
                <th class="align-middle text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td class="align-middle"> {{ $product->id }} </td>
                    <td class="align-middle"> {{ $product->user->name }} </td>
                    <td class="align-middle"> @foreach($product->categories as $category)
                        <a class="btn btn-sm btn-secondary"> {{ $category->name }} </a>
                         @endforeach
                    </td>
                    <td class="align-middle"> {{ $product->title }} </td>
                    <td class="align-middle"> @if($product->image?->path == null) 
                            <img src="{{ asset('/images/product.jpg') }}" width= '140' height='120' class="img img-responsive"/>
                        @else
                            <img src="{{ asset($product->image?->path) }}" width= '140' height='120' class="img img-responsive"/> 
                        @endif
                    </td>
                    <td class="align-middle"> {{ $product->description }} </td>
                    <td class="align-middle"> {{ $product->price }} </td>
                    <td class="align-middle" style="width:1px; white-space:nowrap;">
                    <a class="btn btn-sm btn-success" href="{{ route('admins.products.edit',$product->id) }}"><i class="fas fa-edit"></i> Edit</a>
                    <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?')" href="{{ route('admins.products.delete',$product->id) }}"><i class="fa fa-trash"></i> Delete</a> </td> 
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex">
                {{ $products->links() }}
        </div>
    </div>
</div>

@endsection