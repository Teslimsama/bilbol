@extends('layout.master')
@section('title', 'Cart | ')
@section('content')
    <style>
        .cart-product-imitation {
            text-align: center;
            padding-top: 30px;
            height: 80px;
            width: 80px;
            background-color: #f8f8f9;
        }

        .product-imitation.xl {
            padding: 120px 0;
        }

        .product-desc {
            padding: 20px;
            position: relative;
        }

        .ecommerce .tag-list {
            padding: 0;
        }

        .ecommerce .fa-star {
            color: #d1dade;
        }

        .ecommerce .fa-star.active {
            color: #f8ac59;
        }

        .ecommerce .note-editor {
            border: 1px solid #e7eaec;
        }

        table.shoping-cart-table {
            margin-bottom: 0;
        }

        table.shoping-cart-table tr td {
            border: none;
            text-align: right;
        }

        table.shoping-cart-table tr td.desc,
        table.shoping-cart-table tr td:first-child {
            text-align: left;
        }

        table.shoping-cart-table tr td:last-child {
            width: 80px;
        }

        .ibox {
            clear: both;
            margin-bottom: 25px;
            margin-top: 0;
            padding: 0;
        }

        .ibox.collapsed .ibox-content {
            display: none;
        }

        .ibox:after,
        .ibox:before {
            display: table;
        }

        .ibox-title {
            -moz-border-bottom-colors: none;
            -moz-border-left-colors: none;
            -moz-border-right-colors: none;
            -moz-border-top-colors: none;
            background-color: #ffffff;
            border-color: #e7eaec;
            border-image: none;
            border-style: solid solid none;
            border-width: 3px 0 0;
            color: inherit;
            margin-bottom: 0;
            padding: 14px 15px 7px;
            min-height: 48px;
        }

        .ibox-content {
            background-color: #ffffff;
            color: inherit;
            padding: 15px 20px 20px 20px;
            border-color: #e7eaec;
            border-image: none;
            border-style: solid solid none;
            border-width: 1px 0;
        }

        .ibox-footer {
            color: inherit;
            border-top: 1px solid #e7eaec;
            font-size: 90%;
            background: #ffffff;
            padding: 10px 15px;
        }
    </style>
    <div class="container">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row mt-5">
                <div class="col-md-9">
                    <div class="ibox">
                        <div class="ibox-title">
                            <span class="pull-right">(<strong>{{ count($cart) }}</strong>) items</span>
                            <h5>Items in your cart</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-bordered shoping-cart-table">
                                    <tbody>
                                        @php $total = 0 @endphp
                                        @if (session('cart'))
                                            @foreach (session('cart') as $id => $details)
                                                {{-- @php $total += $details['payments_price'] * $details['quantity'] @endphp --}}
                                                @php
                                                    // Convert quantity to a valid numeric value, default to 0 if not a valid number
                                                    $quantity = is_numeric($details['quantity']) ? intval($details['quantity']) : 0;
                                                    $total += floatval($details['payments_price']) * $quantity;
                                                @endphp
                                                <tr data-id="{{ $id }}">
                                                    <td width="90">
                                                        <div class="cart-product-imitation"><img
                                                                src="{{ asset('img') }}/{{ $details['image'] }}"
                                                                width="100" height="100" class="img-responsive" />
                                                        </div>
                                                    </td>
                                                    <td class="desc">
                                                        <h3>
                                                            <a href="#" class="text-primary">
                                                                {{ $details['name'] }}
                                                            </a>
                                                        </h3>
                                                        
                                                        <dl class="small m-b-none">
                                                            <dt>Description lists</dt>
                                                            <dd>A description list is perfect for defining terms.</dd>
                                                        </dl>
                                                        <div class="m-t-sm">
                                                            <a href="#" class="text-muted cart_remove"><i
                                                                    class="fas fa-trash"></i> Remove item</a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        ₦{{ $details['payments_price'] }}
                                                        <s class="small text-muted">₦{{ $details['payments_price'] }}</s>
                                                    </td>
                                                    <td width="65">
                                                        <div class='input-group quantity mx-auto' style='width: 100px;'>
                                                            <div class='input-group-btn'>
                                                                <button type="button"
                                                                    class='btn btn-sm btn-primary btn-minus'>
                                                                    <i class='fa fa-minus'></i>
                                                                </button>
                                                            </div>
                                                            <input type="number" id="quantity"
                                                                class="form-control form-control-sm bg-secondary text-center  quantity"
                                                                value="{{ $details['quantity'] }}" min="1" />
                                                            <div class='input-group-btn'>
                                                                <button type="button"
                                                                    class='btn btn-sm btn-primary btn-plus'>
                                                                    <i class='fa fa-plus'></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h4>
                                                            ₦{{ $details['payments_price'] * $details['quantity'] }}
                                                        </h4>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="ibox-content">
                            <a href="{{route('checkout')}}" class="btn btn-primary pull-right"><i class="fas fa-shopping-cart"></i>
                                Checkout</a>
                            <a href="{{route('shop')}}" class="btn btn-white"><i class="fas fa-arrow-left"></i> Continue shopping</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Cart Summary</h5>
                        </div>
                        <div class="ibox-content">
                            <span>
                                Total
                            </span>
                            <h2 class="font-bold">
                                ₦{{ $total }}
                            </h2>
                            <hr>
                            <div class="m-t-sm">
                                <div class="btn-group">
                                    <a href="{{route('checkout')}}" class="btn btn-primary btn-sm"><i class="fas fa-shopping-cart"></i>
                                        Checkout</a>
                                    {{-- <a href="#" class="btn btn-white btn-sm"> Cancel</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--                

                <div class="ibox">
                    <div class="ibox-content">
                        <p class="font-bold">
                            Other products you may be interested
                        </p>
                        <hr>
                        <div>
                            <a href="#" class="product-name"> Product 1</a>
                            <div class="small m-t-xs">
                                Many desktop publishing packages and web page editors now.
                            </div>
                            <div class="m-t text-right">
                                <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fas fa-long-arrow-alt-right"></i> </a>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <a href="#" class="product-name"> Product 2</a>
                            <div class="small m-t-xs">
                                Many desktop publishing packages and web page editors now.
                            </div>
                            <div class="m-t text-right">
                                <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fas fa-long-arrow-alt-right"></i> </a>
                            </div>
                        </div>
                    </div>
                </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @parent
    <script type="text/javascript">
        // Wrap your event bindings in a document ready function
        $(document).ready(function() {


            $(".cart_remove").click(function(e) {
                e.preventDefault();
                var ele = $(this);

                if (confirm("Do you really want to remove?")) {
                    $.ajax({
                        url: '{{ route('remove_from_cart') }}',
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: ele.parents("tr").attr("data-id")
                        },
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                }
            });

            $(".btn-plus").click(function(e) {
                e.preventDefault();
                var ele = $(this);

                // Use document.querySelector to get the quantity value
                var currentQuantity = parseInt(document.querySelector(`#quantity`).value);

                $.ajax({
                    url: '{{ route('update_cart') }}',
                    method: "patch",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.parents("tr").attr("data-id"),
                        quantity: currentQuantity + 1,
                        action: 'plus'
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            });

            $(".btn-minus").click(function(e) {
                e.preventDefault();
                var ele = $(this);

                // Use document.querySelector to get the quantity value
                var currentQuantity = parseInt(document.querySelector(`#quantity`).value);

                if (currentQuantity > 1) {
                    $.ajax({
                        url: '{{ route('update_cart') }}',
                        method: "patch",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: ele.parents("tr").attr("data-id"),
                            quantity: currentQuantity - 1,
                            action: 'minus'
                        },
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                }
            });

        });
    </script>
@endsection
