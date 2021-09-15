@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Products
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Products</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">

                <div class="box-header with-border">
                     @include('vendor.backpack.base.inc.alert')
                    <div class="box-title"><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/product/create') }}" class="btn btn-success">Create Product</a></div>
                </div>

                <div class="box-body">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <form action="{{ url()->current() }}" class="pull-right" style="width: 100%;">
                                <div class="row">
                                    
                                    <div class="col-md-3">
                                        <select class="form-control" name="brand" id="brand" onChange="this.form.submit()">
                                            <option value="">Select Brand</option>
                                            @foreach($brands as $brand)
                                              <option value="{{$brand->id}}" @if(request('brand') == $brand->id) selected @endif>{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control" name="transmission" id="transmission" onChange="this.form.submit()">
                                            <option value="">Select Transmission</option>
                                            @foreach($transmissions as $transmission)
                                              <option value="{{$transmission->id}}" @if(request('transmission') == $transmission->id) selected @endif>{{ $transmission->name }}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                    <div class="col-md-3">
                                        <select class="form-control" name="model" id="model" onChange="this.form.submit()">
                                            <option value="">Select Model</option>
                                            @foreach($models as $model)
                                              <option value="{{$model->id}}" @if(request('model') == $model->id) selected @endif>{{ $model->name }}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                    <div class="col-md-3" style="float: right;">
                                        <input type="text" name="keyword" class="form-control" placeholder="Search" value="{{ request('keyword') }}">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover datatable">
                            <thead>
                                <tr class="nosortable">
                                    <th class="table-actions">Actions</th>
                                    <th>Model</th>
                                    <th width="200">Image</th>
                                    <th>Price</th>
                                    <th>Brand</th>
                                    <th>Reserve</th>
                                    <th>Status</th>
                                    <th width="150">Created Date</th>
                                </tr>
                            </thead>
                            <tbody id="element-order">
                              @foreach ($data as $content)
                                <tr>
                                    <td>
                                       <div class="table-actions-hover">
                                            <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/product/edit/'.$content->id) }}"><i class="fa fa-pencil fa-fw"></i></a>
                                            <a onclick="return confirm('Are you sure ?');" href="{{ url(config('backpack.base.route_prefix', 'admin').'/product/delete/'.$content->id) }}"><i class="fa fa-trash fa-fw"></i></a>
                                        </div>
                                    </td>
                                    <td>@if($content->model){{ $content->model[0]->name }}@endif</td>
                                    <td>
                                        @if(isset($content->product_image[0]))<img src="{{ $content->product_image[0]->image }}" width="40%" />@endif
                                    </td>
                                    <td>@if($content->price)$ {{ $content->price }}@endif</td>
                                    <td>@if($content->brand){{ $content->brand[0]->name }}@endif</td>
                                    <td><?php if($content->reserve == 0){ ?><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/product/reserve/'.$content->id.'/1') }}"><span class="badge bg-yellow">Not Reserve</span></a><?php  }else{ ?><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/product/reserve/'.$content->id.'/0') }}"><span class="badge bg-blue">Reserved</span></a><?php } ?></td>
                                    <td><?php if($content->status == 0){ ?><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/product/status/'.$content->id.'/1') }}"><span class="badge bg-red">Inactive</span></a><?php  }else{ ?><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/product/status/'.$content->id.'/0') }}"><span class="badge bg-green">Active</span></a><?php } ?></td>
                                    <td>{{ $content->created_at }}</td>
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
