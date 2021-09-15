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
        <div class="col-md-6">
            <div class="box box-default">
                @if(isset($data))
                    <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/shipment_document/update') }}" enctype="multipart/form-data">
                @else
                    <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/shipment_document/insert') }}" enctype="multipart/form-data">
                @endif
                <div class="box-header with-border">
                    @if(isset($data)) Update Shipping Document @else Create Shipping Document @endif
                </div>

                <div class="box-body">
                      {!! csrf_field() !!}
                      <div class="row">
                        <div class="col-md-10">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Quotation <span class="required">*</span></label>
                            <select name="quotation_id" class="form-control select2 select-quotation">
                              <option value="">Select Quotation</option>
                              @foreach($quotations as $quotation)
                              <option value="{{ $quotation->id }}" @if(isset($data)) @if($data->invoice_id == $quotation->id) selected @endif @endif>#{{ $quotation->invoice_number }}</option>
                              @endforeach
                            </select>
                            @if($errors->has('quotation_id')) <span class="help-block">{{ $errors->first('quotation_id') }}</span>  @endif
                          </div>

                        <div class="form-group @if($errors->has('file')) has-error @endif">
                            <label for="exampleInputEmail1">File</label>
                            @if(isset($data)) {{ $data->file }} @endif
                            <input type="file" name="file" class="form-control" required="required">
                            @if($errors->has('file')) <span class="help-block">{{ $errors->first('file') }}</span>  @endif
                          </div>
                        </div>
                      </div>
                      @if(isset($data))
                      <!-- <input type="hidden" name="quotation_id" value="{{ $data->quotation_id }}"> -->
                      <input type="hidden" name="id" value="{{ $data->id }}">
                      @endif
                  
                      <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
