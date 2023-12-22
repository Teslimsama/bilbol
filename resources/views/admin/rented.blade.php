@extends('layout.admin_master')
@section('content')
    {{-- stuffs --}}
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Rented Inventory</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Rented Inventories</h6>
            </div>
            <div class="card-body">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Rented Inventory</h3>
                        </div>
                        <div class="col-auto text-end float-end ms-auto download-grp">
                            <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                Download</a>
                            <a href="{{ route('rented.add') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Rented date</th>
                                <th>Return date</th>
                                <th>Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Rented date</th>
                                <th>Return date</th>
                                <th>Amount</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($renteds as $rented)
                                <tr>
                                    <td hidden class="id">{{ $rented->id }}</td>
                                    <td>{{ 1000 + $rented->id }}</td>
                                    <td>{{ $rented->user->name }}</td>
                                    <td>{{ $rented->user->address }}</td>
                                    <td>{{ $rented->user->email }}</td>
                                    <td>{{ $rented->user->phone_number }}</td>
                                    <td>
                                        @if ($rented->payments)
                                            {{ $rented->payments->rented_date }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if ($rented->payments)
                                            {{ $rented->payments->return_date }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if ($rented->payments)
                                            ${{ $rented->payments->amount }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <a href="{{ url('rented/edit/' . $rented->id) }}"
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
@endsection
