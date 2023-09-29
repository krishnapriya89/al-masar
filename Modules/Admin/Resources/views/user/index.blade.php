@extends('admin::layouts.app')
@section('title', 'User Management')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="card-title">User Management</h3>
                    </div>
                    <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Office Phone Number</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->office_phone }}</td>
                                    <td id="user-status-{{ $user->id }}">
                                        <div class="form-group">
                                            <select class="custom-select form-control-border userStatus"
                                                data-user-id="{{ $user->id }}">
                                                <option value="1"
                                                    {{ old('status', $user->status) == '1' ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="0"
                                                    {{ old('status', $user->status) == '0' ? 'selected' : '' }}>Inactive
                                                </option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($user->phone_verified && $user->office_phone_verified && $user->email_verified)
                                            @if ($user->admin_verified)
                                                <span class="badge bg-success">Verified</span>
                                            @else
                                                <div class="form-group verify-user-div-{{ $user->id }}">
                                                    <button type="button" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}"
                                                        class="btn btn-sm btn-success verify-user">Verify</button>
                                                </div>
                                            @endif
                                        @endif
                                        <form action="{{ route('user-management.destroy', $user->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                data-toggle="tooltip" data-placement="top" data-original-title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No data found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            var options = {
                // buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
            };
            initializeDataTable(options);

            $('#message-text').summernote({
                minHeight: 200,
            });
        });

        $(document).on("change", ".userStatus", function() {
            let user_id = $(this).data('user-id');
            let user_status = parseInt($(this).val());
            if (user_status == 1) {
                var message = 'Do you want to change the status Active?';
            } else if (user_status == 0) {
                var message = 'Do you want to change the status to InActive?';
            }
            Swal.fire({
                title: "Change User Status",
                text: message,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: primary_color,
                confirmButtonText: "Update",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('user-management.change-status') }}",
                        type: "POST",
                        data: {
                            user_id: user_id,
                            user_status: user_status,
                        },
                        success: function(response) {
                            toastr.success("Status Changed Successfully!");

                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: "error",
                                title: `An error occurred while updating the status.`,
                                showConfirmButton: false,
                                timer: 3000,
                            });
                        },
                    });
                }
            });
        });

        $('body').on('click', '.verify-user', function() {
        let user_id = $(this).data('user-id');
        let user_name = $(this).data('user-name');
        Swal.fire({
            title: "Verify User - "+user_name,
            text: 'Are you sure to verify this user',
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: primary_color,
            confirmButtonText: "Update",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('user-management.verify-user') }}',
                    type: 'POST',
                    data: {
                        user_id: user_id
                    },
                    success: function(response) {
                        if (response && response.status) {
                            $('.verify-user-div-' + user_id).empty().html(
                                '<span class="badge bg-success">Verified</span>');
                        } else {
                            toastr.error('Some thing went wrong')
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
        });
    </script>
@endpush
