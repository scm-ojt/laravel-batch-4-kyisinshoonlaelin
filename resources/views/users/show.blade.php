<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 800px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

.title {
    text-align:center;
    margin-top: 35px;
    padding-top: 35px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #3c4693;
  text-align: center;
  cursor: pointer;
  font-size: 18px;
}

.btn-padding {
    margin-bottom: 35px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

.image-upload {
    height: 170px;
    width: 170px;
    border-radius: 50%;
    margin: 75px auto 0px auto;
    overflow-y: hidden;
}

.image-upload > input
{
    display: none;
}

.image-upload img
{    
    cursor: pointer;
    position: absolute;
    top: 137px;
    left: 668px;
    color: var(--white);
}
</style>
</head>
<body>

<div class="card">
    <h2><i class="fa fa-arrow-left"></i></h2>
    <h2 class="title">User Profile</h2>
    <div class="image-upload">
    <label for="file-input">
        <img src="{{ asset($user->image->path) }}" height='184.61' width='200' class="img img-responsive"/>
    </label>

    <input id="file-input" type="file"/>
    </div>
    <h1>{{ $user->name }}</h1>
    <p><i class="fa fa-envelope"></i> Email: {{ $user->email }}</p>
    <p><i class="fa fa-phone"></i> Phone: {{ $user->phone }}</p>
    <p><i class="fa fa-address-card"></i> Address: {{ $user->address }}</p>
    <a href="{{ url('users/edit/'.$user->id) }}"><button class="btn btn-primary btn-padding">Edit Profile</button></a>
</div>

</body>
</html>
