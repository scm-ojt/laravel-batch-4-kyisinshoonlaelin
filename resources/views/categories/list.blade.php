@extends('layouts/app')

@section('content')
</script>
<div class="container">
    <a class="btn btn-info gap" href="{{ route('categories.create') }}"> Add Category </a>
    <div class="row justify-content-center">
        <table>
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td> {{ $category->id }} </td>
                    <td> {{ $category->name }} </td>
                    <td><a href="{{ url('categories/edit/'.$category->id) }}">Edit</a> 
                    <a onclick="return confirm('Are you sure to delete?')" href="{{ url('categories/delete/'.$category->id) }}">Delete</a> </td> 
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex">
             {{ $categories->links() }}
        </div>
    </div>
</div>

@endsection