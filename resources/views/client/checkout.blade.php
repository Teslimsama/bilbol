@extends('layout.master')
@section('title', 'Checkout | ')
@section('content')
    {{-- stuffs --}}
    <style>
        .card {
            margin-bottom: 24px;
            -webkit-box-shadow: 0 2px 3px #e4e8f0;
            box-shadow: 0 2px 3px #e4e8f0;
        }

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid #eff0f2;
            border-radius: 1rem;
        }

        .activity-checkout {
            list-style: none
        }

        .activity-checkout .checkout-icon {
            position: absolute;
            top: -4px;
            left: -24px
        }

        .activity-checkout .checkout-item {
            position: relative;
            padding-bottom: 24px;
            padding-left: 35px;
            border-left: 2px solid #f5f6f8
        }

        .activity-checkout .checkout-item:first-child {
            border-color: #6A704C
        }

        .activity-checkout .checkout-item:first-child:after {
            background-color: #6A704C
        }

        .activity-checkout .checkout-item:last-child {
            border-color: transparent
        }

        .activity-checkout .checkout-item.crypto-activity {
            margin-left: 50px
        }

        .activity-checkout .checkout-item .crypto-date {
            position: absolute;
            top: 3px;
            left: -65px
        }

        .avatar-xs {
            height: 1rem;
            width: 1rem
        }

        .avatar-sm {
            height: 2rem;
            width: 2rem
        }

        .avatar {
            height: 3rem;
            width: 3rem
        }

        .avatar-md {
            height: 4rem;
            width: 4rem
        }

        .avatar-lg {
            height: 5rem;
            width: 5rem
        }

        .avatar-xl {
            height: 6rem;
            width: 6rem
        }

        .avatar-title {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            background-color: #6A704C;
            color: #fff;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            font-weight: 500;
            height: 100%;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            width: 100%
        }

        .avatar-group {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            padding-left: 8px
        }

        .avatar-group .avatar-group-item {
            margin-left: -8px;
            border: 2px solid #fff;
            border-radius: 50%;
            -webkit-transition: all .2s;
            transition: all .2s
        }

        .avatar-group .avatar-group-item:hover {
            position: relative;
            -webkit-transform: translateY(-2px);
            transform: translateY(-2px)
        }

        .card-radio {
            background-color: #fff;
            border: 2px solid #eff0f2;
            border-radius: .75rem;
            padding: .5rem;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: block
        }

        .card-radio:hover {
            cursor: pointer
        }

        .card-radio-label {
            display: block
        }

        .edit-btn {
            width: 35px;
            height: 35px;
            line-height: 40px;
            text-align: center;
            position: absolute;
            right: 25px;
            margin-top: -50px
        }

        .card-radio-input {
            display: none
        }

        .card-radio-input:checked+.card-radio {
            border-color: #6A704C !important
        }

        .font-size-16 {
            font-size: 16px !important;
        }

        .text-truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        a {
            text-decoration: none !important;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.47rem 0.75rem;
            font-size: .875rem;
            font-weight: 400;
            line-height: 1.5;
            color: #545965;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #e2e5e8;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.75rem;
            -webkit-transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
        }

        .edit-btn {
            width: 35px;
            height: 35px;
            line-height: 40px;
            text-align: center;
            position: absolute;
            right: 25px;
            margin-top: -50px;
        }

        .ribbon {
            position: absolute;
            right: -26px;
            top: 20px;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            color: #fff;
            font-size: 13px;
            font-weight: 500;
            padding: 1px 22px;
            font-size: 13px;
            font-weight: 500
        }

        .paystack-button {
            background-color: #6A704C;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .paystack-button:hover {
            background-color: #6a704ca6;
        }
    </style>
    <div class="container">

        <div class="row mt-5">
            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body">
                        <ol class="activity-checkout mb-0 px-4 mt-3">
                            <li class="checkout-item">
                                <div class="avatar checkout-icon p-1">
                                    <div class="avatar-title rounded-circle bg-primary">
                                        <i class="fas fa-receipt text-white font-size-20"></i>
                                    </div>
                                </div>
                                <div class="feed-item-list">
                                    <div>
                                        <h5 class="font-size-16 mb-1">Billing Info</h5>
                                        <p class="text-muted text-truncate mb-4">Sed ut perspiciatis unde omnis iste</p>
                                        <div class="mb-3">
                                            <form method="post" action="{{ route('pay') }}">
                                                {{-- @csrf --}}
                                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="billing-name">First Name</label>
                                                                <input type="text" class="form-control" name="first_name"
                                                                    placeholder=" Enter First name">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="billing-name">Last Name</label>
                                                                <input type="text" class="form-control" name="last_name"
                                                                    placeholder="Enter Last name">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="billing-email-address">Email
                                                                    Address</label>
                                                                <input type="email" class="form-control"
                                                                    name="email" placeholder="Enter email">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="billing-phone">Phone</label>
                                                                <input type="text" class="form-control"
                                                                    name="phone" placeholder="Enter Phone no.">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label" for="billing-address">Address</label>
                                                        <textarea class="form-control" name="address" rows="3" placeholder="Enter full address"></textarea>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="checkout-item">
                                <div class="avatar checkout-icon p-1">
                                    <div class="avatar-title rounded-circle bg-primary">
                                        <i class="fas fa-wallet text-white font-size-20"></i>
                                    </div>
                                </div>
                                <div class="feed-item-list">
                                    <div>
                                        <h5 class="font-size-16 mb-1">Payment Info</h5>
                                        <p class="text-muted text-truncate mb-4">Duis arcu tortor, suscipit eget</p>
                                    </div>
                                    <div>
                                        <h5 class="font-size-14 mb-3">Payment method :</h5>
                                        <div class="row">
                                            {{-- <div class="col-lg-3 col-sm-6">
                                                <div data-bs-toggle="collapse">
                                                    <label class="card-radio-label">
                                                        <input type="radio" name="pay-method" id="pay-methodoption1"
                                                            class="card-radio-input">
                                                        <span class="card-radio py-3 text-center text-truncate">
                                                            <i class="fas fa-credit-card d-block h2 mb-3"></i>
                                                            Credit / Debit Card
                                                        </span>
                                                    </label>
                                                </div>
                                            </div> --}}

                                            <div class="col-lg-3 col-sm-6">
                                                <div>
                                                    <label class="card-radio-label">
                                                        <input type="radio" name="pay-method" id="pay-methodoption2"
                                                            class="card-radio-input">
                                                        <span class="card-radio py-3 text-center text-truncate">
                                                            <i class="fas fa-paypal d-block h2 mb-3"></i>
                                                            Paystack
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-sm-6">
                                                <div>
                                                    <label class="card-radio-label">
                                                        <input type="radio" name="pay-method" id="pay-methodoption3"
                                                            class="card-radio-input" checked="">

                                                        <span class="card-radio py-3 text-center text-truncate">
                                                            <i class="fas fa-money-bill d-block h2 mb-3"></i>
                                                            <span>Cash on Delivery</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ol>
                    </div>

                </div>
                <div class="row my-4">
                    <div class="col">
                        <a href="{{ route('shop') }}" class="btn btn-link text-muted">
                            <i class="fas fa-arrow-left me-1"></i> Continue Shopping </a>
                    </div> <!-- end col -->
                    <div class="col">
                        <div class="text-end mt-2 mt-sm-0">
                            <button type="submit" class="paystack-button">
                                <i class="fas fa-shopping-cart me-1"></i> Proceed to Pay
                            </button>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row-->
            </div>
            <div class="col-xl-4">
                <div class="card checkout-order-summary">
                    <div class="card-body">
                        {{-- <div class="p-3 bg-light mb-3">
                            <h5 class="font-size-16 mb-0">Order Summary <span class="float-end ms-2">#MN0124</span></h5>
                        </div> --}}
                        <div class="table-responsive">
                            <table class="table table-centered mb-0 table-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-top-0" style="width: 110px;" scope="col">Product</th>
                                        <th class="border-top-0" scope="col">Product Desc</th>
                                        <th class="border-top-0" scope="col">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0 @endphp
                                    @if (session('cart'))
                                        @foreach (session('cart') as $id => $details)
                                        {{-- {{    print_r($detail)}}; --}}
                                            @php
                                                // Convert quantity to a valid numeric value, default to 0 if not a valid number
                                                $quantity = is_numeric($details['quantity']) ? intval($details['quantity']) : 0;
                                                $subtotal = floatval($details['payments_price']) * $quantity;
                                                $total += $subtotal;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('img') }}/{{ $details['image'] }}"
                                                        alt="product-img" title="product-img" class="avatar-lg rounded">
                                                       <input type="hidden" name="id[]" value="{{$details['id']}}">

                                                        <input type="hidden" name="qty[]" value="{{$details['quantity']}}">
                                                        <input type="hidden" name="price[]" value="{{$details['payments_price']}}">
                                                </td>
                                                <td>
                                                    <h5 class="font-size-16 text-truncate">
                                                        <a href="#" class="text-dark">{{ $details['name'] }}</a>
                                                    </h5>
                                                    <p class="text-muted mb-0 mt-1">₦{{ $details['payments_price'] }} x
                                                        {{ $details['quantity'] }}</p>
                                                </td>
                                                <td>₦{{ $subtotal }}</td>
                                            </tr>
                                        @endforeach
                                        
    
                                        <tr class="bg-light">
                                            <td colspan="2">
                                                <h5 class="font-size-14 m-0">Total:</h5>
                                            </td>
                                            <td>
                                                ₦{{ $total }}
                                                <input type="hidden" name="amount" value="{{ $total }}">
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </form>

        </div>
        <!-- end row -->

    </div>
@endsection
