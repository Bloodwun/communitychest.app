@extends('user.layouts.master')

@section('title') @lang('translation.Dashboards') @endsection

@section('content')

@component('user.components.breadcrumb')
@slot('li_1') Dashboards @endslot
@slot('title') Dashboard @endslot
@endcomponent

<div class="account-pages">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-12">
                        <div class="card overflow-hidden">
                            <div class="bg-primary bg-soft">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Free Register</h5>
                                            <p>Get your free Skote account now.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{ URL::asset('public/assets/images/profile-img.png') }}" alt=""
                                            class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div>
                                    <a href="index">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{ URL::asset('public/assets/images/logo.svg') }}" alt=""
                                                    class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2">
                                    <form method="POST" class="form-horizontal" action="{{ route('business.register') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="first_name" class="form-label">First Name*</label>
                                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                                            value="{{ old('first_name') }}" name="first_name" placeholder="Enter First Name" autofocus required>
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="first_name" class="form-label">Middle Name*</label>
                                            <input type="text" class="form-control @error('middle_name') is-invalid @enderror" id="middle_name"
                                            value="{{ old('middle_name') }}" name="middle_name" placeholder="Enter Middle Name" autofocus required>
                                            @error('middle_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="last_name" class="form-label">Last Name*</label>
                                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                                            value="{{ old('last_name') }}" name="last_name" placeholder="Enter First Name" autofocus required>
                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email*</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                            value="{{ old('email') }}" name="email" placeholder="Enter email" autofocus required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="user_name" class="form-label">Username*</label>
                                            <input type="text" class="form-control @error('user_name') is-invalid @enderror"
                                            value="{{ old('user_name') }}" id="user_name" name="user_name" autofocus required
                                                placeholder="Enter user Name">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="Role" class="form-label">Role*</label>
                                            <select class="form-control" name = "role_id">
                                            <option value = "2">Staff</option>
                                            <!-- <option value = "3">Business</option>
                                            <option value = "4">Realtor/LeaseAgent</option> -->
                                            <option selected = "5">New Resident 
                                            </option>
                                            </select>
                                            @error('role')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="state" class="form-label">State*</label>
                                            <input type="text" class="form-control @error('state') is-invalid @enderror" id="state"
                                            value="{{ old('state') }}" name="state" placeholder="Enter State" autofocus required>
                                            @error('state')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="city" class="form-label">City*</label>
                                            <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                                            value="{{ old('city') }}" name="city" placeholder="Enter City" autofocus required>
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="zipcode" class="form-label">Zip Code*</label>
                                            <input type="text" class="form-control @error('zipcode') is-invalid @enderror" id="zipcode"
                                            value="{{ old('zipcode') }}" name="zip_code" placeholder="Enter Zip Code" autofocus required>
                                            @error('zipcode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="phonenumber" class="form-label">Phone number*</label>
                                            <input type="text" class="form-control @error('phonenumber') is-invalid @enderror" id="phonenumber"
                                            value="{{ old('phonenumber') }}" name="phone_number" placeholder="Enter Phone number" autofocus required>
                                            @error('phonenumber')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address*</label>
                                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                            value="{{ old('address') }}" name="address" placeholder="Enter Address" autofocus required>
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="userpassword" class="form-label">Password*</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="userpassword" name="password"
                                                placeholder="Enter password" autofocus required>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="confirmpassword" class="form-label">Confirm Password*</label>
                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmpassword" name="password_confirmation"
                                            name="password_confirmation" placeholder="Enter Confirm password" autofocus required>
                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <!-- <div class="mb-3">
                                            <label for="referral_code" class="form-label">Referral_Code*</label>
                                            <input type="text" class="form-control @error('referral_code') is-invalid @enderror" id="referral_code"
                                            value="{{ old('referral_code') }}" name="referral_code" placeholder="Enter Referral Code" autofocus>
                                            @error('referral_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> -->
                                        

                                        <div class="mt-4 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light"
                                                type="submit">Register</button>
                                        </div>
                                        <div class="mt-4 text-center">
                                            <p class="mb-0">By registering you agree to the Community Chest <a href="#"
                                                    class="text-primary">Terms of Use</a></p>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
@section('script')
<!-- apexcharts -->
<script src="{{asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- dashboard init -->
<script src="{{asset('/assets/js/pages/dashboard.init.js') }}"></script>
@endsection