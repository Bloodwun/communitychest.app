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
            User
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
                    <h4 class="card-title">List</h4>
                    <table id="inbox-table" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Address</th>
                                <th>Zip code</th>
                                <th>Created at</th>
                               <th>Action </th> 
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    @include('admin.inbox.add-inbox')
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

    <script>
        $(document).ready(function() {
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table;
            table = $('#inbox-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: "{{ route('owner.user.list') }}",
    },
    columns: [
        { data: 'id', name: 'id' },
        { data: 'first_name', name: 'first_name' },
        { data: 'email', name: 'email' },
        { data: 'city', name: 'city' },
        { data: 'state', name: 'state' },
        { data: 'address', name: 'address' },
        { data: 'zip_code', name: 'zip_code' },
        { data: 'created_at', name: 'created_at' },
        {
            data: null, // The Action column
            orderable: false,
            searchable: false,
            render: function(data, type, row) {
                return `
                    <div class="btn-group" role="group">
                        <button class="btn btn-info btn-sm edit-user" data-id="${row.id}">
                            <i class="fa fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-danger btn-sm delete-user" data-id="${row.id}">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                        <button class="btn btn-secondary btn-sm view-user" data-id="${row.id}">
                            <i class="fa fa-eye"></i> View
                        </button>
                    </div>
                `;
            }
        },
    ],
    dom: 'Bfrtip',
    responsive: true,
    buttons: [
        'colvis',
        {
            extend: 'excel',
            text: 'Export to Excel',
            exportOptions: { columns: ':visible' }
        },
        {
            extend: 'csv',
            text: 'Export to CSV',
            exportOptions: { columns: ':visible' }
        },
        {
            extend: 'copy',
            text: 'Copy to Clipboard',
            exportOptions: { columns: ':visible' }
        },
        {
            extend: 'pdf',
            text: 'Export to PDF',
            exportOptions: { columns: ':visible' }
        }
    ]
});

$(document).on('click', '.edit-user', function() {
    const userId = $(this).data('id');
    // Redirect to edit page or open modal
    window.location.href = `/owner-dashboard/users/${userId}/edit`;
});

$(document).on('click', '.delete-user', function() {
    const userId = $(this).data('id');
    if (confirm('Are you sure you want to delete this user?')) {
        $.ajax({
            url: `/owner-dashboard/users/${userId}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    table.ajax.reload();
                    toast_success('User deleted successfully!');
                } else {
                    toast_error('Failed to delete user!');
                }
            },
            error: function(error) {
                toast_error('An error occurred while deleting the user!');
            }
        });
    }
});

$(document).on('click', '.view-user', function() {
    const userId = $(this).data('id');
    // Redirect to view page or open modal
    window.location.href = `/owner-dashboard/users/${userId}`;
});

            $('#submit').click(function() {
                var email = $('#inbox_name').val();

                if(email == '' || email == undefined)
                {
                    toast_error("Please enter a valid email.");
                    return ;
                }
                console.log("apiEndpoints",apiEndpoints);
                var add_inbox_api = apiEndpoints.add_inbox;
                var baseUrl = "{{ env('APP_URL') }}";
                console.log(baseUrl+add_inbox_api);
                var data = { email: email }; //
                callAPI(baseUrl+add_inbox_api, 'post', data)
                    .then(function(response) {
                        if(response.code == 400)
                        {
                            toast_error(response.message);
                            return ;
                        }
                        console.log('Update success:', response);
                        $('#inbox_name').val('');
                        $('#addInboxModal').modal('hide'); // Close the modal
                        table.ajax.reload();
                        toast_success(response.message);
                    })
                    .catch(function(error) {
                        console.log('Update error:', error);
                        toast_error(error);
                        // Handle error
                    });

            });
        });
    </script>
@endsection
