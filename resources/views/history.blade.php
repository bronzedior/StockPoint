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
                    <a href="{{route('history')}}" class="btn btn-info me-2">Check Invoice History</a>
                    <a href="{{route('checkout')}}" class="btn btn-warning me-2">View Cart</a>
                    <a href="{{route('logout')}}" class="btn btn-outline-danger">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="mb-4">Invoice History</h1>

        @if($invoices->isEmpty())
            <div class="alert alert-warning" role="alert">Invoice is empty!</div>
        @else
            <div class="row">
                @foreach($invoices as $invoice)
                    <div class="col-md-4 mb-4">
                        <div class="card bg-secondary text-white">
                            <div class="card-body">
                                <h5 class="card-title">Invoice #{{ $invoice->invoice_number }}</h5>
                                <p><strong>Date:</strong> {{ $invoice->created_at->format('d M Y') }}</p>
                                <p><strong>Total Amount:</strong> Rp{{ number_format($invoice->total_amount, 2) }}</p>
                                <p><strong>Delivery Address:</strong> {{ $invoice->delivery_address }}</p>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoiceModal_{{ $invoice->id }}">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="invoiceModal_{{ $invoice->id }}" tabindex="-1" aria-labelledby="invoiceModalLabel_{{ $invoice->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content bg-dark text-white">
                                <div class="modal-header">
                                    <h5 class="modal-title">Invoice Details for #{{ $invoice->invoice_number }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <h6><strong>Delivery Address:</strong> {{ $invoice->delivery_address }}</h6>
                                        <h6><strong>Postal Code:</strong> {{ $invoice->postal_code }}</h6>
                                        <h6><strong>Total Amount:</strong> Rp{{ number_format($invoice->total_amount, 2) }}</h6>
                                    </div>
                                    <h4 class="mt-4">Items:</h4>
                                    <div class="d-flex flex-column gap-3">
                                        @php $items = is_array($invoice->items) ? $invoice->items : json_decode($invoice->items, true); @endphp
                                        @foreach($items as $item)
                                            <div class="border rounded p-3 bg-light text-dark">
                                                <p><strong>Category:</strong> {{ $item['category'] ?? 'N/A' }}</p>
                                                <p><strong>Item Name:</strong> {{ $item['name'] }}</p>
                                                <p><strong>Price:</strong> Rp{{ number_format($item['price'], 2) }}</p>
                                                <p><strong>Quantity:</strong> {{ $item['quantity'] }}</p>
                                                <p><strong>Subtotal:</strong> Rp{{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
