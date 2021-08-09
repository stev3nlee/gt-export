@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Products Update
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Products Update</li>
      </ol>
    </section>
@endsection

@section('content')
    <div class="row">
      <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/product/update') }}" enctype="multipart/form-data">
                      {!! csrf_field() !!}
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h4>Product Information</h4>
                </div>
                
                <div class="box-body">
                      <div class="col-md-6">
                        <div class="form-group @if($errors->has('name')) has-error @endif">
                          <label for="exampleInputEmail1">Name</label>
                          <input type="text" name="name" class="form-control" value="{{ $data->name }}">
                          @if($errors->has('name')) <span class="help-block">{{ $errors->first('name') }}</span>  @endif
                        </div>

                        

                        <div class="form-group">
                          <label for="exampleInputEmail1">Price</label>
                          <div class="input-group">
                            <span class="input-group-addon">S$</span>
                            <input type="number" min=0 step=".01" name="price" class="form-control" id="price" value="{{ $data->price }}">
                          </div>
                        </div>

                        
                        <div class="form-group">
                              <label for="exampleInputEmail1">Brand</label>
                              <select class="form-control" name="brand[]" required="required" id="brand" data-placeholder="Select Brand" style="width: 100%;">
                                <option>Select Brand</option>
                                @foreach($brands as $brand)
                                  <option value="{{$brand->id}}" @if($data->brand[0]->id == $brand->id) selected @endif>{{ $brand->name }}</option>
                                @endforeach
                              </select>
                        </div>

                        <div class="form-group">
                              <label for="exampleInputEmail1">Model</label>
                              <select class="form-control" name="model[]" required="required" id="model" data-placeholder="Select Model" style="width: 100%;">
                                <option>Select Model</option>
                                @foreach($models as $model)
                                  <option value="{{$model->id}}" @if($data->model[0]->id == $brand->id) selected @endif>{{ $model->name }}</option>
                                @endforeach
                              </select>
                        </div>

                        <div class="form-group">
                              <label for="exampleInputEmail1">Transmission</label>
                              <select class="form-control" name="transmission[]" required="required" id="transmission" data-placeholder="Select Transmission" style="width: 100%;">
                                <option>Select Transmission</option>
                                @foreach($transmissions as $transmission)
                                  <option value="{{$transmission->id}}" @if($data->transmission[0]->id == $brand->id) selected @endif>{{ $transmission->name }}</option>
                                @endforeach
                              </select>
                        </div>
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        
                      </div>
                      <div class="col-md-6">
                        
                       <!--  <div class="form-group">
                          <label for="exampleInputEmail1">Image</label><br>
                          <input type="file" name="image" class="form-control" required="required" accept="image/*">
                          
                        </div>   -->
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
                         @if(count($data->product_image)>0)
                          @foreach($data->product_image as $image)
                          <img style="height: 10rem" src="{{ $image->image }}">
                          @endforeach
                         @endif
                         </div>
                         <br>
                         <div class="form-group">
                          <label for="exampleInputEmail1">Description</label>
                          <textarea name="description" class="form-control my-editor">{{ $data->description }}</textarea>
                        </div>
                      </div>
                      
                </div>
            </div>
            <div class="box box-default">
                <div class="box-header with-border">
                    <h4>Product Detail</h4>
                </div>
                
                <div class="box-body">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Economy & Performance</label>
                          <textarea name="economy_performance" class="form-control my-editor">{{ $data->economy_performance }}</textarea>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Exterior Features</label>
                          <textarea name="exterior_features" class="form-control my-editor">{{ $data->exterior_features }}</textarea>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Technical</label>
                          <textarea name="technical" class="form-control my-editor">{{ $data->technical }}</textarea>
                        </div>
                        <button type="submit" class="btn  btn-primary">Save</button>
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
  //$('#lfm').filemanager('image');
<?php */ ?>
var route_prefix = "url-to-filemanager";
$('#lfm').filemanager('file',{route_prefix});
</script>
@endsection