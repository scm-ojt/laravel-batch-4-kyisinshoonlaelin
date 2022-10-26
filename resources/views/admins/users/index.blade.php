@extends('admins.dashboard')

@section('content')
</script>
<div class="container pt-5">
    <a class="btn btn-info gap" href="{{ route('admins.users.create') }}"> Add User </a> <br><br>
    <div class="row justify-content-center">
        <table class="table table-success table-striped">
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
                    <td> {{ $user->id }} </td>
                    <td> {{ $user->name }} </td>
                    <td> {{ $user->email }} </td>
                    <td> {{ $user->phone }} </td>
                    <td> {{ $user->address }} </td>
                    <td><a class="btn btn-xs btn-success" href="{{ route('admins.users.edit',$user->id) }}"><i class="fas fa-edit"></i> Edit</a> 
                    <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to delete?')" href="{{ url('users/delete/'.$user->id) }}"><i class="fa fa-trash"></i> Delete</a> </td> 
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex">
                {{ $users->links() }}
        </div>
    </div>
</div>

@endsection