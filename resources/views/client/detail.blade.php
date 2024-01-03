@extends('layout.master')
@section('content')
    <div class="container pt-5 pb-5">
        <!-- product -->
        <div class="product-content product-wrap clearfix product-deatil">
            <div class="row">
                <div class="col-md-6 img-container">
                    <div class="img-box">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class=""></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2" class=""></li>
                            </ol>
                            <div class="carousel-inner">
                                <!-- Slide 1 -->
                                <div class="carousel-item active">
                                    <img src="https://www.bootdey.com/image/700x400/FFB6C1/000000" class="img-fluid"
                                        alt="" />
                                </div>
                                <!-- Slide 2 -->
                                <div class="carousel-item">
                                    <img src="https://www.bootdey.com/image/700x400/87CEFA/000000" class="img-fluid"
                                        alt="" />
                                </div>
                                <!-- Slide 3 -->
                                <div class="carousel-item">
                                    <img src="https://www.bootdey.com/image/700x400/B0C4DE/000000" class="img-fluid"
                                        alt="" />
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-md-offset-1 col-sm-12 col-xs-12">
                    <h2 class="name">
                        {{ $inventory->name }}
                    </h2>
                    <i class="fas fa-star  text-primary"></i>
                    <i class="fas fa-star  text-primary"></i>
                    <i class="fas fa-star  text-primary"></i>
                    <i class="fas fa-star  text-primary"></i>
                    <i class="fas fa-star  text-muted"></i>
                    <span class="fas ">
                        <h5>(109) Votes</h5>
                    </span>
                    <a href="javascript:void(0);">109 customer reviews</a>
                    <hr />
                    <h3 class="price-container">
                        ₦{{ $inventory->payments_price }}
                        <small>*includes tax</small>
                    </h3>

                    <hr />
                    <div class="description description-tabs">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active no-margin px-3 py-2" id="more-information-tab" data-toggle="pill"
                                    href="#more-information">Product Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-3 py-2" id="specifications-tab" data-toggle="pill"
                                    href="#specifications">Specifications</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-3 py-2" id="reviews-tab" data-toggle="pill"
                                    href="#reviews">Reviews</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="more-information">
                                <br />
                                <strong>Description Title</strong>
                                <p>
                                    {{ $inventory->description }}
                                </p>
                            </div>
                            <div class="tab-pane fade" id="specifications">
                                <br />
                                <dl class="">
                                    <dt>Gravina</dt>
                                    <dd>Etiam porta sem malesuada magna mollis euismod.</dd>
                                    <dd>Donec id elit non mi porta gravida at eget metus.</dd>
                                    <dd>Eget lacinia odio sem nec elit.</dd>
                                    <br />

                                    <dt>Test lists</dt>
                                    <dd>A description list is perfect for defining terms.</dd>
                                    <br />

                                    <dt>Altra porta</dt>
                                    <dd>Vestibulum id ligula porta felis euismod semper</dd>
                                </dl>
                            </div>
                            <div class="tab-pane fade" id="reviews">
                                <br />
                                <form method="post" class="well padding-bottom-10" onsubmit="return false;">
                                    <textarea rows="2" class="form-control" placeholder="Write a review"></textarea>
                                    <div class="margin-top-10">
                                        <button type="submit" class="btn btn-sm btn-primary pull-right">
                                            Submit Review
                                        </button>
                                        <a href="javascript:void(0);" class="btn btn-link profile-link-btn" rel="tooltip"
                                            data-placement="bottom" title="" data-original-title="Add Location"><i
                                                class="fas fa-location-arrow"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-link profile-link-btn" rel="tooltip"
                                            data-placement="bottom" title="" data-original-title="Add Voice"><i
                                                class="fas fa-microphone"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-link profile-link-btn"
                                            rel="tooltip" data-placement="bottom" title=""
                                            data-original-title="Add Photo"><i class="fas fa-camera"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-link profile-link-btn"
                                            rel="tooltip" data-placement="bottom" title=""
                                            data-original-title="Add File"><i class="fas fa-file"></i></a>
                                    </div>
                                </form>

                                <div class="chat-body no-padding profile-message">
                                    <ul>
                                        <li class="message">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                class="online" />
                                            <span class="message-text">
                                                <a href="javascript:void(0);" class="username">
                                                    Alisha Molly
                                                    <span class="badge">Purchase Verified</span>
                                                    <span class="pull-right">
                                                        <i class="fas fa-star  text-primary"></i>
                                                        <i class="fas fa-star  text-primary"></i>
                                                        <i class="fas fa-star  text-primary"></i>
                                                        <i class="fas fa-star  text-primary"></i>
                                                        <i class="fas fa-star  text-muted"></i>
                                                    </span>
                                                </a>
                                                Can't divide were divide fish forth fish to. Was can't form the, living life
                                                grass darkness very image let unto fowl isn't in blessed fill life yielding
                                                above all moved
                                            </span>
                                            <ul class="list-inline font-xs">
                                                <li>
                                                    <a href="javascript:void(0);" class="text-info"><i
                                                            class="fas fa-thumbs-up"></i> This was helpful (22)</a>
                                                </li>
                                                <li class="pull-right">
                                                    <small class="text-muted pull-right ultra-light"> Posted 1 year ago
                                                    </small>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="message">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png"
                                                class="online" />
                                            <span class="message-text">
                                                <a href="javascript:void(0);" class="username">
                                                    Aragon Zarko
                                                    <span class="badge">Purchase Verified</span>
                                                    <span class="pull-right">
                                                        <i class="fas fa-star  text-primary"></i>
                                                        <i class="fas fa-star  text-primary"></i>
                                                        <i class="fas fa-star  text-primary"></i>
                                                        <i class="fas fa-star  text-primary"></i>
                                                        <i class="fas fa-star  text-primary"></i>
                                                    </span>
                                                </a>
                                                Excellent product, love it!
                                            </span>
                                            <ul class="list-inline font-xs">
                                                <li>
                                                    <a href="javascript:void(0);" class="text-info"><i
                                                            class="fas fa-thumbs-up"></i> This was helpful (22)</a>
                                                </li>
                                                <li class="pull-right">
                                                    <small class="text-muted pull-right ultra-light"> Posted 1 year ago
                                                    </small>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <a href="{{ url('add-to-cart/' . $inventory->id) }}" role="button" class="btn btn-primary btn-lg">Add to cart
                                (₦{{ $inventory->payments_price }})</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- end product -->
    </div>
@endsection
