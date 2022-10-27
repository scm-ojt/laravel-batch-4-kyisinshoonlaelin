@extends('admins/dashboard')

@section('content')
</script>
<div class="container" style="padding-top:29px">
    <a class="btn btn-info gap" href="{{ route('categories.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Add Category </a> <br><br>
    <div class="row justify-content-center">
        <table class="table table-success table-striped">
            <thead class="table-light">
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
                    <td><a class="btn btn-success btn-xs" href="{{ route('categories.edit',$category->id) }}"><i class="fas fa-edit"></i> Edit</a> 
                    <a class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete?')" href="{{ route('categories.delete',$category->id) }}"><i class="fa fa-trash"></i> Delete</a> </td> 
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