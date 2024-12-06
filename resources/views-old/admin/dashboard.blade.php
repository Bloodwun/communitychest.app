@extends('admin.layouts.master')

@section('title') @lang('translation.Dashboards') @endsection

@section('content')
@include('admin.components.error_messages')
@component('admin.components.breadcrumb')
@slot('li_1') Dashboards @endslot
@slot('title') Dashboard @endslot
@endcomponent
<div class="row">
    <div class="col-xl-4">
        <div class="card overflow-hidden">
            <div class="bg-primary bg-soft">
                <div class="row">
                    <div class="col-7">
                        <div class="text-primary p-3">
                            <h5 class="text-primary">Welcome Back !</h5>
                            <p>Admin</p>
                        </div>
                    </div>
                    <div class="col-5 align-self-end">
                        <img src="{{asset('/public/assets/images/profile-img.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="avatar-md profile-user-wid mb-4">
                            <img src="{{ isset(Auth::user()->avatar) ? Auth::user()->getavatar(Auth::user()->id,Auth::user()->avatar) : asset('/assets/images/users/avatar-1.jpg') }}" alt="" class="img-thumbnail rounded-circle">
                        </div>
                        <h5 class="font-size-15 text-truncate">{{ Str::ucfirst(Auth::user()->username) }}</h5>
                        <p class="text-muted mb-0 text-truncate">{{Auth::user()->username}}</p>
                    </div>

                    <div class="col-sm-8">
                        <div class="pt-5">

                            {{-- <div class="row">
                                <div class="col-6">
                                    <h5 class="font-size-15">125</h5>
                                    <p class="text-muted mb-0">Projects</p>
                                </div>
                                <div class="col-6">
                                    <h5 class="font-size-15">$1245</h5>
                                    <p class="text-muted mb-0">Revenue</p>
                                </div>
                            </div> --}}
                            <div class="mt-5">
                                <a href="" class="btn btn-primary waves-effect waves-light btn-sm">You are login as an Admin</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--
    <div class="col-xl-8">
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-xs me-3">
                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                    <i class="bx bx-copy-alt"></i>
                                </span>
                            </div>
                            <h5 class="font-size-12 mb-0">Delivery Rate</h5>
                        </div>
                        <div class="text-muted mt-4">
                            <h4><span class="badge badge-soft-success"></span> </h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-xs me-3">
                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                    <i class="bx bx-archive-in"></i>
                                </span>
                            </div>
                            <h5 class="font-size-12 mb-0">Bounce Rate</h5>
                        </div>
                        <div class="text-muted mt-4">
                            <h4><span class="badge badge-soft-success"></span> </h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-xs me-3">
                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                    <i class="bx bx-purchase-tag-alt"></i>
                                </span>
                            </div>
                            <h5 class="font-size-12 mb-0">Complaint Rate</h5>
                        </div>
                        <div class="text-muted mt-4">
                            <h4><span class="badge badge-soft-success"> </span> </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-xs me-3">
                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                    <i class="bx bx-copy-alt"></i>
                                </span>
                            </div>
                            <h5 class="font-size-12 mb-0">Sent Email Counter</h5>
                        </div>
                        <div class="text-muted mt-4">
                            <h4><span class="badge badge-soft-success"></span> </h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-xs me-3">
                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                    <i class="bx bx-archive-in"></i>
                                </span>
                            </div>
                            <h5 class="font-size-12 mb-0">Email Open Counter</h5>
                        </div>
                        <div class="text-muted mt-4">
                            <h4><span class="badge badge-soft-success"> </span> </h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <a href = "{{ route('admin.warmup.run') }}" style="text-decoration-style: none">
                            <div class="avatar-xs me-3">
                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                        

                                </span>
                            </div>
                        </a>
                            <h5 class="font-size-12 mb-0">Warmup Inbox</h5>
                        </div>
                        <div class="text-muted mt-4">
                            <h4><span class="badge badge-soft-success"></span> </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> --}}

</div>
<!-- end row -->
<!-- subscribeModal -->
{{-- <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <div class="avatar-md mx-auto mb-4">
                        <div class="avatar-title bg-light rounded-circle text-primary h1">
                            <i class="mdi mdi-email-open"></i>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-xl-10">
                            <h4 class="text-primary">Subscribe !</h4>
                            <p class="text-muted font-size-12 mb-4">Subscribe our newletter and get notification to stay
                                update.</p>

                            <div class="input-group bg-light rounded">
                                <input type="email" class="form-control bg-transparent border-0" placeholder="Enter Email address" aria-label="Recipient's username" aria-describedby="button-addon2">

                                <button class="btn btn-primary" type="button" id="button-addon2">
                                    <i class="bx bxs-paper-plane"></i>
                                </button>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- end modal -->

@endsection
@section('script')
<!-- apexcharts -->
<!-- <script src="{{asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script> -->

<!-- dashboard init -->
<!-- <script src="{{asset('/assets/js/pages/dashboard.init.js') }}"></script> -->
@endsection
