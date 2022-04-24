<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="600">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>STUDENTS PROJECTS</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        setInterval(function() {
            window.location.reload();
        }, 600000);

    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <main class="py-4">
            <div class="container mt-3">
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        @if ($errors->any())
                        <div class="alert">
                            <ul class="list-group">
                                @foreach ($errors->all() as $error)
                                <li class="list-group-item
list-group-item-danger">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        @if(session()->has('success_message'))
                        <div class="alert alert-success" role="alert">
                            {{session()->get('success_message')}}
                        </div>
                        @endif
                        @if(session()->has('info_message'))
                        <div class="alert alert-info" role="alert">
                            {{session()->get('info_message')}}
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            @yield('content')
        </main>
    </div>
</body>
</html>
