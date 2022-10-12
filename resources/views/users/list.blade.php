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
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td> {{ $user['id']}} </td>
                    <td> {{ $user['name'] }} </td>
                    <td> {{ $user['email'] }} </td>
                    <td> {{ $user['phone'] }} </td>
                    <td> {{ $user['address'] }} </td>
                    <td><a href="{{ url('users/edit/'.$user->id) }}">Edit</a> 
                    <a onclick="return confirm('Are you sure to delete?')" href="{{ url('users/delete/'.$user->id) }}">Delete</a> </td> 
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection