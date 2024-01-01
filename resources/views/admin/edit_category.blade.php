@extends('layout.admin_master')
@section('title', 'Edit Category | ')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Category</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('category') }}">Category</a></li>
                        <li class="breadcrumb-item active">Edit Category</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-12">
                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
                    </div>
                    <div class="card-body">
                      <form class="row" method="POST" action="{{route('category.update')}}">
                            @csrf
                            <div class="form-group col-md-8">
                                <label class="control-label">Category Name</label>
                                <input type="hidden" name="id" value="{{$category->id}}">
                                <input name="name" value="{{ $category->name }}" class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Enter your name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
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
