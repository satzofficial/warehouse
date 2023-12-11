@extends('layouts/contentNavbarLayout')

@section('title', 'Edit items')

@section('content')
    <style>
        #previewContainer {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .preview-image {
            position: relative;
        }

        .remove-button-js {
            position: absolute;
            top: 5px;
            right: 5px;
            cursor: pointer;
        }

        .remove-button {
            position: absolute;
            /* top: 5px; */
            right: 5px;
            cursor: pointer;
        }
    </style>
    <div class="col-xl-9">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('add_items_create') }}" class="myform" method="post" id="myform"
            enctype="multipart/form-data">
            @csrf
            <!-- HTML5 Inputs -->
            <div class="card mb-4">
                <h5 class="card-header">Add Items</h5>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="unit" class="col-md-2 col-form-label">Unit</label>
                        <div class="col-md-10">
                            <input type="radio" name="unit" {{ $ItemsArr->unit == 'goods' ? 'checked' : '' }}
                                value="goods" id="unit"> <label for="goods">Goods</label>
                            <input type="radio" name="unit" {{ $ItemsArr->unit == 'service' ? 'checked' : '' }}
                                id="unit" value="service"> <label for="Service">Service</label>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-2 col-form-label">Name <em class="star">*</em></label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="name" id="name"
                                value="{{ $ItemsArr->name ?? '' }}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="sku" class="col-md-2 col-form-label">SKU <em class="star">*</em></label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="sku" id="sku"
                                value="{{ $ItemsArr->sku ?? '' }}" />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="select2Unit" class="col-md-2 col-form-label">Unit</label>
                        <div class="col-md-10">
                            <select id="select2Unit"
                                class="col-md-10 select2 form-control form-select-md select2 form-select form-select-lg select2-hidden-accessible"
                                data-allow-clear="true">
                                <option value="box">Box</option>
                                <option value="dozen">Dozen</option>
                                <option value="grams">Grams</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-url-input" class="col-md-2 col-form-label">Dimensions((Length X Width X
                            Height))</label>
                        <div class="col-md-10">
                            <input class="form-control" name="dimensions" type="text" id="html5-url-input"
                                value="{{ $ItemsArr->dimensions ?? '' }}" />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="manufacturer" class="col-md-2 col-form-label">Manufacturer</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="manufacturer" id="manufacturer"
                                value="{{ $ItemsArr->manufacturer ?? '' }}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="upc" class="col-md-2 col-form-label">UPC</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="upc" id="upc"
                                value="{{ $ItemsArr->upc ?? '' }}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ean" class="col-md-2 col-form-label">EAN</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="ean" id="ean"
                                value="{{ $ItemsArr->ean ?? '' }}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="weight" class="col-md-2 col-form-label">Weight</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="weight" id="weight"
                                value="{{ $ItemsArr->weight ?? '' }}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="brand" class="col-md-2 col-form-label">Brand</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="brand" id="brand"
                                value="{{ $ItemsArr->brand ?? '' }}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-month-input" class="col-md-2 col-form-label">MPN</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="mpn" id="html5-month-input"
                                value="{{ $ItemsArr->name ?? '' }}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-week-input" class="col-md-2 col-form-label">ISBN</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="isbn" id="html5-week-input"
                                value="{{ $ItemsArr->isbn ?? '' }}" autocomplete="off" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sales Information -->
            <div class="card">
                <h5 class="card-header">Sales Information</h5>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="selling_price" class="form-label">Selling Price <em class="star">*</em></label>
                        <input class="form-control" type="text" name="selling_price" id="selling_price"
                            value="{{ $ItemsArr->selling_price ?? '' }}" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="account" class="form-label">Account <em class="star">*</em></label>
                        <input class="form-control" type="text" name="account" id="account"
                            value="{{ $ItemsArr->account ?? '' }}" autocomplete="off">
                    </div>
                    <div>
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Description" cols="4"
                            rows="4">{{ $ItemsArr->description ?? '' }}</textarea>
                    </div>
                </div>
            </div>


            <!-- Purchase Information -->
            <div class="card">
                <h5 class="card-header">Purchase Information</h5>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="cost_price" class="form-label">Cost Price <em class="star">*</em></label>
                        <input class="form-control" type="text" name="cost_price" id="cost_price"
                            value="{{ $ItemsArr->cost_price ?? '' }}" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="purchase_account" class="form-label">Account <em class="star">*</em></label>
                        <input class="form-control" type="text" name="purchase_account" id="purchase_account"
                            value="{{ $ItemsArr->purchase_account ?? '' }}" autocomplete="off">
                    </div>
                    <div>
                        <label for="purchase_description" class="form-label">Description</label>
                        <textarea class="form-control" name="purchase_description" id="purchase_description"
                            placeholder="Purchase Description" cols="4" rows="4">{{ $ItemsArr->purchase_description ?? '' }}</textarea>
                    </div>
                    <div>
                        <label for="preferred_vendor" class="form-label">Preferred Vendor</label>
                        <input class="form-control" type="text" name="preferred_vendor" id="preferred_vendor"
                            value="{{ $ItemsArr->preferred_vendor ?? '' }}" autocomplete="off">
                    </div>

                </div>
            </div>


            <!-- Track Inventory for this item -->
            <div class="card">
                <h5 class="card-header">Track Inventory for this item</h5>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="opening_stock" class="form-label">Opening Stock</label>
                        <input class="form-control" type="text" name="opening_stock" id="opening_stock"
                            value="{{ $ItemsArr->opening_stock ?? '' }}" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="opening_stock_rate_per_unit" class="form-label">Opening Stock Rate per Unit</label>
                        <input class="form-control" type="text" name="opening_stock_rate_per_unit"
                            id="opening_stock_rate_per_unit" value="{{ $ItemsArr->opening_stock_rate_per_unit ?? '' }}"
                            autocomplete="off">
                    </div>


                    <div>
                        <label for="reorder_point" class="form-label">Reorder Point</label>
                        <input class="form-control" type="text" name="reorder_point" id="reorder_point"
                            value="{{ $ItemsArr->reorder_point ?? '' }}" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="card">
                <h5 class="card-header">Track Inventory for this item</h5>
                <div class="card-body">
                    <div class="input-group">
                        <input type="file" class="form-control" name="images[]"
                            accept="image/x-png,image/gif,image/jpeg" multiple id="inputGroupFile02">
                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                        <div class="inputGroupFile02-error"></div>
                    </div>
                    <div id="previewContainer" class="pt-2">

                    </div>

                    <div id="previewContainer-old" class="pt-2">

                        {{-- @dd(getItemImage($ItemsArr->id, 'item_image')); --}}
                        @if (getItemImage($ItemsArr->id, 'item_image'))
                            @foreach (getItemImage($ItemsArr->id, 'item_image') as $k => $image)
                                <span class="preview-image">
                                    <img style="height: 10em;width:10em; img-thumbnail pt-4" src="{{ $image->image }}"
                                        alt="Item Image" srcset="Item Image"><span class="remove-button">&times;</span>
                                </span>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
            <input type="hidden" name="submit" id="submit_hidden" class="submit_hidden">
            <button type="submit" class="btn btn-success submit" id="myform-submit-btn"
                style="display:none;">Submit</button>

            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <a href="{{ route('inventory.items') }}" class="btn btn-primary float-left ">Back</a>
                        <button type="button" class="btn btn-success submit-all float-right">Submit</button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Multi  -->
        {{-- <div class="col-12"> --}}
        {{-- <div class="card mb-4">
            <h5 class="card-header">Multiple</h5>
            <div class="card-body">
                <form action="/" class="dropzone needsclick dropzone-multi-form" id="dropzone-multi"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="satz" value="satz">
                    <div class="dz-message needsclick">
                        Drop files here or click to upload
                        <span class="note needsclick">(This is just a demo dropzone. Selected files are <span
                                class="fw-medium">not</span> actually uploaded.)</span>
                    </div>
                    <div class="fallback">
                        <input type="file" name="images[]" accept="image/x-png,image/gif,image/jpeg" />
                    </div>
                    <button type="submit" class="btn btn-success submit" id="multi-submit-btn"
                        style="display:none;">Submit</button>
                </form>
            </div>
        </div> --}}
        {{-- </div> --}}
        <!-- Multi  -->
    </div>
@endsection

{{-- @section('Datatable')

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
@endsection --}}
@section('pagescript')
    <script>
        $(document).ready(function() {
            $('#inputGroupFile02').on('change', function(e) {
                var files = e.target.files;

                // Clear the previous preview
                $('#previewContainer').empty();

                for (var i = 0; i < files.length; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        var imageUrl = event.target.result;
                        addImageToPreview(imageUrl);
                    };
                    reader.readAsDataURL(files[i]);
                }
            });

            function addImageToPreview(imageUrl) {
                var previewContainer = $('#previewContainer');

                var imageElement = $('<div class="preview-image"><img hieght="250em" width="200em" src="' +
                    imageUrl +
                    '" class="img-thumbnail"><span class="remove-button-js">&times;</span></div>');

                // Append the image element to the container
                previewContainer.append(imageElement);

                // Attach a click event to the remove button
                imageElement.find('.remove-button-js').on('click', function() {
                    imageElement.remove();
                });
            }
        });
    </script>
@endsection
