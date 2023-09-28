@extends('admin::layouts.app')
@section('title', 'Contact Enquiry Listing')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="card-title">Contact Enquiry Listing</h3>
                    </div>
                    <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($enquiries as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->date_formatted}}</td>

                                <td>
                                    <a href="javascript:void(0)"
                                        class="btn btn-primary btn-sm modal-div" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Reply" data-id="{{$item->id}}" data-email="{{$item->email}}" >
                                        <i class="fas fa-reply"></i>
                                    </a>
                                    <a href="{{route('contact-enquiry-listing.show',base64_encode($item->id))}}"
                                        class="btn btn-primary btn-sm " data-toggle="tooltip" data-placement="top"
                                        data-original-title="View"  >
                                         <i class="fas fa-eye"></i>
                                     </a>
                                    <form action="{{ route('contact-enquiry-listing.destroy', $item->id) }}" method="POST"
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
    {{-- modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">New message</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="{{route('contact-enquiry-listing.reply')}}" method="post">
                @csrf
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Recipient:</label>
                  <input type="text" class="form-control" id="recipient-name" name="recipient"readonly value="{{old('recipient')}}">
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Reply:</label>
                  <textarea class="form-control" id="message-text" name="reply"></textarea>
                </div>
                @error('reply')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="modal-footer">
                <input type="hidden" name="contact_id" id="id">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Send message</button>
            </div>
        </form>
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
            //modal
            $('.modal-div').click(function(){
            var id = $(this).data('id');
            var email = $(this).data('email');
            $('#recipient-name').val(email);
            $('#id').val(id);
            $('#exampleModal').modal('show');

        });
        @if ($errors->has('reply'))
            $('#exampleModal').modal('show');
        @endif
        });
    </script>
@endpush
