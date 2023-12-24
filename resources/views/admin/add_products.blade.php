@extends('layout.admin_master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Add Equipments</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('inventory') }}">Inventory</a></li>
                        <li class="breadcrumb-item active">Add Eqipments</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-12">
                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Add Product</h6>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('inventory.save') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">Product</label>
                                    <input name="name" class="form-control @error('name') is-invalid @enderror"
                                        type="text" placeholder="Product Name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Serial Number</label>
                                    <input name="serial_number"
                                        class="form-control @error('serial_number') is-invalid @enderror" type="number"
                                        placeholder="Enter Serial Number">
                                    @error('serial_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label">Model</label>
                                    <input name="model" class="form-control @error('name') is-invalid @enderror"
                                        type="text" placeholder="Enter Model">
                                    @error('model')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Category</label>

                                    <select name="category_id" class="form-control">
                                        <option>---Select Category---</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Quantity</label>
                                    <input name="quantity" class="form-control @error('quantity') is-invalid @enderror"
                                        type="number" placeholder="Enter Quantity">
                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Selling Price</label>
                                    <input name="payments_price"
                                        class="form-control @error('payments_price') is-invalid @enderror" type="number"
                                        placeholder="Enter Selling Price">
                                    @error('payments_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label">Image</label>
                                    <input name="image" class="form-control @error('image') is-invalid @enderror"
                                        type="file">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="tile">

                                <div id="example-2" class="content">
                                    <div class="group row">
                                        <div class="form-group col-md-5">
                                            <select name="supplier_id[]" class="form-control">
                                                <option>Select Supplier</option>
                                                @foreach ($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}">{{ $supplier->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <input name="supplier_price[]"
                                                class="form-control @error('supplier_price') is-invalid @enderror"
                                                type="number" placeholder="Purchase Price">
                                            <span
                                                class="text-danger">{{ $errors->has('additional_body') ? $errors->first('body') : '' }}</span>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <button type="button" id="btnAdd-2"
                                                class="btn btn-success btn-sm float-right"><i
                                                    class="fa fa-plus"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm btnRemove float-right"><i
                                                    class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4 align-self-end">
                                <button class="btn btn-success" type="submit"><i
                                        class="fa fa-fw fa-lg fa-check-circle"></i>Add Product</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::to('assets/js/multifield/jquery.multifield.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML =
                '<div><select name="supplier_id[]" class="form-control"><option class="form-control">Select Supplier</option>@foreach ($suppliers as $supplier)<option value="{{ $supplier->id }}">{{ $supplier->name }}</option>@endforeach</select><input name="supplier_price[]" class="form-control" type="text" placeholder="Enter Sales Price"><a href="javascript:void(0);" class="remove_button btn btn-danger" title="Delete field"><i class="fa fa-minus"></i></a></div>'
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function() {
                //Check maximum number of input fields
                if (x < maxField) {
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e) {
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });

            $('#example-2').multifield({
                section: '.group',
                btnAdd: '#btnAdd-2',
                btnRemove: '.btnRemove'
            });
        });
    </script>
@endsection
