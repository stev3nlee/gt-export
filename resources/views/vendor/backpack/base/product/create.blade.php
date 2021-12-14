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
      @if(isset($data))
      <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/product/update') }}" enctype="multipart/form-data">
      @else
      <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/product/insert') }}" enctype="multipart/form-data">
      @endif
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
                              <select class="form-control" name="brand[]" required="required" id="select-brand" data-placeholder="Select Brand" style="width: 100%;">
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
                                @if($data)
                                @foreach($models as $model)
                                  <option value="{{$model->id}}" @if(isset($data)) @if($data->model[0]->id == $model->id) selected @endif @else @if(old('model') == $model->id) selected @endif @endif>{{ $model->name }}</option>
                                @endforeach
                                @endif
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
                                      {{ $last= date('Y')-20 }}
                                      {{ $now = date('Y') }}

                                      @for ($i = $now; $i >= $last; $i--)
                                          <option value="{{ $i }}" @if(isset($data)) @if($data->registration_year == $i) selected @endif @else @if(old('registration_year') == $i) selected @endif @endif>{{ $i }}</option>
                                      @endfor        
                                    </select>
                                    @if($errors->has('registration_year')) <span class="help-block">{{ $errors->first('registration_year') }}</span>  @endif
                                  </div>
                                  <div class="col-md-6">
                                    <select class="form-control" name="registration_month" required="required" id="registration_month" data-placeholder="Select Registration Month" style="width: 100%;">
                                      <option>Select Registration Month</option>
                                      <?php for($i=1; $i<=12; $i++){ $month = date('F', mktime(0, 0, 0, $i, 10)); ?>
                                          <option value="{{ $month }}"  @if(isset($data)) @if($data->registration_month == $month) selected @endif @else @if(old('registration_month') == $month) selected @endif @endif>{{ $month }}</option>
                                      <?php } ?>
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
                                      {{ $last= date('Y')-20 }}
                                      {{ $now = date('Y') }}

                                      @for ($i = $now; $i >= $last; $i--)
                                          <option value="{{ $i }}" @if(isset($data)) @if($data->manufacture_year == $i) selected @endif @else @if(old('manufacture_year') == $i) selected @endif @endif>{{ $i }}</option>
                                      @endfor         
                                    </select>
                                  </div>
                                  <div class="col-md-6">
                                    <select class="form-control" name="manufacture_month" id="manufacture_month" data-placeholder="Select Manufacture Month" style="width: 100%;">
                                      <option value="">Select Manufacture Month</option>
                                      <?php for($i=1; $i<=12; $i++){ $month = date('F', mktime(0, 0, 0, $i, 10)); ?>
                                          <option value="{{ $month }}" @if(isset($data)) @if($data->manufacture_month == $month) selected @endif @else @if(old('manufacture_month') == $month) selected @endif @endif>{{ $month }}</option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Mileage  <span style="color: red">*</span></label>
                                <div class="row">
                                  <div class="col-md-6">
                                    <input type="number" step=0.01 name="mileage" required class="form-control" value="{{ isset($data) ? $data->mileage : old('mileage') }}">
                                    @if($errors->has('mileage')) <span class="help-block">{{ $errors->first('mileage') }}</span>  @endif
                                  </div>
                                  <div class="col-md-6">
                                    <select class="form-control" name="mileage_km" required="required" id="mileage_km" style="width: 100%;">
                                      <option value="KM" @if(isset($data)) @if($data->mileage_km == 'KM') selected @endif @else @if(old('mileage_km') == 'KM') selected @endif @endif>KM</option>
                                      <option value="Miles" @if(isset($data)) @if($data->mileage_km == 'Miles') selected @endif @else @if(old('mileage_km') == 'Miles') selected @endif @endif>Miles</option>          
                                    </select>
                                    @if($errors->has('mileage_km')) <span class="help-block">{{ $errors->first('mileage_km') }}</span>  @endif
                                  </div>
                                </div>
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Location <span style="color: red">*</span></label>
                              <input type="text"  name="location" required class="form-control" value="{{ isset($data) ? $data->location : old('location') }}">
                              @if($errors->has('location')) <span class="help-block">{{ $errors->first('location') }}</span>  @endif
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Engine Capacity (cc) <span style="color: red">*</span></label>
                              <input type="number" step="0.01" name="engine_capacity" required class="form-control" value="{{ isset($data) ? $data->engine_capacity : old('engine_capacity') }}">
                              @if($errors->has('engine_capacity')) <span class="help-block">{{ $errors->first('engine_capacity') }}</span>  @endif
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Engine No</label> 
                              <input type="text" name="engine_no" class="form-control" value="{{ isset($data) ? $data->engine_no : old('engine_no') }}">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Fuel <span style="color: red">*</span></label>
                              <select class="form-control" name="fuel" required="required" id="fuel" data-placeholder="Select Fuel" style="width: 100%;">
                                <?php $fuels = array('CNG','Diesel','Electric','Hybrid (Diesel)','Hybrid (Petrol)','LPG','Other','Petrol') ?>
                                <option value="">Select Fuel</option>
                                @foreach($fuels as $fuel)
                                <option value="{{ $fuel }}" @if(isset($data)) @if($data->fuel == $fuel) selected @endif @else @if(old('fuel') == $fuel) selected @endif @endif>{{ $fuel }}</option>
                                @endforeach
                              </select>
                              @if($errors->has('fuel')) <span class="help-block">{{ $errors->first('fuel') }}</span>  @endif
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Steering  <span style="color: red">*</span></label>
                              <select class="form-control" name="steering" required="required" id="steering" data-placeholder="Select Steering" style="width: 100%;">
                                <option value="Left" @if(isset($data)) @if($data->steering == 'Left') selected @endif @else @if(old('steering') == 'Left') selected @endif @endif>Left</option>
                                <option value="Center" @if(isset($data)) @if($data->steering == 'Center') selected @endif @else @if(old('steering') == 'Center') selected @endif @endif>Center</option>
                                <option value="Right" @if(isset($data)) @if($data->steering == 'Right') selected @endif @else @if(old('steering') == 'Right') selected @endif @endif>Right</option>
                              </select>
                              @if($errors->has('steering')) <span class="help-block">{{ $errors->first('steering') }}</span>  @endif
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Transmission <span style="color: red">*</span></label>
                              <select class="form-control" name="transmission[]" required="required" id="transmission" data-placeholder="Select Transmission" style="width: 100%;">
                                <option>Select Transmission</option>
                                @foreach($transmissions as $transmission)
                                  <option value="{{$transmission->id}}"  @if(isset($data)) @if($data->transmission[0]->id == $transmission->id) selected @endif @else @if(old('transmission') == $transmission->id) selected @endif @endif>{{ $transmission->name }}</option>
                                @endforeach
                              </select>
                              @if($errors->has('transmission')) <span class="help-block">{{ $errors->first('transmission') }}</span>  @endif
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Drive Type</label>
                              <select class="form-control" name="drive_type" id="drive_type" data-placeholder="Select Drive Type" style="width: 100%;">
                                <option value="">Select Drive Type</option>
                                <option value="2WD" @if(isset($data)) @if($data->drive_type == '2WD') selected @endif @else @if(old('drive_type') == '2WD') selected @endif @endif>2WD</option>
                                <option value="4WD" @if(isset($data)) @if($data->drive_type == '4WD') selected @endif @else @if(old('drive_type') == '4WD') selected @endif @endif>4WD</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Color <span style="color: red">*</span></label>
                              <select class="form-control" name="color" required="required" id="color" data-placeholder="Select Color" style="width: 100%;">
                              <?php $colors = array('Beige','Black','Blue','Bronze','Brown','Gold','Gray','Green','Maroon','Orange','Pearl','Pink','Purple','Red','Silver','White','Yellow','Other') ?>
                                <option value>Select Color</option>
                                @foreach($colors as $color)
                                  <option value="{{$color}}" @if(isset($data)) @if($data->color == $color) selected @endif @else @if(old('color') == $color) selected @endif @endif>{{ $color }}</option>
                                @endforeach
                              </select>
                              @if($errors->has('color')) <span class="help-block">{{ $errors->first('color') }}</span>  @endif
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Engine Code</label>
                              <input type="text" name="engine_code" class="form-control"  value="{{ isset($data) ? $data->engine_code : old('engine_code') }}">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Number of Doors <span style="color: red">*</span></label>
                              <input type="text" name="number_of_doors" required class="form-control"  value="{{ isset($data) ? $data->number_of_doors : old('number_of_doors') }}">
                              @if($errors->has('number_of_doors')) <span class="help-block">{{ $errors->first('number_of_doors') }}</span>  @endif
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Seats <span style="color: red">*</span></label>
                              <input type="number" name="seats" required class="form-control" value="{{ isset($data) ? $data->seats : old('seats') }}">
                              @if($errors->has('seats')) <span class="help-block">{{ $errors->first('seats') }}</span>  @endif
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Total Seats </label>
                              <input type="number" name="total_seats" class="form-control"  value="{{ isset($data) ? $data->total_seats : old('total_seats') }}">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Weight (kg)</label>
                              <input type="number" step="0.01" name="weight" class="form-control" value="{{ isset($data) ? $data->weight : old('weight') }}">
                              @if($errors->has('weight')) <span class="help-block">{{ $errors->first('weight') }}</span>  @endif
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Total Weight (kg)</label>
                              <input type="number" step="0.01" name="total_weight" class="form-control" value="{{ isset($data) ? $data->total_weight : old('total_weight') }}">
                              @if($errors->has('total_weight')) <span class="help-block">{{ $errors->first('total_weight') }}</span>  @endif
                            </div>


                            <div class="form-group">
                              <label for="exampleInputEmail1">Dimensions</label><br>
                              <table class="table">
                                <tr>
                                  <th>Size (cm)</th>
                                  <th>Length (cm)</th>
                                  <th>Width (cm)</th>
                                  <th>Height (cm)</th>
                                </tr>
                                <tr>
                                  <td style="font-weight: bold;">M3 <span id="dimensions">{{ isset($data) ? $data->dimension : old('dimension') }}</span><input type="hidden" id="dimension_value"  name="dimension" class="form-control" value="{{ isset($data) ? $data->dimension : old('dimension') }}"></td>
                                  <td><input type="number" id="length" step="0.01" name="length" class="form-control" value="{{ isset($data) ? $data->length : old('length') }}"></td>
                                  <td><input type="number" id="width" step="0.01" name="width" class="form-control" value="{{ isset($data) ? $data->width : old('width') }}"></td>
                                  <td><input type="number" id="height" step="0.01" name="height" class="form-control" value="{{ isset($data) ? $data->height : old('height') }}"></td>
                                </tr>
                              </table>
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
                                <input type="number" min=0 step=".01" name="price" required class="form-control" id="price" value="{{ isset($data) ? $data->price : old('price') }}">
                                @if($errors->has('price')) <span class="help-block">{{ $errors->first('price') }}</span>  @endif
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Discount Price</label>
                              <div class="input-group">
                                <span class="input-group-addon">USD</span>
                                <input type="number" min=0 step=".01" name="discount_price" required class="form-control" id="discount_price" value="{{ isset($data) ? $data->discount_price : old('discount_price') }}">
                                @if($errors->has('discount_price')) <span class="help-block">{{ $errors->first('discount_price') }}</span>  @endif
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
                              <textarea name="remarks" class="form-control my-editor">{{ isset($data) ? $data->remarks : old('remarks') }}</textarea>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Description</label>
                              <textarea name="description" class="form-control my-editor">{{ isset($data) ? $data->description : old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">New Arrival Days </label>
                              <input type="number" name="new_arrival_days" class="form-control" @if(!isset($data)) required @endif  value="{{ isset($data) ? $data->new_arrival_days : old('new_arrival_days') }}">
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
                             <div id="holder_thumbnail" style="margin-top:15px;max-height:300px;">
                               @if(isset($data))
                                 @if($data->thumbnail)
                                  <img style="height: 10rem" src="{{ $data->thumbnail }}">
                                 @endif
                                @endif
                             </div>
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
                             <div id="holder" style="margin-top:15px;max-height:300px;">
                              @if(isset($data))
                               @if(count($data->product_image)>0)
                                @foreach($data->product_image as $image)
                                <img style="height: 10rem" src="{{ $image->image }}">
                                @endforeach
                               @endif
                              @endif
                             </div>
                             <br>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Features</label>
                          <div class="row">
                            <table class="table table-bordered">
                              @foreach($accessories as $acc)
                              <tr>
                                @foreach($acc as $abc)
                                <td><input type="checkbox" name="accessories[]" value="{{ $abc['id'] }}" @if(isset($data)) @foreach($data->accessories as $access) @if($access->id == $abc['id']) checked @endif @endforeach @else @endif> {{ $abc['name'] }}</td>
                                @endforeach
                              </tr>
                              @endforeach
                            </table>
                           
                          </div>
                        </div>
                        @if(isset($data))
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        @endif
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
$( "#length, #width, #height" ).keyup(function() {
      length = $('#length').val();
      width = $('#width').val();
      height = $('#height').val();

      if(length && width && height){
      dimension = (parseInt(length) * parseInt(width) * parseInt(height)) / 1000000;
      $('#dimensions').html(dimension.toFixed(3));
      $('#dimension_value').val(dimension.toFixed(3));
      }
});

 $('#select-brand').on('change', function() {
                var brandID = $(this).val();
                if(brandID) {
                    $.ajax({
                        url: '{{ url(config("backpack.base.route_prefix")."/brand/getModel") }}/'+brandID,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('#model').empty();
                            $('#model').append('<option value="">Select Model</option>');
                            $.each(data, function(key, value) {
                                $('#model').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });
                        }
                    });
                }else{
                    $('#model').empty();
                }
        });
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