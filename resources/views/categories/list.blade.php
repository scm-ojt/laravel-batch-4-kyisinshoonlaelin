@extends('layouts/app')

@section('content')
</script>
<div class="container">
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
                @foreach($categories as $cate)
                @if($cate['deleted_at'] == null)
                <tr>
                    <td> {{ $cate['id']}} </td>
                    <td> {{ $cate['name'] }} </td>
                    <td><a href="{{ url('categories/edit/'.$cate->id) }}">Edit</a> 
                    <a onclick="return confirm('Are you sure to delete?')" href="{{ url('categories/delete/'.$cate->id) }}">Delete</a> </td> 
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection