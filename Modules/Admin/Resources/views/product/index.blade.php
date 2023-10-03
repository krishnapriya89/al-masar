@extends('admin::layouts.app')
@section('title', 'Product')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="card-title">Product</h3>
                        <div class="card-tools">
                            <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Create
                            </a>
                        </div>
                    </div>
                    <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Sort Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->title }}</td>
                                <td>
                                    @if($product->detail_page_image && Storage::disk('public')->exists($product->detail_page_image))
                                        <img src="{{ Storage::url($product->detail_page_image) }}" class="rounded"
                                             alt="{{ $product->title }}" height="51">
                                    @endif
                                </td>
                                <td>{{ $product->sort_order }}</td>
                                <td>{!! $product->status == 1
                                        ? '<span class="badge bg-success">Active</span>'
                                        : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                                <td>
                                    <a href="{{ route('product.edit', base64_encode($product->id)) }}"
                                        class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Edit" style="margin-bottom: 2px;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('product-gallery.index', base64_encode($product->id)) }}"
                                        class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Gallery" style="margin-bottom: 2px;">
                                         <i class="fas fa-image"></i>
                                     </a>
                                    <form action="{{ route('product.destroy', $product->id) }}"
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
                                <td colspan="8" class="text-center">No data found.</td>
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
