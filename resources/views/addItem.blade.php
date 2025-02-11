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

    <div class="p-5">
        <h1 class="text-center">Add Item</h1>
        <form action="{{route('store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Category</label>
                <select class="form-select form-color" aria-label="Default select example" name="category_name">
                    <option value="" disabled selected>select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Name</label>
                <input value="{{old('name')}}" type="text" class="form-control form-color" id="" name="name" placeholder="5-80 characters">
            </div>

            @error('name')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
            @enderror

            <div class="mb-3">
                <label for="" class="form-label">Price</label>
                <input value="{{old('price')}}" type="text" class="form-control form-color" id="" name="price" placeholder="e.g. Rp 5000">
            </div>

            @error('price')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
            @enderror

            <div class="mb-3">
                <label for="" class="form-label">Quantity</label>
                <input value="{{old('quantity')}}" type="text" class="form-control form-color" id="" name="quantity" placeholder="e.g. 10">
            </div>

            @error('quantity')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
            @enderror

            <div class="mb-3">
                <label for="" class="form-label">Item Picture</label>
                <input type="file" class="form-control form-color" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                <div class="mt-3">
                    <img id="image-preview" src="#" alt="Image Preview" style="display: none; max-width: 200px; max-height: 200px;" />
                </div>
            </div>

            @error('image')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
            @enderror

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="{{asset('js/script.js')}}"></script>
</body>
</html>
