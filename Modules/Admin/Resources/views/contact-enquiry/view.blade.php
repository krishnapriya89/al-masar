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
                            <th>Message:</th>
                            <td>{!!$contact_reply->message!!}</td>
                        </tr>
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

