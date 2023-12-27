@extends('layout.admin_master')
@section('content')
    {{-- stuffs --}}
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Inventory List</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Inventories</h6>
            </div>
            <div class="card-body">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Inventory</h3>
                        </div>
                        <div class="col-auto text-end float-end ms-auto download-grp">

                            <a href="{{ route('inventory.add') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($inventoryList as $key => $list)
                                <tr>
                                    <td hidden class="id">{{ $list->id }}</td>
                                    <td>{{ $list->name }}</td>
                                    <td>{{ $list->quantity }}</td>
                                    <td>₦{{ $list->payments_price }}</td>
                                    <td>{{ $list->description }}</td>
                                    <td>
                                        <div class="actions">
                                            <a href="{{ url('inventory/edit/' . $list->id) }}"
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
    {{ route('inventory.delete') }}
@endsection
@section('script')
    <script src="{{ URL::to('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::to('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endsection
@endsection
