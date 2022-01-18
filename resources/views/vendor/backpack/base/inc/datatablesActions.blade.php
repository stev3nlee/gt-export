
    <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/product/edit/'.$row->id) }}"><i class="fa fa-pencil fa-fw"></i></a>
    <a onclick="return confirm('Are you sure ?');" href="{{ url(config('backpack.base.route_prefix', 'admin').'/product/delete/'.$row->id) }}"><i class="fa fa-trash fa-fw"></i></a>