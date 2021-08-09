@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Update Address
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Update Address</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
        <form role="form" method="POST" id="editaddressform" action="{{ url(config('backpack.base.route_prefix').'/order/address_update') }}">
                      {!! csrf_field() !!}
            <div class="box box-default">
                <div class="box-header with-border">
                    Update Address

                </div>


                <div class="box-body">
                @include('vendor.backpack.base.inc.alert')
                    
                      <div class="col-sm-6 invoice-col">
                        <h3>Billing Address</h3>
                        <div class="form-group">
                          <label for="exampleInputEmail1">First Name</label>
                          <input type="text" name="first_name_billing" value="@if($data->order_billing_address){{ $data->order_billing_address->first_name }}@endif" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Last Name</label>
                          <input type="text" name="last_name_billing" value="@if($data->order_billing_address){{ $data->order_billing_address->last_name }}@endif" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Mobile</label>
                          <input type="text" name="mobile_billing" value="@if($data->order_billing_address){{ $data->order_billing_address->phone_number }}@endif" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Company</label>
                          <input type="text" name="company_billing" value="@if($data->order_billing_address){{ $data->order_billing_address->company }}@endif" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Address</label>
                          <textarea name="address_billing" class="form-control" required>@if($data->order_billing_address){{ $data->order_billing_address->address }}@endif</textarea>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Apartment, suite, etc.</label>
                          <input type="text" name="notes_billing" value="@if($data->order_billing_address){{ $data->order_billing_address->notes }}@endif" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Postal Code</label>
                          <input type="text" name="zip_code_billing" value="@if($data->order_billing_address){{ $data->order_billing_address->postal_code }}@endif" class="form-control" required>
                        </div>
                      </div>

                      <div class="col-sm-6 invoice-col">
                        <h3>Shipping Address</h3>
                        <div class="form-group">
                          <label for="exampleInputEmail1">First Name</label>
                          <input type="text" name="first_name_shipping" value="@if($data->order_shipping_address){{ $data->order_shipping_address->first_name }}@endif" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Last Name</label>
                          <input type="text" name="last_name_shipping" value="@if($data->order_shipping_address){{ $data->order_shipping_address->last_name }}@endif" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Mobile</label>
                          <input type="text" name="mobile_shipping" value="@if($data->order_shipping_address){{ $data->order_shipping_address->phone_number }}@endif" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Company</label>
                          <input type="text" name="company_shipping" value="@if($data->order_shipping_address){{ $data->order_shipping_address->company }}@endif" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Address</label>
                          <textarea name="address_shipping" class="form-control" required>@if($data->order_shipping_address){{ $data->order_shipping_address->address }}@endif</textarea>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Apartment, suite, etc.</label>
                          <input type="text" name="notes_shipping" value="@if($data->order_shipping_address){{ $data->order_shipping_address->notes }}@endif" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Postal Code</label>
                          <input type="text" name="zip_code_shipping" value="@if($data->order_shipping_address){{ $data->order_shipping_address->postal_code }}@endif" class="form-control" required>
                        </div>
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <input type="hidden" name="member_id" value="{{ $data->member_id }}">
                      </div>

                      <div class="col-sm-6 invoice-col">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Delivery Time</label>
                          
                          <select class="form-control select2" name="delivery_day_time_id">
                            <option selected disabled>Select Time</option>
                            @foreach($delivery_day as $day)
                            <optgroup label="{{ $day->day }}">
                              @foreach($day->delivery_time as $time)
                              <option value="{{ $time->pivot->id }}" @if($data->delivery_day_time_id == $time->pivot->id) selected @endif @if($time->pivot->status == 0 || $time->pivot->max_order <= 0) disabled @endif >{{ $time->time }}</option>
                              @endforeach
                            </optgroup>
                            @endforeach
                            </select>
                        </div>
                      </div>
                  
                      


                </div>
                <div class="box-body">
                  <div class="box-header with-border">
                    <h3 class="box-title">Product Category</h3>
                  </div>
                  <?php $i=1 ?>
                    @foreach($data->order_weeks as $order_week)
                    <div class="col-md-6">
                    <label for="exampleInputEmail1">Week {{ $i }} ({{ date('d F Y', strtotime($order_week->date)) }})</label>
                    <table class="table tableweek{{ $i }}">
                      @foreach($order_week->order_details as $order_detail)
                      <tr>
                        <td>
                          <select class="form-control select2" name="meal[{{$order_week->id}}][]" required="required">
                            <option>Select Meal</option>
                            @foreach($product as $prod)
                            <option value="{{ $prod->id }}" @if($prod->id == $order_detail->product_id) selected @endif>{{ $prod->name }}</option>
                            @endforeach
                          </select>
                        </td>
                        <td><button type="button" class="btn btnDelete btn-danger">Delete</button></td>
                      </tr>
                      @endforeach
                    </table>
                    <button type="button" class="btn btn-success add_meal" data-week-id="{{ $order_week->id }}" data-week="{{ $i }}" data-count="0" >Add</button>
                    </div>
                  <?php $i++; ?>
                    @endforeach
                </div>
                
            </div>
<button style="float: right;" type="submit" id="buttonsubmit" class="btn btn-primary">Submit</button>
                    </form>
        </div>
    </div>
@endsection
@section('after_scripts')
<script>
$('.add_meal').click(function(){
        week = $(this).data('week');
        week_id = $(this).data('week-id');
        console.log(week);
        $('.tableweek'+week).append('<tr><td>\
          <select class="form-control select2" name="meal['+week_id+'][]" data-placeholder="Select Meal" required="required">\
            <option value="">Select Product</option>\
            <?php foreach ($product as $list): ?>\
              <option value="<?php echo $list->id ?>"><?php echo $list->name ?></option>\
            <?php endforeach; ?>\
          </select>\
          </td><td><button type="button" class="btn btnDelete btn-danger">Delete</button></td></tr>');
        $('.btnDelete').click(function(){
          $(this).closest('tr').remove();
        })
        $('.select2').select2()
      });

$('.btnDelete').click(function(){
  $(this).closest('tr').remove();
})
</script>
@endsection