@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Country
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Country</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">

                <div class="box-header with-border">
                     @include('vendor.backpack.base.inc.alert')
                     <div class="box-title"><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/country/create') }}" class="btn btn-success">Create Country</a></div>
                </div>

                <div class="box-body">
                    <div class="dataTable_wrapper">
                        <table id="dataTable" class="table table-striped table-bordered table-hover datatable">
                            <thead>
                                <tr class="nosortable">
                                    <th class="table-actions">Actions</th>
                                    <th>Country</th>
                                    <th>Country Code</th>
                                    <!-- <th>Shipping Cost</th> -->
                                    <th width="150">Updated Date</th>
                                </tr>
                            </thead>
                            <tbody id="element-order">
                              @foreach ($data as $content)
                                <tr>
                                    <td>
                                       <div class="table-actions-hover">
                                            <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/country/edit/'.$content->id) }}"><i class="fa fa-pencil fa-fw"></i></a>
                                            <a onclick="return confirm('Are you sure ?');" href="{{ url(config('backpack.base.route_prefix', 'admin').'/country/delete/'.$content->id) }}"><i class="fa fa-trash fa-fw"></i></a>
                                        </div>
                                    </td>
                                    <td>{{ $content->country }}</td>
                                    <td>{{ $content->country_code }}</td>
                                    <!-- <td>$ {{ $content->shipping_cost }}</td> -->
                                    <td>{{ date('d/m/Y H:i:s', strtotime($content->updated_at)) }}</td>
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
