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
      <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/product/insert') }}" enctype="multipart/form-data">
                      {!! csrf_field() !!}
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h4>Product Information</h4>
                </div>
                
                <div class="box-body">
                      <div class="col-md-6">
                      <div class="box">
                        <div class="box-body">
                        <div class="form-group @if($errors->has('chassis_no')) has-error @endif">
                          <label for="exampleInputEmail1">Chassis No <span style="color: red">*</span></label>
                          <input type="text" name="chassis_no" class="form-control" required  value="{{ isset($data) ? $data->chassis_no : old('chassis_no') }}">
                          @if($errors->has('chassis_no')) <span class="help-block">{{ $errors->first('chassis_no') }}</span>  @endif
                        </div>
                         <div class="form-group">
                              <label for="exampleInputEmail1">Brand <span style="color: red">*</span></label>
                              <select class="form-control" name="brand[]" required="required" id="brand" data-placeholder="Select Brand" style="width: 100%;">
                                <option>Select Brand</option>
                                @foreach($brands as $brand)
                                  <option value="{{$brand->id}}" @if(isset($data)) @if($data->brand[0]->id == $brand->id) selected @endif @else @if(old('brand') == $brand->id) selected @endif @endif>{{ $brand->name }}</option>
                                @endforeach
                              </select>
                              @if($errors->has('brand')) <span class="help-block">{{ $errors->first('brand') }}</span>  @endif
                        </div>
                        <div class="form-group">
                              <label for="exampleInputEmail1">Model  <span style="color: red">*</span></label>
                              <select class="form-control" name="model[]" required="required" id="model" data-placeholder="Select Model" style="width: 100%;">
                                <option>Select Model</option>
                                @foreach($models as $model)
                                  <option value="{{$model->id}}" @if(isset($data)) @if($data->model[0]->id == $model->id) selected @endif @else @if(old('model') == $model->id) selected @endif @endif>{{ $model->name }}</option>
                                @endforeach
                              </select>
                              @if($errors->has('model')) <span class="help-block">{{ $errors->first('model') }}</span>  @endif
                        </div>

                        <div class="form-group @if($errors->has('model_code')) has-error @endif">
                          <label for="exampleInputEmail1">Model Code</label>
                          <input type="text" name="model_code" class="form-control" value="{{ isset($data) ? $data->model_code : old('model_code') }}">
                        </div>

                        <div class="form-group">
                              <label for="exampleInputEmail1">Product Type  <span style="color: red">*</span></label>
                              <select class="form-control" name="product_type" required="required" id="product_type" data-placeholder="Select Product Type" style="width: 100%;">
                                <?php $types = array('Bus','Bus 20 Seats','Convertible','Coupe','Hatchback','Mini Bus','Mini Van','Mini Vehicle','Pick Up','Sedan','SUV','Truck','Van','Wagon','Forklift','Machinery','Tractor') ?>
                                <option>Select Product Type</option>
                                @foreach($types as $type)
                                <option value="{{ $type }}" @if(isset($data)) @if($data->product_type == $type) selected @endif @else @if(old('product_type') == $type) selected @endif @endif>{{ $type }}</option>
                                @endforeach
                              </select>
                        </div>
                        </div>
                      </div>

                        <div class="box">
                          <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Registration Year/Month  <span style="color: red">*</span></label>
                                <div class="row">
                                  <div class="col-md-6">
                                    <select class="form-control" name="registration_year" required="required" id="registration_year" data-placeholder="Select Registration Year" style="width: 100%;">
                                      <option>Select Registration Year</option>           
                                    </select>
                                    @if($errors->has('registration_year')) <span class="help-block">{{ $errors->first('registration_year') }}</span>  @endif
                                  </div>
                                  <div class="col-md-6">
                                    <select class="form-control" name="registration_month" required="required" id="registration_month" data-placeholder="Select Registration Month" style="width: 100%;">
                                      <option>Select Registration Month</option>
                                                  
                                    </select>
                                    @if($errors->has('registration_month')) <span class="help-block">{{ $errors->first('registration_month') }}</span>  @endif
                                  </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Manufacture Year/Month</label>
                                <div class="row">
                                  <div class="col-md-6">
                                    <select class="form-control" name="manufacture_year" required="required" id="manufacture_year" data-placeholder="Select Manufacture Year" style="width: 100%;">
                                      <option>Select Manufacture Year</option>           
                                    </select>
                                  </div>
                                  <div class="col-md-6">
                                    <select class="form-control" name="manufacture_month" required="required" id="manufacture_month" data-placeholder="Select Manufacture Month" style="width: 100%;">
                                      <option>Select Manufacture Month</option>
                                                  
                                    </select>
                                  </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Mileage  <span style="color: red">*</span></label>
                                <div class="row">
                                  <div class="col-md-6">
                                    <input type="number" step=0.01 name="mileage" class="form-control">
                                    @if($errors->has('mileage')) <span class="help-block">{{ $errors->first('mileage') }}</span>  @endif
                                  </div>
                                  <div class="col-md-6">
                                    <select class="form-control" name="mileage_km" required="required" id="mileage_km" style="width: 100%;">
                                      <option>KM</option>
                                      <option>Miles</option>          
                                    </select>
                                    @if($errors->has('mileage_km')) <span class="help-block">{{ $errors->first('mileage_km') }}</span>  @endif
                                  </div>
                                </div>
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Engine Capacity (cc) <span style="color: red">*</span></label>
                              <input type="text" name="engine_capacity" class="form-control">
                              @if($errors->has('engine_capacity')) <span class="help-block">{{ $errors->first('engine_capacity') }}</span>  @endif
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Engine No</label>
                              <input type="text" name="engine_no" class="form-control">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Fuel  <span style="color: red">*</span></label>
                              <select class="form-control" name="fuel" required="required" id="fuel" data-placeholder="Select Fuel" style="width: 100%;">
                                <option>Select Fuel</option>
                                <option>CNG</option>
                                <option>Diesel</option>
                                <option>Electric</option>
                                <option>Hybrid (Diesel)</option>
                                <option>Hybrid (Petrol)</option>
                                <option>LPG</option>
                                <option>Other Petro</option>
                              </select>
                              @if($errors->has('fuel')) <span class="help-block">{{ $errors->first('fuel') }}</span>  @endif
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Steering  <span style="color: red">*</span></label>
                              <select class="form-control" name="steering" required="required" id="steering" data-placeholder="Select Steering" style="width: 100%;">
                                <option>Left</option>
                                <option>Center</option>
                                <option>Right</option>
                              </select>
                              @if($errors->has('steering')) <span class="help-block">{{ $errors->first('steering') }}</span>  @endif
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Transmission <span style="color: red">*</span></label>
                              <select class="form-control" name="transmission[]" required="required" id="transmission" data-placeholder="Select Transmission" style="width: 100%;">
                                <option>Select Transmission</option>
                                @foreach($transmissions as $transmission)
                                  <option value="{{$transmission->id}}">{{ $transmission->name }}</option>
                                @endforeach
                              </select>
                              @if($errors->has('transmission')) <span class="help-block">{{ $errors->first('transmission') }}</span>  @endif
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Drive Type</label>
                              <select class="form-control" name="drive_type" id="drive_type" data-placeholder="Select Drive Type" style="width: 100%;">
                                <option value="">Select Drive Type</option>
                                <option value="2WD">2WD</option>
                                <option value="4WD">4WD</option>
                              </select>
                              @if($errors->has('steering')) <span class="help-block">{{ $errors->first('steering') }}</span>  @endif
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Color <span style="color: red">*</span></label>
                              <select class="form-control" name="color[]" required="required" id="transmission" data-placeholder="Select Color" style="width: 100%;">
                                <option>Select Color</option>
                                @foreach($transmissions as $transmission)
                                  <option value="{{$transmission->id}}">{{ $transmission->name }}</option>
                                @endforeach
                              </select>
                              @if($errors->has('color')) <span class="help-block">{{ $errors->first('color') }}</span>  @endif
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Engine Code</label>
                              <input type="text" name="engine_code" class="form-control">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Number of Doors <span style="color: red">*</span></label>
                              <input type="text" name="number_of_doors" required class="form-control">
                              @if($errors->has('number_of_doors')) <span class="help-block">{{ $errors->first('number_of_doors') }}</span>  @endif
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Seats <span style="color: red">*</span></label>
                              <input type="number" name="seats" required class="form-control">
                              @if($errors->has('seats')) <span class="help-block">{{ $errors->first('seats') }}</span>  @endif
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Total Seats </label>
                              <input type="number" name="total_seats" class="form-control">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Weight (kg)</label>
                              <input type="number" step="0.01" name="weight" class="form-control">
                              @if($errors->has('weight')) <span class="help-block">{{ $errors->first('weight') }}</span>  @endif
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Total Weight (kg)</label>
                              <input type="number" step="0.01" name="total_weight" class="form-control">
                              @if($errors->has('total_weight')) <span class="help-block">{{ $errors->first('total_weight') }}</span>  @endif
                            </div>

                          </div>
                        </div>


                        <!-- <div class="form-group @if($errors->has('name')) has-error @endif">
                          <label for="exampleInputEmail1">Name</label>
                          <input type="text" name="name" class="form-control">
                          @if($errors->has('name')) <span class="help-block">{{ $errors->first('name') }}</span>  @endif
                        </div> -->
                      </div>
                      <div class="col-md-6">
                        <div class="box">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Trade Price <span style="color: red">*</span></label>
                              <div class="input-group">
                                <span class="input-group-addon">USD</span>
                                <input type="number" min=0 step=".01" name="price" required class="form-control" id="price">
                                @if($errors->has('price')) <span class="help-block">{{ $errors->first('price') }}</span>  @endif
                              </div>
                            </div>
                          </div>
                        </div>
                       <!--  <div class="form-group">
                          <label for="exampleInputEmail1">Image</label><br>
                          <input type="file" name="image" class="form-control" required="required" accept="image/*">
                          
                        </div>   -->
                        <div class="box">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Remarks</label>
                              <textarea name="remarks" class="form-control my-editor"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="box">
                          <div class="box-body">
                            <label for="exampleInputEmail1">Thumbnail</label>
                             <div class="input-group">
                               <span class="input-group-btn">
                                 <a id="lfm-thumbnail" data-input="thumbnail_image" data-preview="holder_thumbnail" class="btn btn-primary">
                                   <i class="fa fa-picture-o"></i> Choose
                                 </a>
                               </span>
                               <input id="thumbnail_image" class="form-control" type="text" name="thumbnail">
                             </div>
                             <div id="holder_thumbnail" style="margin-top:15px;max-height:300px;"></div>
                             <br>

                            <label for="exampleInputEmail1">Image</label>
                             <div class="input-group">
                               <span class="input-group-btn">
                                 <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                   <i class="fa fa-picture-o"></i> Choose
                                 </a>
                               </span>
                               <input id="thumbnail" class="form-control" type="text" name="image">
                             </div>
                             <div id="holder" style="margin-top:15px;max-height:300px;"></div>
                             <br>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Features</label>
                          <div class="row">
                            <div class="col-md-3">
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox">
                                  Checkbox 1
                                </label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox">
                                  Checkbox 1
                                </label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox">
                                  Checkbox 1
                                </label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox">
                                  Checkbox 1
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                      <div class="box-body">
                        <div class="col-md-12">
                          <button type="submit" class="btn  btn-primary">Save</button>
                        </div>   
                      </div>
                      
                </div>
            </div>
          
        </div>
      </form>
    </div>
@endsection
@section('after_scripts')
 <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
<?php /* ?>
var lfm = function(id, type, options) {
  let button = document.getElementById(id);

  button.addEventListener('click', function () {
    var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
    var target_input = document.getElementById(button.getAttribute('data-input'));
    var target_preview = document.getElementById(button.getAttribute('data-preview'));

    window.open(route_prefix + '?type=' + type || 'file', 'FileManager', 'width=900,height=600');
    window.SetUrl = function (items) {
      var file_path = items.map(function (item) {
        return item.url;
      }).join(',');

      // set the value of the desired input to image url
      target_input.value = file_path;
      target_input.dispatchEvent(new Event('change'));

      // clear previous preview
      target_preview.innerHtml = '';

      // set or change the preview image src
      items.forEach(function (item) {
        let img = document.createElement('img')
        img.setAttribute('style', 'height: 10rem')
        img.setAttribute('src', item.thumb_url)
        target_preview.appendChild(img);
      });

      // trigger change event
      target_preview.dispatchEvent(new Event('change'));
    };
  });
};
var route_prefix = "http://cars-listing.test/filemanager";
lfm('lfm', 'file', {prefix: route_prefix});
$('#lfm').filemanager('file',{route_prefix});
  //$('#lfm').filemanager('image');
<?php */ ?>
var route_prefix = "url-to-filemanager";
$('#lfm').filemanager('file',{route_prefix});
$('#lfm-thumbnail').filemanager('file',{route_prefix});
</script>
@endsection