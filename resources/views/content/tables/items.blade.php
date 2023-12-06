@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')

    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Items</li>
            </ol>
            <button onclick="window.location.href='{{ route('add_items') }}'"
                class="btn btn-primary ml-auto float-md-right">Add Item</button>
        </nav>
    </div>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">Items</h5>
        <div class="table-responsive text-nowrap">
            <table class="table custom-table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Rate</th>
                        <th>More</th>
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
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="m7 17.013l4.413-.015l9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583l-1.597 1.582l-1.586-1.585l1.594-1.58zM9 13.417l6.03-5.973l1.586 1.586l-6.029 5.971L9 15.006v-1.589z" />
                                                <path fill="currentColor"
                                                    d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01c-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z" />
                                            </svg> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21H7Zm2-4h2V8H9v9Zm4 0h2V8h-2v9Z" />
                                            </svg> Delete</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="bx bx-edit-alt me-1"></i> Overview</a>
                                        <a class="dropdown-item" href="javascript:void(0);">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M14.5 3a2.5 2.5 0 1 0 0 5a2.5 2.5 0 0 0 0-5ZM10 5.5a4.5 4.5 0 0 1 6.5-4.032a4.5 4.5 0 1 1 0 8.064A4.5 4.5 0 0 1 10 5.5Zm8.25 2.488a2.5 2.5 0 1 0 0-4.975A4.48 4.48 0 0 1 19 5.5a4.48 4.48 0 0 1-.75 2.488ZM8.435 13.25a1.25 1.25 0 0 0-.885.364l-2.05 2.05V19.5h5.627l5.803-1.45l3.532-1.508a.555.555 0 0 0-.416-1.022l-.02.005L13.614 17H10v-2h3.125a.875.875 0 1 0 0-1.75h-4.69Zm7.552 1.152l3.552-.817a2.56 2.56 0 0 1 3.211 2.47a2.557 2.557 0 0 1-1.414 2.287l-.027.014l-3.74 1.595l-6.196 1.549H0v-7.25h4.086l2.052-2.052a3.25 3.25 0 0 1 2.3-.948h.002h-.002h4.687a2.875 2.875 0 0 1 2.862 3.152ZM3.5 16.25H2v3.25h1.5v-3.25Z" />
                                            </svg>
                                            Transaction</a>
                                        <a class="dropdown-item btn-show-actions" href="javascript:void(0);">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M12 21q-3.45 0-6.012-2.287T3.05 13H5.1q.35 2.6 2.313 4.3T12 19q2.925 0 4.963-2.037T19 12q0-2.925-2.037-4.962T12 5q-1.725 0-3.225.8T6.25 8H9v2H3V4h2v2.35q1.275-1.6 3.113-2.475T12 3q1.875 0 3.513.713t2.85 1.924q1.212 1.213 1.925 2.85T21 12q0 1.875-.712 3.513t-1.925 2.85q-1.213 1.212-2.85 1.925T12 21Zm2.8-4.8L11 12.4V7h2v4.6l3.2 3.2l-1.4 1.4Z" />
                                            </svg>
                                            History</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
@endsection

@section('Datatable')

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Your modal content goes here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- Additional buttons or actions -->
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.custom-table').DataTable();

            $(document).on('click', '.btn-show-actions', function() {
                var data = $('.custom-table').DataTable().row($(this).closest('tr')).data();
                $('#myModal').modal('show');
            });


        });
    </script>
@endsection
