@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
@endsection


@section('content')
<style>
  .info-box{
    min-height: 0;
  }
  .info-box-content {
    margin-left: 0;
  }
  .info-box-text {
    font-size: 13px;
  }
</style>
      <div class="row">
        
          

        </div>
        



@endsection