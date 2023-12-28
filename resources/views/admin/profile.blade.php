@extends('layout.admin_master')
@section('content')
    <div class="container-fluid rounded bg-white mt-2 mb-2">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px"
                        src="{{ URL::to('assets/images/admin/'.  Auth::user()->image) }}">
                    <span class="font-weight-bold">{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</span>
                    <span class="text-black-50">{{ Auth::user()->email }}</span>
                    <span></span>
                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">First name</label>
                                <input type="text" class="form-control" placeholder="first name" name="firstname"
                                    value="{{ Auth::user()->firstname }}">

                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Surname</label>
                                <input type="text" class="form-control"
                                    value="{{ Auth::user()->lastname }}"placeholder="surname" name="lastname">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Mobile Number</label>
                                <input type="tel"  name="phone_number" class="form-control" placeholder="enter phone number"
                                    value="{{ Auth::user()->phone_number }}"></div>
                            <div class="col-md-12">
                                <label class="labels">Email ID</label>
                                <input type="email"
                                    class="form-control" name="email" placeholder="enter email id" value="{{ Auth::user()->email }}">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Profile Picture</label>
                                <input type="file" class="form-control" name="image" value="{{ Auth::user()->image }}">
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <button class="btn btn-primary" type="submit">Save Profile</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <form action="{{ route('password.change') }}" method="post">

                        @csrf

                        <div class="d-flex justify-content-between align-items-center password">
                            <span>Edit Password</span>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <label class="labels">Current Password</label>
                            <input id="current_password" type="password"
                                class="form-control @error('current_password') is-invalid @enderror" name="current_password"
                                required autocomplete="current-password">

                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                        </div>
                        <br>
                        <div class="col-md-12">
                            <label class="labels">New Password</label>
                            <input id="new_password" type="password"
                                class="form-control @error('new_password') is-invalid @enderror" name="new_password"
                                required autocomplete="new-password">

                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div class="col-md-12">
                            <label class="labels">Confirm Password</label>
                            <input id="new_password_confirmation" type="password" class="form-control"
                                name="new_password_confirmation" required autocomplete="new-password">

                            @error('new_password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mt-5 text-center">
                            <button class="btn btn-primary" type="submit">Save Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
