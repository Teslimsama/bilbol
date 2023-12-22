@extends('layout.admin_master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-12">
                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Add Rented Inventory</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('rented.save') }}">
                            @csrf
                            <div class="form-group col-md-3">
                                <label class="control-label">User Name</label>
                                <select name="user_id" class="form-control">
                                    <option>Select user</option>
                                    @foreach ($users as $user)
                                        <option name="user_id" value="{{ $user->id }}">{{ $user->name }}
                                        </option>
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
                                        <th scope="col">Inventory</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Discount %</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Rented Date</th>
                                        <th scope="col">Return Date</th>
                                        <th scope="col"><a class="addRow badge badge-success text-white"><i
                                                    class="fa fa-plus"></i> Add Row</a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><select name="inventory_id[]" class="form-control inventoryname">
                                                <option>Select inventory</option>
                                                @foreach ($inventorys as $inventory)
                                                    <option name="inventory_id[]" value="{{ $inventory->id }}">
                                                        {{ $inventory->name }}</option>
                                                @endforeach
                                            </select></td>
                                        <td><input type="text" name="qty[]" class="form-control qty"></td>
                                        <td><input type="text" name="price[]" class="form-control price"></td>
                                        <td><input type="text" name="dis[]" class="form-control dis"></td>
                                        <td><input type="text" name="amount[]" class="form-control amount"></td>
                                        <td><input type="date" name="rented_date[]" class="form-control datepicker"></td>
                                        <td><input type="date" name="return_date[]" class="form-control datepicker"></td>
                                        <td><a class="btn btn-danger remove"> <i class="fa fa-remove"></i></a></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>Total</b></td>
                                        <td><b class="total"></b></td>
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
@section('script')
    <script src="{{ URL::to('assets/js/multifield/jquery.multifield.min.js')}}"></script>
    <script>
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
        '    <td><input type="date" name="rented_date[]"  class="form-control datepicker"></td>\n' +
        '    <td><input type="date" name="return_date[]"  class="form-control datepicker"></td>\n' +
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
@endsection
