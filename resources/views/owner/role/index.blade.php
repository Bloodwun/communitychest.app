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
 Admin 

@endslot

@slot('title')
     Edit Admin 

@endslot
    <div class="form-group row align-items-center">
    
    </div>
    <br>
   
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title">Role Management</h4>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                            Create Role
                        </button>
                    </div>
                    <table id="inbox-table" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Role Name</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td >{{ $role->name }}</td>
                                    <td>{{ $role->slug }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <!-- Edit Button -->
                                            <a href="{{ route('owner.roles.edit', $role->id) }}" class="btn btn-sm btn-warning me-2">
                                                Edit
                                            </a>
                                            <!-- Delete Button -->
                                            <form action="{{ route('owner.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this role?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
  <!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('owner.roles.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoleModalLabel">Create Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Role Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Role</button>
                </div>
            </form>
        </div>
    </div>
</div>
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

   
    @include('user.alert-message.alert');
@endsection
