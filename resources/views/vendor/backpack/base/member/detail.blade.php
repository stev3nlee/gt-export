@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Member
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Member</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    Detail Member
                </div>

                <div class="box-body">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#Data" data-toggle="tab">Detail</a></li>
                      <li><a href="#quotation" data-toggle="tab">Quotation</a></li>
                      <li><a href="#invoice" data-toggle="tab">Invoice</a></li>
                      <li><a href="#shipment-document" data-toggle="tab">Shipment Document</a></li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="Data">
                      <div class="form-group clearfix">
                        <div style="width: 200px; float: left;"><label for="exampleInputEmail1">Full Name</label></div>
                        <div style="width: 10px; float: left;"> : </div>
                        <div>{{ $data->first_name }} {{ $data->last_name }}</div>
                      </div>
                      <div class="form-group clearfix">
                        <div style="width: 200px; float: left;"><label for="exampleInputEmail1">Email</label></div>
                        <div style="width: 10px; float: left;"> : </div>
                        <div>{{ $data->email }}</div>
                      </div>
                      <div class="form-group clearfix">
                        <div style="width: 200px; float: left;"><label for="exampleInputEmail1">Phone Number</label></div>
                        <div style="width: 10px; float: left;"> : </div>
                        <div>{{ $data->phone }}</div>
                      </div>
                      <div class="form-group clearfix">
                        <div style="width: 200px; float: left;"><label for="exampleInputEmail1">Date of Birth</label></div>
                        <div style="width: 10px; float: left;"> : </div>
                        <div>@if($data->dob){{ date('d F Y',strtotime($data->dob)) }}@endif</div>
                      </div>
                      
                      <br>
                      </div>
                      <div class="tab-pane" id="quotation">
                        <div class="dataTable_wrapper table-responsive">
                          <table id="dataTableOrder"  class="table table-striped table-bordered table-hover datatable ">
                              <thead>
                                  <tr class="nosortable">
                                    <th>Quotation</th>
                                    <th>Buyer</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Car</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                  </tr>
                              </thead>
                              <tbody id="element-order">
                                @foreach ($quotations as $content)
                                    <tr>
                                        <td>{{ $content->quotation_number }}</td>
                                        <td>{{ ucwords(strtolower($content->first_name)) . ' ' . ucwords(strtolower($content->last_name)) }}</td>
                                        <td>{{ strtolower($content->email) }}</td>
                                        <td>{{ $content->phone }}</td>
                                        <td>{{ $content->product->name }}</td>
                                        <td>$ {{ number_format($content->price, 2, '.', ',')  }}</td>
                                        <td>@if($content->status == 1)
                                                <span class="badge bg-blue">Pending</span>
                                            @elseif($content->status == 2)
                                                <span class="badge bg-green">Fulfilled</span>
                                            @elseif($content->status == 3)
                                                <span class="badge bg-red">Unsuccessful</span>
                                            @endif
                                        </td>
                                    </tr>
                              @endforeach
                              </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="tab-pane" id="invoice">
                        <div class="dataTable_wrapper table-responsive">
                          <table id="dataTableOrder"  class="table table-striped table-bordered table-hover datatable ">
                              <thead>
                                  <tr class="nosortable">
                                    <th>Invoice</th>
                                    <th>Buyer</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Total invoice</th>
                                    <th>Payment Status</th>
                                    <th class="table-actions">Action</th>
                                  </tr>
                              </thead>
                              <tbody id="element-order">
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->invoice_number }}</td>
                                        <td>{{ $invoice->member ? ucwords(strtolower($invoice->member->first_name)) . ' ' . ucwords(strtolower($invoice->member->last_name)) : 'Guest' }}</td>
                                        <td>{{ strtolower($invoice->email) }}</td>
                                        <td>{{ $invoice->contact_no }}</td>
                                        <td>USD {{ number_format($invoice->total ,0,",",".") }}</td>
                                        
                                        
                                        <td>@if($invoice->status != 'paid')
                                            <a class="btn btn-info" onclick="return confirm('Are you want to set this quotation to paid ?');" href="{{ url(config('backpack.base.route_prefix', 'admin').'/invoice/paid/'.$invoice->id) }}">Confirm Payment</a>
                                            @else
                                            Paid
                                            @endif
                                        </td>
                                        <td>
                                        <div class="table-actions-hover">
                                                <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/invoice/detail/'.$invoice->id) }}">Detail</a>
                                                |
                                                <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/invoice/edit/'.$invoice->id) }}"><i class="fa fa-pencil fa-fw"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                              @endforeach
                              </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="tab-pane" id="shipment-document">
                        <div class="dataTable_wrapper table-responsive">
                          <table id="dataTableOrder"  class="table table-striped table-bordered table-hover datatable ">
                              <thead>
                                  <tr class="nosortable">
                                    <th>Quotation</th>
                                    <th>Member</th>
                                    <th>File</th>
                                    <th>Date</th>
                                    <th class="table-actions">Action</th>
                                  </tr>
                              </thead>
                              <tbody id="element-order">
                                @foreach ($shipments as $shipment)
                                    <tr>
                                        <td>{{ $shipment->invoice_number }}</td>
                                        <td>{{ $shipment->quotation ? ucwords(strtolower($shipment->quotation->first_name)) . ' ' . ucwords(strtolower($shipment->quotation->last_name)) : '' }}</td>
                                        <td>{{ $shipment->file }}</td>
                                        <td>{{ $shipment->created_at }}</td>
                                        <td><div class="table-actions-hover">
                                                <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/shipment_document/edit/'.$shipment->id) }}"><i class="fa fa-pencil fa-fw"></i></a>
                                                |
                                                <a target="_blank" href="{{ asset('upload/'.$shipment->file_path) }}"><i class="fa fa-download fa-fw"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                              @endforeach
                              </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
