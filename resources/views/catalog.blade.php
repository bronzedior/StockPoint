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
                        <a href="{{route('catalog')}}" class="nav-link text-white">Catalog</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="{{route('checkout')}}" class="btn btn-warning me-2">View Cart</a>
                    <a href="{{route('logout')}}" class="btn btn-outline-danger">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <h1 class="text-center mt-3">Our Catalogs</h1>

    {{-- @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif --}}

    <div class="container">
        <div class="row">
            @foreach ($catalogs as $catalog)
            <div class="col-md-3 mb-4 d-flex align-items-stretch">
                <div class="card" style="width: 100%;">
                    <img src="{{asset('/storage/images/'.$catalog->image)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Name: {{$catalog->name}}</h5>
                        <p class="card-text">Category: {{$catalog->category->name}}</p>
                        <p class="card-text">Price: Rp{{number_format($catalog->price, 2)}}</p>
                        <p class="card-text">Quantity: {{$catalog->quantity}}</p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addToCartModal_{{$catalog->id}}">Add to Cart</button>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addToCartModal_{{$catalog->id}}" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{route('cart.add')}}" method="POST">
                        @csrf
                        <div class="modal-content bg-dark text-white">
                            <div class="modal-header border-bottom border-secondary">
                                <h5 class="modal-title" id="addToCartModalLabel">Add {{$catalog->name}} to Cart</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="catalog_id" value="{{$catalog->id}}">
                                <div class="mb-3">
                                    <label for="quantity_{{$catalog->id}}" class="form-label text-white">Enter Quantity</label>
                                    <input type="number" name="quantity" id="quantity_{{$catalog->id}}" class="form-control bg-secondary text-white" min="1" max="{{$catalog->quantity}}" required>
                                </div>
                            </div>
                            <div class="modal-footer border-top border-secondary">
                                <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success">Add to Cart</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
