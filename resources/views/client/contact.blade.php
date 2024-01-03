@extends('layout.master')
@section('title', 'Contact | ')
@section('content')
    <!-- contact section -->

    <section class="contact_section layout_padding">
        <div class="container ">
            <div class="heading_container">
                <h2 class="">
                    Contact Us
                </h2>
            </div>

        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form action="">
                        <div>
                            <input type="text" placeholder="Name" />
                        </div>
                        <div>
                            <input type="email" placeholder="Email" />
                        </div>
                        <div>
                            <input type="text" placeholder="Phone" />
                        </div>
                        <div>
                            <input type="text" class="message-box" placeholder="Message" />
                        </div>
                        <div class="d-flex ">
                            <button>
                                SEND
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="map_container">
                        <div class="map-responsive">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3938.998826588339!2d7.3416571742506465!3d9.154577290911822!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x104dd94f05eb489b%3A0x679507ea98ee14b0!2sInformation%20Quarters%2C%20Phase%204!5e0!3m2!1sen!2sng!4v1704114307581!5m2!1sen!2sng" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end contact section -->
@endsection
