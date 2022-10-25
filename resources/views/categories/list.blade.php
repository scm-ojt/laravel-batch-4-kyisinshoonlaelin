@extends('admins/dashboard')

@section('content')
</script>
<div class="container" style="padding-top:29px">
    <a class="btn btn-info gap" href="{{ route('categories.create') }}"> Add Category </a> <br><br>
    <div class="row justify-content-center">
        <table class="table">
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
                    <td><a href="{{ route('categories.edit',$category->id) }}">Edit</a> 
                    <a onclick="return confirm('Are you sure to delete?')" href="{{ route('categories.delete',$category->id) }}">Delete</a> </td> 
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