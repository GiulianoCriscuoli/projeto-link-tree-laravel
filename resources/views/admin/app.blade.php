<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('assets/css/admin.app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;600;800&display=swap" rel="stylesheet">   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <title>@yield('title')</title>
</head>
<body>
    <nav>
        <div class="nav-top">
            <a href="{{ route('admin') }}">
                <i class="fa fa-file"></i>
            </a>
        </div>
        <div class="nav-bottom">
            <a href="{{ route('logout') }}">
                <i class="fa fa-sign-out-alt"></i>
            </a>
        </div>
    </nav>
    <section class="container">
        @yield('content')
    </section>
</body>
</html>