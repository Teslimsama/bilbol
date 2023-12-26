@extends('layout.admin_master')
@section('content')
    {{-- stuffs --}}
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Users</h1>
        {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
                DataTables documentation</a>.</p> --}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="card-body">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Users</h3>
                        </div>
                        <div class="col-auto text-end float-end ms-auto download-grp">

                            <a href="{{ route('users.add') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Role</th>
                                <th>Join date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Role</th>
                                <th>Join Date</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($UsersList as $key => $list)
                                <tr>
                                    <td hidden class="id">{{ $list->id }}</td>
                                    <td>{{ $list->name }}</td>
                                    <td>{{ $list->address }}</td>
                                    <td>{{ $list->email }}</td>
                                    <td>{{ $list->phone_number }}</td>
                                    <td>{{ $list->role_name }}</td>
                                    <td>{{ $list->join_date }}</td>
                                    <td>
                                        <div class="actions">
                                            <a href="{{ url('users/edit/' . $list->id) }}"
                                                class="btn btn-sm bg-danger-light">
                                                <i class="fas fa-fw fa-edit"></i>
                                            </a>
                                            <a class="btn btn-sm bg-danger-light delete_modal" href="#"
                                                data-toggle="modal" data-target="#deleteModal">
                                                <i class="fas fa-fw fa-trash me-1"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@section('delete')
    {{ route('users.delete') }}
@endsection
@section('script')
    <!-- Page level plugins -->
    <script src="{{ URL::to('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::to('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endsection
@endsection
