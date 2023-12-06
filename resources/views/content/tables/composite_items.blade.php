@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')

    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Composite Items</li>
            </ol>
            {{-- <button class="btn btn-primary ml-auto float-md-right">Add Item</button> --}}
        </nav>
    </div>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">Items</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Stock On Hand</th>
                        <th>Description</th>
                        <th>Rate</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach (range(1, 15) as $key => $value)
                        <tr>
                            <td><i class="bx bxl-angular bx-sm text-danger me-3"></i>
                                <span class="fw-medium">Item {{ $key + 1 }}</span>
                            </td>
                            <td>Item {{ $key + 1 }} sku</td>
                            <td>
                                Goods
                            </td>
                            <td><span class="badge bg-label-primary me-1">
                                    Item-{{ $key }} description
                                </span></td>
                            <td>Rs {{ rand(1, 1000) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
@endsection
