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
                     <div class="col-md-10">
                    <div class="box-title"><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/product/create') }}" class="btn btn-success">Create Product</a></div>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/product/export') }}" class="btn btn-info">Export</a>
                    </div>
                </div>

                <div class="box-body">
                    <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#Active" data-toggle="tab"><b>Active Units ({{ $count_active }})</b></a></li>
                      <li><a href="#Inactive" data-toggle="tab"><b>Inactive Units ({{ $count_inactive }})</b></a></li>
                      <li><a href="#Reserved" data-toggle="tab"><b>Reserved Units ({{ $count_reserved }})</b></a></li>
                      <li><a href="#Non-Reserved" data-toggle="tab"><b>Non-Reserved Units ({{ $count_non_reserved }})</b></a></li>
                      <li><a href="#Sold" data-toggle="tab"><b>Sold Units ({{ $count_sold }})</b></a></li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="Active">
                        <div class="row">
                            <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select class="form-control" name="brand" id="brand_active" >
                                                <option value="">Select Brand</option>
                                                @foreach($brands as $brand)
                                                  <option value="{{$brand->id}}" @if(request('brand') == $brand->id) selected @endif>{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control" name="model" id="model_active">
                                                <option value="">Select Model</option>
                                                @foreach($models as $model)
                                                  <option value="{{$model->id}}" @if(request('model') == $model->id) selected @endif>{{ $model->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control" name="transmission" id="transmission_active">
                                                <option value="">Select Transmission</option>
                                                @foreach($transmissions as $transmission)
                                                  <option value="{{$transmission->id}}" @if(request('transmission') == $transmission->id) selected @endif>{{ $transmission->name }}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>
                            </div>
                        </div>
                        <br>
                        <div class="dataTable_wrapper table-responsive"">
                            <table id="active-units" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr class="nosortable">
                                        <th class="table-actions">Actions</th>
                                        <!-- <th>Model</th> -->
                                        <th width="200">Image</th>
                                        <th>Brand/Model/Model Code</th>
                                        <th>Registeration Year</th>
                                        <th>Chassis Number</th>
                                        <th>Mileage</th>
                                        <th>Discounted Price</th>
                                        <th>Price</th>
                                        <!-- <th>Brand</th> -->
                                        <th>Reserve</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>
                                <tbody id="element-order">
                                    <?php /* ?>
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
                                        <td><?php if($content->reserve == 0){ ?><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/product/reserve/'.$content->id.'/1') }}"><span class="badge bg-yellow">Not Reserve</span></a><?php  }else if($content->reserve == 1){ ?><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/product/reserve/'.$content->id.'/0') }}"><span class="badge bg-blue">Reserved</span></a><?php }else{ ?> <span class="badge bg-green">Paid</span> <?php } ?></td>
                                        <td><?php if($content->status == 0){ ?><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/product/status/'.$content->id.'/1') }}"><span class="badge bg-red">Inactive</span></a><?php  }else{ ?><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/product/status/'.$content->id.'/0') }}"><span class="badge bg-green">Active</span></a><?php } ?></td>
                                        <td>{{ date('d/m/Y H:i:s', strtotime($content->created_at)) }}</td>
                                    </tr>
                                  @endforeach
                                    <?php */ ?>
                                </tbody>
                            </table>

                        </div>
                        </div>
                          <div class="tab-pane" id="Inactive">
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <select class="form-control" name="brand" id="brand_inactive" >
                                                    <option value="">Select Brand</option>
                                                    @foreach($brands as $brand)
                                                      <option value="{{$brand->id}}" @if(request('brand') == $brand->id) selected @endif>{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select class="form-control" name="model" id="model_inactive">
                                                    <option value="">Select Model</option>
                                                    @foreach($models as $model)
                                                      <option value="{{$model->id}}" @if(request('model') == $model->id) selected @endif>{{ $model->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select class="form-control" name="transmission" id="transmission_inactive">
                                                    <option value="">Select Transmission</option>
                                                    @foreach($transmissions as $transmission)
                                                      <option value="{{$transmission->id}}" @if(request('transmission') == $transmission->id) selected @endif>{{ $transmission->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div> 
                                        </div>
                                </div>
                            </div>
                            <br>
                            <div class="dataTable_wrapper table-responsive"">
                                <table id="inactive-units" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr class="nosortable">
                                            <th class="table-actions">Actions</th>
                                            <!-- <th>Model</th> -->
                                            <th width="200">Image</th>
                                            <th>Brand/Model/Model Code</th>
                                            <th>Registeration Year</th>
                                            <th>Chassis Number</th>
                                            <th>Mileage</th>
                                            <th>Discounted Price</th>
                                            <th>Price</th>
                                            <!-- <th>Brand</th> -->
                                            <th>Reserve</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="element-order">
                                    </tbody>
                                </table>
                            </div>
                          </div>

                          <div class="tab-pane" id="Reserved">
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <select class="form-control" name="brand" id="brand_reserved" >
                                                    <option value="">Select Brand</option>
                                                    @foreach($brands as $brand)
                                                      <option value="{{$brand->id}}" @if(request('brand') == $brand->id) selected @endif>{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select class="form-control" name="model" id="model_reserved">
                                                    <option value="">Select Model</option>
                                                    @foreach($models as $model)
                                                      <option value="{{$model->id}}" @if(request('model') == $model->id) selected @endif>{{ $model->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select class="form-control" name="transmission" id="transmission_reserved">
                                                    <option value="">Select Transmission</option>
                                                    @foreach($transmissions as $transmission)
                                                      <option value="{{$transmission->id}}" @if(request('transmission') == $transmission->id) selected @endif>{{ $transmission->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div> 
                                        </div>
                                </div>
                            </div>
                            <br>
                            <div class="dataTable_wrapper table-responsive"">
                                <table id="reserved-units" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr class="nosortable">
                                            <th class="table-actions">Actions</th>
                                            <!-- <th>Model</th> -->
                                            <th width="200">Image</th>
                                            <th>Brand/Model/Model Code</th>
                                            <th>Registeration Year</th>
                                            <th>Chassis Number</th>
                                            <th>Mileage</th>
                                            <th>Discounted Price</th>
                                            <th>Price</th>
                                            <!-- <th>Brand</th> -->
                                            <th>Reserve</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="element-order">
                                    </tbody>
                                </table>
                            </div>
                          </div>

                          <div class="tab-pane" id="Non-Reserved">
                            <div class="row">

                                <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <select class="form-control" name="brand" id="brand_non_reserved" >
                                                    <option value="">Select Brand</option>
                                                    @foreach($brands as $brand)
                                                      <option value="{{$brand->id}}" @if(request('brand') == $brand->id) selected @endif>{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select class="form-control" name="model" id="model_non_reserved">
                                                    <option value="">Select Model</option>
                                                    @foreach($models as $model)
                                                      <option value="{{$model->id}}" @if(request('model') == $model->id) selected @endif>{{ $model->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select class="form-control" name="transmission" id="transmission_non_reserved">
                                                    <option value="">Select Transmission</option>
                                                    @foreach($transmissions as $transmission)
                                                      <option value="{{$transmission->id}}" @if(request('transmission') == $transmission->id) selected @endif>{{ $transmission->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div> 
                                        </div>
                                </div>
                            </div>
                            <br>
                            <div class="dataTable_wrapper table-responsive"">
                                <table id="non-reserved-units" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr class="nosortable">
                                            <th class="table-actions">Actions</th>
                                            <!-- <th>Model</th> -->
                                            <th width="200">Image</th>
                                            <th>Brand/Model/Model Code</th>
                                            <th>Registeration Year</th>
                                            <th>Chassis Number</th>
                                            <th>Mileage</th>
                                            <th>Discounted Price</th>
                                            <th>Price</th>
                                            <!-- <th>Brand</th> -->
                                            <th>Reserve</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="element-order">
                                    </tbody>
                                </table>
                            </div>
                          </div>

                          <div class="tab-pane" id="Sold">
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <select class="form-control" name="brand" id="brand_sold" >
                                                    <option value="">Select Brand</option>
                                                    @foreach($brands as $brand)
                                                      <option value="{{$brand->id}}" @if(request('brand') == $brand->id) selected @endif>{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select class="form-control" name="model" id="model_sold">
                                                    <option value="">Select Model</option>
                                                    @foreach($models as $model)
                                                      <option value="{{$model->id}}" @if(request('model') == $model->id) selected @endif>{{ $model->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select class="form-control" name="transmission" id="transmission_sold">
                                                    <option value="">Select Transmission</option>
                                                    @foreach($transmissions as $transmission)
                                                      <option value="{{$transmission->id}}" @if(request('transmission') == $transmission->id) selected @endif>{{ $transmission->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div> 
                                        </div>
                                </div>
                            </div>
                            <br>
                            <div class="dataTable_wrapper table-responsive"">
                                <table id="sold-units" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr class="nosortable">
                                            <th class="table-actions">Actions</th>
                                            <!-- <th>Model</th> -->
                                            <th width="200">Image</th>
                                            <th>Brand/Model/Model Code</th>
                                            <th>Registeration Year</th>
                                            <th>Chassis Number</th>
                                            <th>Mileage</th>
                                            <th>Discounted Price</th>
                                            <th>Price</th>
                                            <!-- <th>Brand</th> -->
                                            <th>Reserve</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="element-order">
                                    </tbody>
                                </table>
                            </div>
                          </div>


                        </div>
                      </div>
                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('after_scripts')
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
    $(function () {
          
          var active_table = $('#active-units').DataTable({
              processing: true,
              serverSide: true,
              ajax: {
                    url: "{{ url(config('backpack.base.route_prefix').'/product/getData?type=active') }}",
                    data: function (d) {

                        d.brand = $('#brand_active').val();
                        d.transmission = $('#transmission_active').val();
                        d.model = $('#model_active').val();
                    }
              },
              columns: [
                  {
                      data: 'actions', 
                      name: 'actions', 
                      orderable: true, 
                      searchable: true
                  },
                  // {data: 'model', name: 'model'},
                  {data: 'image', name: 'image'},
                  {data: 'brand_model', name: 'brand_model'},
                  {data: 'registration_year', name: 'registration_year'},
                  {data: 'chassis_no', name: 'chassis_no'},
                  {data: 'mileage', name: 'mileage'},
                  {data: 'discount_price', name: 'discount_price'},
                  {data: 'price', name: 'price'},
                  // {data: 'brand', name: 'brand'},
                  {data: 'reserve', name: 'reserve'},
                  {data: 'status', name: 'status'},
                  {data: 'created_at', name: 'created_at'},
                  
              ]
          });

          var inactive_table = $('#inactive-units').DataTable({
              processing: true,
              serverSide: true,
              ajax: {
                    url: "{{ url(config('backpack.base.route_prefix').'/product/getData?type=inactive') }}",
                    data: function (d) {

                        d.brand = $('#brand_inactive').val();
                        d.transmission = $('#transmission_inactive').val();
                        d.model = $('#model_inactive').val();
                    }
              },
              columns: [
                  {
                      data: 'actions', 
                      name: 'actions', 
                      orderable: true, 
                      searchable: true
                  },
                  // {data: 'model', name: 'model'},
                  {data: 'image', name: 'image'},
                  {data: 'brand_model', name: 'brand_model'},
                  {data: 'registration_year', name: 'registration_year'},
                  {data: 'chassis_no', name: 'chassis_no'},
                  {data: 'mileage', name: 'mileage'},
                  {data: 'discount_price', name: 'discount_price'},
                  {data: 'price', name: 'price'},
                  // {data: 'brand', name: 'brand'},
                  {data: 'reserve', name: 'reserve'},
                  {data: 'status', name: 'status'},
                  {data: 'created_at', name: 'created_at'},
                  
              ]
          });

          var reserved_table = $('#reserved-units').DataTable({
              processing: true,
              serverSide: true,
              ajax: {
                    url: "{{ url(config('backpack.base.route_prefix').'/product/getData?type=reserved') }}",
                    data: function (d) {

                        d.brand = $('#brand_reserved').val();
                        d.transmission = $('#transmission_reserved').val();
                        d.model = $('#model_reserved').val();
                    }
              },
              columns: [
                  {
                      data: 'actions', 
                      name: 'actions', 
                      orderable: true, 
                      searchable: true
                  },
                  // {data: 'model', name: 'model'},
                  {data: 'image', name: 'image'},
                  {data: 'brand_model', name: 'brand_model'},
                  {data: 'registration_year', name: 'registration_year'},
                  {data: 'chassis_no', name: 'chassis_no'},
                  {data: 'mileage', name: 'mileage'},
                  {data: 'discount_price', name: 'discount_price'},
                  {data: 'price', name: 'price'},
                  // {data: 'brand', name: 'brand'},
                  {data: 'reserve', name: 'reserve'},
                  {data: 'status', name: 'status'},
                  {data: 'created_at', name: 'created_at'},
                  
              ]
          });

          var non_reserved_table = $('#non-reserved-units').DataTable({
              processing: true,
              serverSide: true,
              ajax: {
                    url: "{{ url(config('backpack.base.route_prefix').'/product/getData?type=non_reserved') }}",
                    data: function (d) {

                        d.brand = $('#brand_non_reserved').val();
                        d.transmission = $('#transmission_non_reserved').val();
                        d.model = $('#model_non_reserved').val();
                    }
              },
              columns: [
                  {
                      data: 'actions', 
                      name: 'actions', 
                      orderable: true, 
                      searchable: true
                  },
                  // {data: 'model', name: 'model'},
                  {data: 'image', name: 'image'},
                  {data: 'brand_model', name: 'brand_model'},
                  {data: 'registration_year', name: 'registration_year'},
                  {data: 'chassis_no', name: 'chassis_no'},
                  {data: 'mileage', name: 'mileage'},
                  {data: 'discount_price', name: 'discount_price'},
                  {data: 'price', name: 'price'},
                  // {data: 'brand', name: 'brand'},
                  {data: 'reserve', name: 'reserve'},
                  {data: 'status', name: 'status'},
                  {data: 'created_at', name: 'created_at'},
                  
              ]
          });

          var sold_table = $('#sold-units').DataTable({
              processing: true,
              serverSide: true,
              ajax: {
                    url: "{{ url(config('backpack.base.route_prefix').'/product/getData?type=sold') }}",
                    data: function (d) {

                        d.brand = $('#brand_sold').val();
                        d.transmission = $('#transmission_sold').val();
                        d.model = $('#model_sold').val();
                    }
              },
              columns: [
                  {
                      data: 'actions', 
                      name: 'actions', 
                      orderable: true, 
                      searchable: true
                  },
                  // {data: 'model', name: 'model'},
                  {data: 'image', name: 'image'},
                  {data: 'brand_model', name: 'brand_model'},
                  {data: 'registration_year', name: 'registration_year'},
                  {data: 'chassis_no', name: 'chassis_no'},
                  {data: 'mileage', name: 'mileage'},
                  {data: 'discount_price', name: 'discount_price'},
                  {data: 'price', name: 'price'},
                  // {data: 'brand', name: 'brand'},
                  {data: 'reserve', name: 'reserve'},
                  {data: 'status', name: 'status'},
                  {data: 'created_at', name: 'created_at'},
                  
              ]
          });
          $('#brand_active, #transmission_active, #model_active').on('change', function(e) {
                active_table.draw();
                e.preventDefault();
          });
          $('#brand_inactive, #transmission_inactive, #model_inactive').on('change', function(e) {
                inactive_table.draw();
                e.preventDefault();
          });
          $('#brand_reserved, #transmission_reserved, #model_reserved').on('change', function(e) {
                reserved_table.draw();
                e.preventDefault();
          });
          $('#brand_non_reserved, #transmission_non_reserved, #model_non_reserved').on('change', function(e) {
                non_reserved_table.draw();
                e.preventDefault();
          });
          $('#brand_sold, #transmission_sold, #model_sold').on('change', function(e) {
                sold_table.draw();
                e.preventDefault();
          });
          
    });
</script>
@endsection