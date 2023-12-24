@extends('layout.admin_master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Users</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('users') }}">Users</a></li>
                        <li class="breadcrumb-item active">Edit Users</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-12">
                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Add User</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.update') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>User Information</span></h5>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>User ID <span class="login-danger">*</span></label>
                                        <input type="text" name="id" class="form-control" value="{{$userEdit->id}}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>User Name <span class="login-danger">*</span></label>
                                        <input type="text" value="{{$userEdit->name}}" name="user_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Phone Number <span class="login-danger">*</span></label>
                                        <input type="tel" name="phone_number" value="{{$userEdit->phone_number}}" class="form-control">

                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Email <span class="login-danger">*</span></label>
                                        <input type="email" name="email"  value="{{$userEdit->email}}" class="form-control">

                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Address <span class="login-danger">*</span></label>
                                        <textarea name="address" id="address" class="form-control"> {{$userEdit->address}}</textarea>
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
