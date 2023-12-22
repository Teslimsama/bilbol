@extends('layout.admin_master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Rented Inventory</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('rented') }}">Rented Inventory</a></li>
                        <li class="breadcrumb-item active">Edit Rented Eqipments</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-12">
                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Rented Inventory</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('rented.update') }}">
                            @csrf
                            {{-- @method('PUT') --}}
                            <div class="form-group col-md-3">
                                <label class="control-label">User Name</label>
                                <input type="hidden" name="id" value="{{ $rented->id }}">
                                <select name="user_id" class="form-control">
                                    <option name="user_id" value="{{ $rented->user->id }}">{{ $rented->user->name }}
                                    </option>
                                    @foreach ($users as $user)
                                        <option name="user_id" value="{{ $user->id }}">{{ $user->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Date</label>
                                <input name="date" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>"
                                    type="date" placeholder="Enter your email">
                            </div>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Inventory Name</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Discount</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Rented Date</th>
                                        <th scope="col">Return Date</th>
                                        <th scope="col"><a class="addRow"><i class="fa fa-plus"></i></a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td><select name="inventory_id[]" class="form-control inventoryname">
                                                    <option name="inventory_id[]" value="{{ $payment->inventory->id }}">
                                                        {{ $payment->inventory->name }}</option>
                                                    @foreach ($inventorys as $inventory)
                                                        <option name="inventory_id[]" value="{{ $inventory->id }}">
                                                            {{ $inventory->name }}</option>
                                                    @endforeach
                                                </select></td>
                                            <td><input value="{{ $payment->qty }}" type="text" name="qty[]"
                                                    class="form-control qty">
                                                <input type="hidden" name="tx_ref" value="{{ $payment->tx_ref }}">
                                            </td>
                                            <td><input value="{{ $payment->price }}" type="text"
                                                    class="form-control price" name="price[]">
                                                <input type="hidden" name="tx_ref" value="{{ $payment->tx_id }}">
                                            </td>
                                            <td><input value="{{ $payment->dis }}" type="text" name="dis[]"
                                                    class="form-control dis"></td>
                                            <td><input value="{{ $payment->amount }}" type="text" name="amount[]"
                                                    class="form-control amount"></td>
                                            <td><input type="date" name="rented_date[]"
                                                    value="{{ $payment->rented_date }}" class="form-control datepicker">
                                            </td>
                                            <td><input type="date" name="return_date[]"
                                                    value="{{ $payment->return_date }}" class="form-control datepicker">
                                            </td>
                                            <td><a class="btn btn-danger remove"> <i class="fa fa-remove"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>Total</b></td>
                                        <td>₦<b class="total"></b></td>
                                        <td></td>
                                    </tr>
                                </tfoot>

                            </table>

                            <div>
                                <button class="btn btn-primary" type="submit">Submit</button>
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

    <script type="text/javascript">
        $(document).ready(function() {



            $('tbody').delegate('.inventoryname', 'change', function() {

                var tr = $(this).parent().parent();
                tr.find('.qty').focus();

            })

            $('tbody').delegate('.inventoryname', 'change', function() {

                var tr = $(this).parent().parent();
                var id = tr.find('.inventoryname').val();
                var dataId = {
                    'id': id
                };
                $.ajax({
                    type: 'GET',
                    url: '{!! URL::route('findPrice') !!}',

                    dataType: 'json',
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        'id': id
                    },
                    success: function(data) {
                        tr.find('.price').val(data.payments_price);
                    }
                });
            });

            $('tbody').delegate('.qty,.price,.dis', 'keyup', function() {

                var tr = $(this).parent().parent();
                var qty = tr.find('.qty').val();
                var price = tr.find('.price').val();
                var dis = tr.find('.dis').val();
                var amount = (qty * price) - (qty * price * dis) / 100;
                tr.find('.amount').val(amount);
                total();
            });

            function total() {
                var total = 0;
                $('.amount').each(function(i, e) {
                    var amount = $(this).val() - 0;
                    total += amount;
                })
                $('.total').html(total);
            }

            $('.addRow').on('click', function() {
                addRow();

            });

            function addRow() {
    var addRow = '<tr>\n' +
        '    <td>' +
        '        <select name="inventory_id[]" class="form-control inventoryname">' +
        '            <option value="0" selected="true" disabled="true">Select inventory</option>';

    @foreach ($inventorys as $inventory)
        addRow += '<option value="{{ $inventory->id }}">{{ $inventory->name }}</option>';
    @endforeach

    addRow += '</select>' +
        '    </td>\n' +
        '    <td>' +
        '        <input type="text" name="qty[]" class="form-control qty">' +
        '    </td>\n' +
        '    <td><input type="text" name="price[]" class="form-control price"></td>\n' +
        '    <td><input type="text" name="dis[]" class="form-control dis"></td>\n' +
        '    <td><input type="text" name="amount[]" class="form-control amount"></td>\n' +
        '    <td><input type="date" name="rented_date[]" class="form-control datepicker"></td>\n' +
        '    <td><input type="date" name="return_date[]" class="form-control datepicker"></td>\n' +
        '    <td><a class="btn btn-danger remove"><i class="fa fa-remove"></i></a></td>\n' +
        '</tr>';

    $('tbody').append(addRow);
}



            $('.remove').live('click', function() {
                var l = $('tbody tr').length;
                if (l == 1) {
                    alert('you cant delete last one')
                } else {

                    $(this).parent().parent().remove();

                }

            });
        });
    </script>
@endsection
