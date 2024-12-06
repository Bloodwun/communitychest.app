@extends('user.layouts.master')

@section('title')
    @lang('translation.edit_user')
@endsection

@section('css')
    <!-- Include any specific CSS for the edit page -->
    <link href="{{ URL::asset('public/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Role
        @endslot
        @slot('title')
            Edit Role
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Role</h4>
                    <form action="{{ route('owner.roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ $role->slug }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Role</button>
                        <a href="{{ route('owner.all.role') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#edit-user-form').on('submit', function(e) {
                e.preventDefault();

                var formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'PUT',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            toast_success('User updated successfully!');
                            // Redirect or perform other actions
                        } else {
                            toast_error(response.message || 'Failed to update user.');
                        }
                    },
                    error: function(error) {
                        toast_error('An error occurred while updating the user.');
                    }
                });
            });
        });
    </script>
@endsection
