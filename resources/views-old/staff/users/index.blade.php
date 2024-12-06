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
                                {{-- <th>Action </th> --}}
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
                    url: "{{ route('staff.user.list') }}",
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'city',
                        name: 'city'
                    },
                    {
                        data: 'state',
                        name: 'state'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'zip_code',
                        name: 'zip_code'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    // {
                    //     data: 'actions',
                    //     name: 'actions',
                    //     orderable: false,
                    //     searchable: false
                    // },
                ],
                dom: 'Bfrtip', // Include buttons in the layout
                responsive: true, // Enable responsiveness
                buttons: [
                    'colvis', // Enable the column visibility button
                    {
                        extend: 'excel',
                        text: 'Export to Excel',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        text: 'Export to CSV',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'copy',
                        text: 'Copy to Clipboard',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        text: 'Export to PDF',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
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
