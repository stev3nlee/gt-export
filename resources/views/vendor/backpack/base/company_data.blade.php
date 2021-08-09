@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Company Data
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Company Data</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    Update Company Data
                </div>

                <div class="box-body">
                    <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/company_data/update') }}" enctype="multipart/form-data">
                      {!! csrf_field() !!}
                      
                      
                      <div class="form-group">
                        <label for="exampleInputEmail1">Logo</label><br>
                        @if(isset($data->logo))
                        <img src="{{ asset('/upload/'.$logo->image) }}" width="40%" /><br><br>
                        <input type="hidden" name="old_image" value="{{ $logo->image }}">
                        @endif
                        <input type="file" name="image" class="form-control">
                        
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <textarea name="email" class="form-control my-editor">@if(isset($data->email)){{ $data->email }} @endif</textarea>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputEmail1">Addesss</label>
                        <textarea name="address" class="form-control my-editor">@if(isset($data->address)) {{ $data->address }} @endif</textarea>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Operating Hours</label>
                        <textarea name="hours" class="form-control my-editor">@if(isset($data->hours)){{ $data->hours }} @endif</textarea>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Contact</label>
                        <textarea name="telephone" class="form-control my-editor">@if(isset($data->telephone)) {{ $data->telephone }} @endif</textarea>
                      </div>

                      <!-- <div class="form-group">
                        <label for="exampleInputEmail1">Whatsapp</label>
                        <input type="text" name="whatsapp" class="form-control" value="@if(isset($data->whatsapp)) {{ $data->whatsapp }} @endif">
                      </div>
 -->                      <div class="form-group">
                        <label for="exampleInputEmail1">Facebook</label>
                        <input type="text" name="facebook" class="form-control" value="@if(isset($data->facebook)){{ $data->facebook }}@endif">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Instagram</label>
                        <input type="text" name="instagram" class="form-control" value="@if(isset($data->instagram)){{ $data->instagram }}@endif">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">LinkedIn</label>
                        <input type="text" name="linkedin" class="form-control" value="@if(isset($data->linkedin)){{ $data->linkedin }}@endif">
                      </div>
                      <!-- <div class="form-group">
                        <label for="exampleInputEmail1">Twitter</label>
                        <input type="text" name="twitter" class="form-control" value="@if(isset($data->twitter)) {{ $data->twitter }} @endif">
                      </div> -->

                      <!-- <div class="form-group">
                        <label for="exampleInputEmail1">Google Map</label>
                        <textarea name="google_map" class="form-control">@if(isset($data->google_map)) {{ $data->google_map }} @endif</textarea>
                      </div> -->
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
