@extends('admin::layouts.app')
@section('title', 'Contact View')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="card-title">Contact Enquiry  View</h3>
                        {{-- <p class="float-lg-right">Replied on:{{$career_reply->date_formatted}}</p> --}}
                    </div>
                    <table id="dataTable" class="table table-bordered table-striped">
                        <tr>
                            <th>Name:</th>
                            <td>{{ @$contact_reply->name}}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ @$contact_reply->email}}</td>
                        </tr>
                        <tr>
                            <th>Phone Number:</th>
                            <td>{{ @$contact_reply->phone}}</td>
                        </tr>
                        <tr>
                            <th>Subject:</th>
                            <td>{{ @$contact_reply->subject}}</td>
                        </tr>
                        <tr>
                            <th>Message:</th>
                            <td>{!!$contact_reply->message!!}</td>
                        </tr>
                        @if(@$contact_reply->reply)
                        <tr>
                            <th>Reply:</th>
                            <td>{!!$contact_reply->reply!!}</td>
                        </tr>
                        @endif
                        {{-- <tr>
                            <th>Replied On:</th>
                            <td>{{$contact_reply->date_formatted}}</td>
                        </tr> --}}

                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

