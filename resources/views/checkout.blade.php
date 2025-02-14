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

    {{-- @if (session()->has('cart') && count(session('cart')) > 0)
        @foreach (session('cart') as $item)
            <p>{{ $item['name'] }} - {{ $item['quantity'] }}</p>
        @endforeach
    @else
        <p>Your cart is empty!</p>
    @endif --}}

    <div class="container mt-5">
        <h1 class="mb-4">Checkout</h1>

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

        @if (count($cart) > 0)
        <div class="row">
            @php $total = 0; @endphp
            @foreach ($cart as $item)
                <div class="col-md-6 mb-4">
                    <div class="card bg-dark text-white">
                        <div class="row g-0">
                            <div class="col-4">
                                <img src="{{asset('/storage/images/' . $item['image']) }}" alt="{{ $item['name']}}" class="img-fluid rounded-start">
                            </div>
                            <div class="col-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{$item['name']}}</h5>
                                    <p class="card-text">Category: {{$item['category']}}</p>
                                    <p class="card-text">Price: Rp{{number_format($item['price'], 2)}}</p>
                                    <p class="card-text">Quantity: {{$item['quantity']}}</p>
                                    <p class="card-text">Subtotal: Rp{{number_format($item['price'] * $item['quantity'], 2)}}</p>

                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal-{{$item['id']}}">
                                        Update Quantity
                                    </button>

                                    <form action="{{route('cart.delete', $item['id'])}}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>

                                    <div class="modal fade" id="updateModal-{{$item['id']}}" tabindex="-1" aria-labelledby="updateModalLabel-{{$item['id']}}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-dark text-white">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateModalLabel-{{$item['id']}}">Update Quantity for {{$item['name']}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{route('cart.update', $item['id'])}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="quantity-{{$item['id']}}" class="form-label">Quantity</label>
                                                            <input type="number" class="form-control" id="quantity-{{$item['id']}}" name="quantity" value="{{$item['quantity']}}" min="1" max="{{$catalog->find($item['id'])->quantity}}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update Quantity</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php $total += $item['price'] * $item['quantity']; @endphp
            @endforeach
        </div>

        <div class="text-end mt-4">
            <h3>Total: Rp{{number_format($total, 2)}}</h3>
            <form action="" method="GET">
                <button type="submit" class="btn btn-success">Proceed to Payment</button>
            </form>
        </div>
        @else
            <div class="alert alert-warning" role="alert">
                Your cart is empty!
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
