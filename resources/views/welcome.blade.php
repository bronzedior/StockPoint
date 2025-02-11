<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>StockPoint</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    @livewireStyles
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="{{route('welcome')}}">StockPoint</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="{{route('welcome')}}" class="nav-link active text-white" aria-current="page">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ auth()->check() && auth()->user()->role === 'admin' ? route('admin') : route('catalog') }}" class="nav-link text-white">Catalog</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="{{route('login')}}" class="btn btn-success">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <h1 class="text-center mt-3">StockPoint</h1>
    <h3 class="text-center mt-3">Every things you seek is already here</h3>

    <div class="text-center mt-5">
        <a href="{{ auth()->check() && auth()->user()->role === 'admin' ? route('admin') : route('catalog') }}" class="btn btn-primary">Check our catalog</a>
    </div>

    @livewire('contact-form')

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
