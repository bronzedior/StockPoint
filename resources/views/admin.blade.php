<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>StockPoint</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                        <a href="{{route('admin')}}" class="nav-link text-white">Catalog</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('addItem')}}" class="nav-link text-white">Insert</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="{{ route('logout') }}" class="btn btn-outline-danger">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <h1 class="text-center mt-3">Admin Catalogs</h1>

    <div class="container">
        <div class="row">
            @foreach ($catalogs as $catalog)
            <div class="col-md-3 mb-4 d-flex align-items-stretch">
                <div class="card" style="width: 100%;">
                    <img src="{{asset('/storage/images/'.$catalog->image)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Name: {{$catalog->name}}</h5>
                        <p class="card-text">Category: {{$catalog->category->name}}</p>
                        <p class="card-text">Price: {{$catalog->price}}</p>
                        <p class="card-text">Quantity: {{$catalog->quantity}}</p>
                        <a href="{{route('editItem', $catalog->id)}}" class="btn btn-success">Edit</a>
                        <form action="{{route('deleteItem', $catalog->id)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
