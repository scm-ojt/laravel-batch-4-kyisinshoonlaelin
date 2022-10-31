<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/example-styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/demo-styles.css') }}">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script type="text/javascript" src="{{ asset('js/jquery-2.2.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.multi-select.js') }}"></script>
    <script type="text/javascript">
	function previewImage(event) {
		var ofReader = new FileReader();
		ofReader.readAsDataURL(document.getElementById("fileInput").files[0]);
		ofReader.onload = function(oFREvent) {
			document.getElementById("uploadImage").src = oFREvent.target.result;
		};
	};
    $(function(){
        $('#categories').multiSelect();
    });
    </script>
    
    <style>
        .nav-bottom {
            margin-top: 20px;
        }
        .gap {
            margin-bottom: 20px;
        }
        .card-panel {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .category {
            overflow: hidden;
            list-style-type: none;
        }
        .category li {
            float: left;
            padding: 3px;
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

        .profile
        {    
            cursor: pointer;
            top: 80px;
            left: 322px;
            color: var(--white);
            position: absolute;
        }

        .camera {
            position: absolute;
            top: 227px;
            left: 473px;
        }
    </style>


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    SHOP.COM
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                        @if (Route::has('products.user.index'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('products.user.index') }}">{{ __('Product List') }}</a>
                            </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif

                            

                        @else
                            <li class="nav-item dropdown">
                                <a href="{{ route('users.show',Auth::user()->id) }}" class="nav-link" style="display:contents;"><img src="{{ asset(Auth::user()->image->path) }}" width='30' height='30' style="border-radius:50px;"/> </a>
                                <a href="" id="navbarDropdown" class="nav-link dropdown-toggle text-decoration-none" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="display:contents;">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item border-bottom" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="{{ route('users.show',Auth::user()->id) }}">
                                        {{ __('Profile') }}
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>