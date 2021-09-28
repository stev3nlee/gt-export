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
                    @include('vendor.backpack.base.inc.alert')

                    <div class="row">
                        <div class="col-md-3" style="margin-bottom: 10px;">
                            <div class="box-title"><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/member/create') }}" class="btn btn-success">Create Member</a></div>
                        </div>
                        
                    </div>

                    
                </div>

                <div class="box-body">
               

                    <div class="dataTable_wrapper">
                        <table id="dataTable" class="table table-striped table-bordered table-hover datatable">
                            <thead>
                                <tr class="nosortable">
                                    <th class="table-actions">Actions</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Verified</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody id="element-order">
                            
                              @foreach ($data as $content)
                                <tr>
                                    <td>
                                       <div class="table-actions-hover">
                                            <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/member/edit/'.$content->id) }}"><i class="fa fa-pencil fa-fw"></i></a>
                                           <!--  <a onclick="return confirm('Are you sure ?');" href="{{ url(config('backpack.base.route_prefix', 'admin').'/member/delete/'.$content->id) }}"><i class="fa fa-trash fa-fw"></i></a> -->
                                            <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/member/detail/'.$content->id) }}"><i class="fa fa-eye fa-fw"></i></a>
                                        </div>
                                    </td>
                                    <td>{{ ucwords(strtolower($content->first_name)) }} {{ ucwords(strtolower($content->last_name)) }}</td>
                                    
                                    <td>{{ strtolower($content->email) }}</td>
                                    <td>{{$content->phone}}</td>
                                    <td>@if($content->guest == 0)<?php if($content->verified == 0){ ?><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/member/verified/'.$content->id.'/1') }}" onclick="return confirm('Are you want to verify this member ?');">Not Verified</a><?php  }else{ ?><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/member/verified/'.$content->id.'/0') }}" onclick="return confirm('Are you want to unverify this member ?');">Verified</a><?php } ?> @else Guest @endif</td>
                                    <td>{{ date('d/m/Y H:i:s', strtotime($content->created_at)) }}</td>
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>
    </div>
@endsection
