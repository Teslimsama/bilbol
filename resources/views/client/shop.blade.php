@extends('layout.master')
@section('title', 'Shop | ')
@section('content')
    <!-- brand section -->

    <section class="brand_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Featured Brands
                </h2>
            </div>
            <div class="brand_container layout_padding2">
                  @foreach ($inventoryList as $key => $list)
                <div class="box">
                    <a href="{{ url('details/' . $list->id) }}">
                        <div class="new">
                            <h5>
                                New
                            </h5>
                        </div>
                        <div class="img-box">
                            <img src="assets/images/slider-img.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h6 class="price">
                                $100
                            </h6>
                            <h6>
                                Chair
                            </h6>
                        </div>
                    </a>
                </div>
                 @endforeach
            </div>
        </div>
    </section>

    <!-- end brand section -->
@endsection
