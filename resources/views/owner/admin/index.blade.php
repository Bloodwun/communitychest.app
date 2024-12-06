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
            Tables
        @endslot
        @slot('title')
            Admin
        @endslot
    @endcomponent
    <div class="form-group row align-items-center">
        <div class="col-sm-3">
            <!-- <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#addInboxModal">
                User Inbox
            </button> -->
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title d-flex justify-content-between">
                        All Admins
                       
                    </h4>
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
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_admin as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>{{ $user->city }}</td>
                                    <td>{{ $user->state }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->zip_code }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm m-1 ">Manage</a>
                                        <a href="{{ route('owner.admin.edit', $user->id) }}" class="btn btn-primary btn-sm m-1">Edit</a>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm m-1">Delete</button>
                                        </form>
                                    </td>
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

   
  
@endsection
