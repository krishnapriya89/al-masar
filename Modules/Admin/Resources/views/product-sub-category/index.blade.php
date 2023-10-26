@extends('admin::layouts.app')
@section('title', 'Product Sub Category')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="card-title">Product Sub Category</h3>
                        <div class="card-tools">
                            <a href="{{ route('product-sub-category.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Create
                            </a>
                        </div>
                    </div>
                    <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Title</th>
                            <th>Main Category</th>
                            <th>Parent Category</th>
                            <th>Sort Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($sub_categories as $sub_category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sub_category->title }}</td>
                                <td>{{ $sub_category->category->title }}</td>
                                <td>{{ @$sub_category->parent->title ?? '' }}</td>
                                <td>{{ $sub_category->sort_order }}</td>
                                <td>{!! $sub_category->status == 1
                                        ? '<span class="badge bg-success">Active</span>'
                                        : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                                <td>
                                    <a href="{{ route('product-sub-category.edit', base64_encode($sub_category->id)) }}"
                                       class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('product-sub-category.destroy', $sub_category->id) }}"
                                          method="POST"
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
                                <td colspan="7" class="text-center">No data found.</td>
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
        $(document).ready(function () {
            var options = {
                // buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
            };
            initializeDataTable(options);
        });
    </script>
@endpush
