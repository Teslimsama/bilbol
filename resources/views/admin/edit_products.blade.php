@extends('layout.admin_master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Add Books</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('inventory') }}">Inventory</a></li>
                        <li class="breadcrumb-item active">Edit Eqipments</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-12">
                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Product</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('inventory.update') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Product Information</span></h5>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Product ID <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" name="id"
                                            value="{{ $inventoryEdit->id }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Product Name <span class="login-danger">*</span></label>
                                        <input type="text" name="product_name" value="{{ $inventoryEdit->name }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Price <span class="login-danger">*</span></label>
                                        <input type="text" name="price" value="{{ $inventoryEdit->price }}"
                                            class="form-control">

                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Quantity <span class="login-danger">*</span></label>
                                        <input type="number" name="quantity" value="{{ $inventoryEdit->quantity }}"
                                            class="form-control">

                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Description <span class="login-danger">*</span></label>
                                        <textarea name="description" id="description" class="form-control">{{ $inventoryEdit->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="student-submit">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
