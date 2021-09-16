@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Shipment Document
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Shipment Document</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">

                <div class="box-body">
                    @include('vendor.backpack.base.inc.alert')
                    <div class="row">
                        <div class="col-md-10 text-right">
                            <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix', 'admin').'/shipment_document/exportToExcel') }}">
                                <a style="float: left;" href="{{ url(config('backpack.base.route_prefix', 'admin').'/shipment_document/create') }}" class="btn btn-success">Create Shipment Document</a>
                                @csrf
                                <!-- <div style="display: inline-block;vertical-align: middle;">
                                    <div class="form-group" style="margin-bottom: 0;">
                                        <label style="display: inline-block; vertical-align: middle; margin-bottom: 0; margin-right: 10px;">Start From:</label>
                                        <div style="display: inline-block; width: 150px; vertical-align: middle;">
                                            <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                                <input type="text" class="form-control pull-right datepicker" id="start_date" name="start_date" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: inline-block;vertical-align: middle; margin: 0 15px;">
                                    <div class="form-group" style="margin-bottom: 0;">
                                        <label style="display: inline-block; vertical-align: middle; margin-bottom: 0; margin-right: 10px;">To:</label>
                                        <div style="display: inline-block; width: 150px; vertical-align: middle;">
                                            <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                                <input type="text" class="form-control pull-right datepicker" id="end_date" name="end_date" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="shipping_type_export" value="{{ request('shipping_type') }}">
                                <input type="hidden" name="payment_status_export" value="{{ request('payment_status') }}">
                                <input type="hidden" name="payment_type_export" value="{{ request('payment_type') }}">
                                <div style="display: inline-block;vertical-align: middle;">
                                    <button type="submit" class="btn btn-success">Export Sales Report</button>
                                </div> -->
                            </form>
                        </div>
                        <br><br>
                        <div class="col-md-12">
                            <form action="{{ url()->current() }}" class="pull-right" style="width: 100%;">
                                <div class="row">
                                    
                                    <!-- <div class="col-md-3">
                                        <select class="form-control" name="print_status" id="print_status" onChange="this.form.submit()">
                                            <option value="">Select Print Status</option>
                                            <option value="">All</option>
                                            <option value="1" {{ request('print_status') == '1' ? 'selected' : '' }}>Printed</option>
                                            <option value="2" {{ request('print_status') == '2' ? 'selected' : '' }}>Not Printed</option>
                                        </select>
                                    </div> -->
                                    
                                    <!-- <br> -->
                                    <div class="col-md-3" style="float: right;">
                                        <input type="text" name="keyword" class="form-control" placeholder="Search" value="{{ request('keyword') }}">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="dataTable_wrapper table-responsive">
                        <table class="table table-striped table-bshipment_documented table-hover datatable ">
                            <thead>
                                <tr class="nosortable">
                                    <th>Quotation</th>
                                    <th>Member</th>
                                    <th>File</th>
                                    <th>Date</th>
                                    <th class="table-actions">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($data as $content)
                                    <tr>
                                        <td>{{ $content->quotation_number }}</td>
                                        <td>{{ $content->quotation ? ucwords(strtolower($content->quotation->first_name)) . ' ' . ucwords(strtolower($content->quotation->last_name)) : '' }}</td>
                                        <td>{{ $content->file }}</td>
                                        <td>{{ $content->created_at }}</td>
                                        <td><div class="table-actions-hover">
                                                <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/shipment_document/edit/'.$content->id) }}"><i class="fa fa-pencil fa-fw"></i></a>
                                                |
                                                <a target="_blank" href="{{ asset('upload/'.$content->file_path) }}"><i class="fa fa-download fa-fw"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                              @endforeach
                            </tbody>
                        </table>
                        {{ $data->links("pagination::bootstrap-4") }}
                    </div>
                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>
    </div>

    
@endsection
