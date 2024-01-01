@extends('layout.admin_master')
@section('title', 'Edit Product | ')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Eqipments</h3>
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
                        <h6 class="m-0 font-weight-bold text-primary">Edit inventory</h6>
                    </div>
                    <div class="card-body">
                       <form method="POST" action="{{route('inventory.update')}}" enctype="multipart/form-data">
                            @csrf
                             <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">inventory Name</label>
                                    <input value="{{$additional->inventory->name}}" name="name" class="form-control @error('name') is-invalid @enderror" type="text" placeholder="inventory Name">
                                    <input value="{{$additional->inventory->id}}" name="id" class="form-control @error('id') is-invalid @enderror" type="hidden" >
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Serial Number</label>
                                    <input value="{{$additional->inventory->serial_number}}" name="serial_number" class="form-control @error('serial_number') is-invalid @enderror" type="number" placeholder="Enter Tax Name">
                                    @error('serial_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label">Model</label>
                                    <input value="{{$additional->inventory->model}}" name="model" class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Enter Tax Name">
                                    @error('model')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Category</label>

                                    <select name="category_id" class="form-control">
                                        <option value="{{$additional->inventory->category->id}}">{{$additional->inventory->category->name}}</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label">Selling Price</label>
                                    <input value="{{$additional->inventory->payments_price}}" name="payments_price" class="form-control @error('payments_price') is-invalid @enderror" type="number" placeholder="Enter Price">
                                    @error('payments_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Quantity</label>
                                    <input value="{{$additional->inventory->quantity}}" name="quantity" class="form-control @error('quantity') is-invalid @enderror" type="number" placeholder="Enter Quantity">
                                    @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label">Image</label>
                                    <input value="{{$additional->inventory->image}}" name="image"  class="form-control @error('image') is-invalid @enderror" type="file" >
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="tile ">
                                <div class="row field_wrapper">
                                     <div class="form-group col-md-4">
                                        <select name="supplier_id[]" class="form-control">
                                            <option value="{{$additional->supplier_id}}">{{$additional->supplier->name}} </option>
                                            @foreach($suppliers as $supplier)
                                                <option value="{{$supplier->id}}">{{$supplier->name}} </option>
                                            @endforeach
                                        </select>
                                        @error('supplier_id')
                                        <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input value="{{$additional->price}}"  name="supplier_price[]" class="form-control @error('supplier_price') is-invalid @enderror" type="number" placeholder="Enter Sales Price">
                                        @error('supplier_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <a href="javascript:void(0);" class="add_button btn btn-primary btn-sm" title="Add field"><i class="fa fa-plus"></i></a>
                                        <a href="javascript:void(0);" class="remove_button btn btn-danger btn-sm" title="Delete field"><i class="fa fa-minus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4 align-self-end">
                                <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
