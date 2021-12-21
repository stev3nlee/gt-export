@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Brand
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Brand</li>
      </ol>
    </section>
@endsection


@section('content')
<style>
.grabbable {
    cursor: move; /* fallback if grab cursor is unsupported */
    cursor: grab;
    cursor: -moz-grab;
    cursor: -webkit-grab;
}

 /* (Optional) Apply a "closed-hand" cursor during drag operation. */
.grabbable:active {
    cursor: grabbing;
    cursor: -moz-grabbing;
    cursor: -webkit-grabbing;
}
</style>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">

                <div class="box-header with-border">
                    @include('vendor.backpack.base.inc.alert')
                    <div class="box-title"><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/brand/create') }}" class="btn btn-success">Create Brand</a></div>
                </div>

                <div class="box-body">
                    <div class="dataTable_wrapper">
                        <table id="yajra" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr class="nosortable">
                                    <th class="table-actions">Actions</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody >
                              
                            </tbody>
                        </table>
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
          
          var table = $('#yajra').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ url(config('backpack.base.route_prefix').'/datatable/getData') }}",
              columns: [
                  {
                      data: 'action', 
                      name: 'action', 
                      orderable: true, 
                      searchable: true
                  },
                  {data: 'name', name: 'name'},
                  {data: 'description', name: 'description'},
                  {data: 'status', name: 'status'},
                  {data: 'created_at', name: 'created_at'},
                  
              ]
          });
          
        });
</script>
@endsection