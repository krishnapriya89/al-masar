
@extends('admin::layouts.app')
@section('title', 'Vendors')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Vendors</h3>
                    <div class="card-tools">
                        <a href="{{ route('vendor.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Create
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($countries as $vendor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $vendor->name }}</td>
                                <td>{{ $vendor->email }}</td>
                                <td>{!! $vendor->status == 1
                                        ? '<span class="badge bg-success">Active</span>'
                                        : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                                <td>
                                    <a href="{{ route('vendor.edit', base64_encode($vendor->id)) }}"
                                       class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('vendor.destroy', $vendor->id) }}"
                                          method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-btn"
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
        });
    </script>
@endpush
