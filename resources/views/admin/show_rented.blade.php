@extends('layout.admin_master')
@section('title', 'Show Rented | ')
@section('content')
    <div class="container-fluid">
        <main class="app-content">
            <div class="app-title">
                <div>
                    <h1><i class="fa fa-file-text-o"></i>Rented Invoice</h1>
                    <p>A Printable Rented Invoice Format</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                    <li class="breadcrumb-item"><a href="#">Rented Invoice</a></li>
                </ul>
            </div>
            <div class="row important-part mt-5">
                <div class="col-md-12">
                    <div class="tile">
                        <section class="rented">
                            <div class="row mb-4">
                                <div class="col-6">
                                    <h2 class="page-header"><i class="fa fa-file"></i> BilBol</h2>
                                </div>
                                <div class="col-6">
                                    <h5 class="text-right">Date: {{ $rented->created_at->format('Y-m-d') }}</h5>
                                </div>
                            </div>
                            <div class="row rented-info">
                                <div class="col-4">From
                                    <address>
                                        <strong>BilBol</strong>
                                        <br>
                                        Okitipupa Crescent
                                        <br>
                                        Information Quaters Phase 4
                                        <br>
                                        Flat 6, Block 9
                                        <br>
                                        Kubwa, Abuja.
                                        <br>
                                        <a href="https://bilbol.unibooks.com.ng" target="_blank" rel="noopener noreferrer">Bilbol.unibooks.com.ng</a>
                                    </address>
                                </div>
                                <div class="col-4">To
                                    <address>
                                        <strong>{{ $rented->user->name }}</strong>
                                        <br>{{ $rented->user->address }}<br>
                                        <b>Phone: </b>{{ $rented->user->phone_number }}
                                        <br>
                                        <b>Email: </b>{{ $rented->user->email }}</address>
                                </div>
                                <div class="col-4">
                                    
                                    
                                    <b>Order ID:</b>Invoice #{{ 1000 + $rented->id }}
                                    <br>
                                    <b>Payment Due:</b> {{ $rented->created_at->format('Y-m-d') }}<br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>inventory</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Discount</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <div style="display: none">
                                                {{ $total = 0 }}
                                            </div>
                                            @foreach ($payments as $payment)
                                                <tr>
                                                    <td>{{ $payment->inventory->name }}</td>
                                                    <td>{{ $payment->qty }}</td>
                                                    <td>{{ $payment->price }}</td>
                                                    <td>{{ $payment->dis }}%</td>
                                                    <td>₦{{ $payment->amount }}</td>
                                                    <div style="display: none">
                                                        {{ $total += $payment->amount }}
                                                    </div>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><b>Total</b></td>
                                                <td><b class="total">₦{{ $total }}</b></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="row d-print-none">
                                <div class="col-12 text-right m-3 ">
                                    <a class="btn btn-primary" href="javascript:void(0);" onclick="printrented();"><i class="fa fa-print"></i> Print</a>
                                <a href="#"href="javascript:void(0);" onclick="downloadPDF();" class="btn btn-primary me-2"><i class="fas fa-download"></i>
                                Download</a>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </main>

    </div>
     <style>
        /* Define styles for print layout */
        @media print {
            body * {
                visibility: hidden;
            }

            .important-part, .important-part * {
                visibility: visible;
            }
        }
    </style>

@section('script')
    <!-- Page level plugins -->
    <script src="{{ URL::to('assets/js/html2pdf.bundle.min.js') }}"></script>
    <script>
        function printrented() {
            window.print();
        }
        function downloadPDF() {
            var element = document.querySelector('.important-part');

            html2pdf(element);
        }
    </script>
@endsection
@endsection
