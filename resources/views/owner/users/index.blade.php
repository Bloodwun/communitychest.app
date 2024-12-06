@extends('user.layouts.master')

@section('title')
    @lang('translation.inbox')
@endsection

<style>
    .dt-buttons {
        gap: 4px;
        margin-bottom: 0.6rem;
    }
</style>
@section('css')
    <!-- DataTables -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <link href="{{ URL::asset('public/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            @if ($role_id == 1)
                Admin
            @elseif($role_id == 2)
                Staff
            @elseif($role_id == 3)
                Business
            @elseif($role_id == 4)
                Realtor/LeaseAgent
            @elseif($role_id == 5)
                New Resident
            @elseif($role_id == 6)
                Owner
            @else
                Unknown Role
            @endif
        @endslot

        @slot('title')
            @if ($role_id == 1)
                Edit Admin
            @elseif($role_id == 2)
                Edit Staff
            @elseif($role_id == 3)
                Edit Business
            @elseif($role_id == 4)
                Edit Realtor/LeaseAgent
            @elseif($role_id == 5)
                Edit New Resident
            @elseif($role_id == 6)
                Edit Owner
            @else
                Edit Unknown Role
            @endif
        @endslot
        <div class="form-group row align-items-center">
            <div class="col-sm-3">
                <!-- <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#addInboxModal">
                        User Inbox
                    </button> -->
            </div>
        </div>
        <br>
        @php
            $role_id = Auth::user()->role_id;
        @endphp
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title d-flex justify-content-between">All @if ($role_id == 1)
                                Admin
                            @elseif($role_id == 2)
                                Staff
                            @elseif($role_id == 3)
                                Business
                            @elseif($role_id == 4)
                                Business Staff
                            @elseif($role_id == 5)
                                New Resident
                            @elseif($role_id == 6)
                                Owner
                            @else
                                Unknown Role
                            @endif

                        </h4>
                        @php
                            $role_id = Auth::user()->role_id;
                        @endphp
                        <table id="inbox-table" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Address</th>
                                    <th>Zip Code</th>
                                    <th>Created By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td style="max-width: 200px">{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>{{ $user->city }}</td>
                                        <td>{{ $user->state }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $user->zip_code }}</td>
                                        <td>{{ isset($user->parent->first_name) ? $user->parent->first_name : 'N/A' }}</td>
                                        @if ($role_id == 1)
                                            <td>
                                                <a href="{{ route('owner.user.edit', $user->id) }}"
                                                    class="btn btn-warning btn-sm m-1 ">Manage</a>
                                                <a href="{{ route('owner.admin.edit', $user->id) }}"
                                                    class="btn btn-primary btn-sm m-1">Edit</a>
                                                <form action="{{ route('owner.user.destroy', $user->id) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm m-1">Delete</button>
                                                </form>
                                            </td>
                                        @elseif($role_id == 2)
                                            <td>
                                                <a href="{{ route('owner.user.edit', $user->id) }}"
                                                    class="btn btn-warning btn-sm m-1 ">Manage</a>
                                                <a href="{{ route('admin.edit', $user->id) }}"
                                                    class="btn btn-primary btn-sm m-1">Edit</a>
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm m-1">Delete</button>
                                                </form>
                                            </td>
                                        @elseif($role_id == 3)
                                            <form method="POST" action="{{ route('user.store') }}">
                                            @elseif($role_id == 4)
                                                <td>
                                                    <a href="{{ route('business.user.edit', $user->id) }}"
                                                        class="btn btn-warning btn-sm m-1 ">Manage</a>
                                                    <a href="{{ route('business.user.edit', $user->id) }}"
                                                        class="btn btn-primary btn-sm m-1">Edit</a>
                                                    <form action="{{ route('business.user.destroy', $user->id) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm m-1">Delete</button>
                                                    </form>
                                                </td>
                                            @elseif($role_id == 5)
                                                <form method="POST" action="{{ route('user.store') }}">
                                                @elseif($role_id == 6)
                                                    <form method="POST" action="{{ route('user.store') }}">
                                        @endif

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    @endsection
@section('script')
    <!-- Required datatable js -->
    <script src="{{ URL::asset('public/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ URL::asset('public/assets/js/pages/datatables.init.js') }}"></script>

    {{-- Date Range --}}
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.0.5/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.0.5/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.0.5/daterangepicker.css" />
    <script src="{{ URL::asset('public/js/apiEndpoints.js') }}"></script>
@include('')

@endsection
