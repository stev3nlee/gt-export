@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Invoice
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Invoice</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                @if(isset($data))
                    <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/invoice/update') }}">
                @else
                    <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/invoice/insert') }}">
                @endif
                <div class="box-header with-border">
                    Create Invoice <div style="float: right;"><input type="text" name="invoice_number" value="{{ isset($data) ? $data->invoice_number : $invoice_number }}">
                    @if($errors->has('invoice_number')) <span class="help-block">{{ $errors->first('invoice_number') }}</span>  @endif</div>
                </div>

                <div class="box-body">
                      {!! csrf_field() !!}
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Quotation <span class="required">*</span></label>
                            <select name="quotation_id" class="form-control select2 select-quotation" @if(isset($data)) disabled="disabled" @endif>
                              <option value="0">Select Quotation</option>
                              @foreach($quotations as $quotation)
                              <option value="{{ $quotation->id }}" @if(isset($data)) @if($data->quotation_id == $quotation->id) selected @endif @endif>{{ $quotation->quotation_number }}</option>
                              @endforeach
                            </select>
                            @if($errors->has('quotation_id')) <span class="help-block">{{ $errors->first('quotation_id') }}</span>  @endif
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname">Consignee Adress <span class="required">*</span></label>
                                        <input type="text" name="consignee_address" class="form-control" value="{{ isset($data) ? $data->consignee_address : old('consignee_address') }}"/>
                                        @if($errors->has('consignee_address')) <span class="help-block">{{ $errors->first('consignee_address') }}</span>  @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="lname">Contact No <span class="required">*</span></label>
                                        <input name="contact_no" type="text" class="form-control" value="{{ isset($data) ? $data->contact_no : old('contact_no') }}"/>
                                        @if($errors->has('contact_no')) <span class="help-block">{{ $errors->first('contact_no') }}</span>  @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="lname">Email <span class="required">*</span></label>
                                        <input name="email" type="email" class="form-control" value="{{ isset($data) ? $data->email : old('email') }}"/>
                                        @if($errors->has('email')) <span class="help-block">{{ $errors->first('email') }}</span>  @endif
                                    </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fname">Date <span class="required">*</span></label>
                                    <input name="date" type="date" class="form-control" value="{{ isset($data) ? $data->date : old('date') }}"/>
                                    @if($errors->has('date')) <span class="help-block">{{ $errors->first('date') }}</span>  @endif
                                </div>
                                <div class="form-group">
                                    <label for="lname">Payment Terms <span class="required">*</span></label>
                                    <input name="payment_terms" type="text" class="form-control" value="{{ isset($data) ? $data->payment_terms : old('payment_terms') }}"/>
                                    @if($errors->has('payment_terms')) <span class="help-block">{{ $errors->first('payment_terms') }}</span>  @endif
                                </div>
                                <div class="form-group">
                                    <label for="lname">Type <span class="required">*</span></label>
                                    <input name="type" type="text" class="form-control" value="{{ isset($data) ? $data->type : old('type') }}"/>
                                    @if($errors->has('type')) <span class="help-block">{{ $errors->first('type') }}</span>  @endif
                                </div>
                                <div class="form-group">
                                    <label for="lname">Port of Destination <span class="required">*</span></label>
                                    <input name="port_of_destination" type="text" class="form-control" value="{{ isset($data) ? $data->port_of_destination : old('port_of_destination') }}"/>
                                    @if($errors->has('port_of_destination')) <span class="help-block">{{ $errors->first('port_of_destination') }}</span>  @endif
                                </div>
                            </div>

                        </div>
                      </div>
                      @if(isset($data))
                      <input type="hidden" name="quotation_id" value="{{ $data->quotation_id }}">
                      <input type="hidden" name="id" value="{{ $data->id }}">
                      @endif
                      

                      <div class="row">
                        <div class="box-body">
                          <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover datatable" id="detail-table">
                                <thead>
                                    <tr class="nosortable">
                                        <th>Vehicle No</th>
                                        <th>Make & Model</th>
                                        <th>Colour</th>
                                        <th>ORD</th>
                                        <th>Engine Cap</th>
                                        <th>Mileage</th>
                                        <th>Chassis No</th>
                                        <th>Engine No</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                @if(isset($data))
                                @foreach($data->invoice_details as $item)
                                <tr>
                                    <input type="hidden" name="detail[detail_id][]" value="{{ $item->id }}">
                                    <td><input type="text" class="form-control vehicle_no" name="detail[vehicle_number][]" value="{{ $item->vehicle_number }}"></td>
                                    <td><input type="hidden" class="form-control product_id" name="detail[product_id][]" value="{{ $item->product_id }}"><input type="text" class="form-control make_model" name="detail[make_model][]" value="{{ $item->make_model }}"></td>
                                    <td><input type="text" class="form-control colour" name="detail[colour][]" value="{{ $item->colour }}"></td>
                                    <td><input type="text" class="form-control ord" name="detail[ord][]" value="{{ $item->ord }}"></td>
                                    <td><input type="text" class="form-control engine_cap" name="detail[engine_cap][]" value="{{ $item->engine_cap }}"></td>
                                    <td><input type="text" class="form-control mileage" name="detail[mileage][]" value="{{ $item->mileage }}"></td>
                                    <td><input type="text" class="form-control chassis_no" name="detail[chassis_no][]" value="{{ $item->chassis_no }}"></td>
                                    <td><input type="text" class="form-control engine_no" name="detail[engine_no][]" value="{{ $item->engine_no }}"></td>
                                    <td><input type="number" step=0.01 class="form-control amount" name="detail[amount][]" value="{{ $item->amount }}"></td>
                                </tr>
                                @endforeach
                                @else
                                <tbody id="element-order">
                                    <?php /* ?>
                                    <tr>
                                        <input type="hidden" name="detail[detail_id][]" value="0">
                                        <td><select class="form-control select2 product_select">
                                              <option value="0">Select Product</option>
                                              @foreach($products as $product)
                                              <option value="{{ $product->id }}|@if($product->discount_price > 0){{ $product->discount_price }}@else{{ $product->price }}@endif">{{ $product->name }}</option>
                                              @endforeach
                                            </select>
                                        </td>
                                        
                                        <td><input type="hidden" class="form-control product_id" name="detail[product_id][]"><input type="text" class="form-control product_price" name="detail[product_price][]"></td>
                                        <td><input type="number" class="form-control product_quantity" name="detail[product_quantity][]"></td>
                                        <td><input type="text" class="form-control amount" name="detail[amount][]"></td>
                                        <td><input type="text" class="form-control amount" name="detail[amount][]"></td>
                                        <td><input type="text" class="form-control amount" name="detail[amount][]"></td>
                                        <td><input type="text" class="form-control amount" name="detail[amount][]"></td>
                                        <td><input type="text" class="form-control amount" name="detail[amount][]"></td>
                                        <td><input type="text" class="form-control amount" name="detail[amount][]"></td>
                                        <td id="delete-row"><i class="fa fa-trash fa-fw" style="color: red; cursor: pointer;"></i></td>
                                    </tr>
                                    <?php */ ?>
                                </tbody>
                                @endif
                                <!-- <tfoot>
                                <tr>
                                    <td colspan="10" class="text-center bg-slate" id="add-row"><span><i class="fa fa-plus fa-fw" style="cursor: pointer;"></i> Add another row</span></td>
                                </tr>
                                </tfoot> -->
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea name="remarks" class="form-control" >{{ isset($data) ? $data->remarks : old('remarks') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="form-group">
                                    <input type="hidden" name="subtotal">
                                    <label class="col-sm-7 control-label text-right"><h4>Subtotal</h4></label>
                                    <div class="col-sm-5"><label class="col-sm-10 control-label text-right"
                                            id="subtotal">0</label></div>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-right">Discount</label>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <select id="discount_type" name="discount_type" class="form-control">
                                                    <option value="%"
                                                        {{ is_null(old('discount_type')) ? (isset($data) ? ($data->discount_type == '%' ? 'selected' : null) : 'selected') : (old('discount_type') == '%' ? 'selected' : null) }}>
                                                        %</option>
                                                    <option value="#"
                                                        {{ is_null(old('discount_type')) ? (isset($data) ? ($data->discount_type == '#' ? 'selected' : null) : null) : (old('discount_type') == '#' ? 'selected' : null) }}>
                                                        #</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control input-xs text-right" name="discount"
                                                    value="{{ is_null(old('discount')) ? (isset($data) ? $data->discount : 0) : old('discount') }}"
                                                    id="discount">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="subtotal_after_discount">
                                    <input type="hidden" name="discount_amount">
                                    <div class="col-sm-5"><label class="col-sm-10 control-label text-right"
                                            id="subtotal_after_discount">{{ is_null(old('discount')) ? (isset($data) ? $data->discount : 0) : old('discount') }}</label>
                                    </div>
                                </div>
                            </div>
 -->      
        
                            <div class="row">
                                <div class="form-group">
                                    <!-- <label class="col-sm-7 control-label text-right">
                                        <select name="shipping" class="form-control" id="shipping" >
                                            <option value=""  selected disabled>@lang('yum.please_select') Shipping</option>
                                          </select>
                                    </label> -->
                                    <div class="col-sm-5">
                                        <input type="hidden" name="shipping_fee" id="input_shipping">
                                        <input type="hidden" name="shipping_type" id="input_shipping_type">
                                        <label class="col-sm-10 control-label text-right">
                                            <h4 id="shipping_price"></h4>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">&nbsp;</div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-7 control-label text-right">
                                        <h4>Payment Due (<span id="currency_name">USD</span>)</h4>
                                    </label>
                                    <div class="col-sm-5">
                                        <input type="hidden" name="value" id="input_total">
                                        <label class="col-sm-10 control-label text-right">
                                            <h4 id="total"></h4>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row validation-error-label">{{ $errors->first('value') }}</div>
                        </div>
                      </div>
                  
                      <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('after_scripts')
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
    var u=1;
    $('.select-quotation').change(function() {
        var token = '{{ csrf_token() }}';
        var order_id = @if(isset($data)){{ $data->id }}@else 0 @endif;
        var url = "{{ url(config('backpack.base.route_prefix').'/quotation/data') }}";
        if(order_id){
            var url = "{{ url(config('backpack.base.route_prefix').'/invoice/data') }}";
        }
        u++;
        if (this.value > 0) {
            $.ajax({
                url: url,
                type: 'POST',
                data: { quotation_id: this.value, order_id: order_id, _token: token }
            }).done(function(data) {
              if(data.shipping_address){
                $('#city-value').val(data.shipping_address.city);
                $('#regency-value').val(data.shipping_address.district);
                $('#fname').val(data.shipping_address.first_name);
                $('#lname').val(data.shipping_address.last_name);
                $('#phone').val(data.shipping_address.phone_number);
                $('#email').val(data.shipping_address.email);
                $('#country').val(data.shipping_address.country).change();
                $('#province').val(data.shipping_address.province).change();
                $('#address').val(data.shipping_address.address);
                $('#postal').val(data.shipping_address.zip_code);
              }else if(data.order_shipping_address){
                $('#city-value').val(data.order_shipping_address.city);
                $('#regency-value').val(data.order_shipping_address.district);
                $('#fname').val(data.order_shipping_address.first_name);
                $('#lname').val(data.order_shipping_address.last_name);
                $('#phone').val(data.order_shipping_address.phone_number);
                $('#email').val(data.order_shipping_address.email);
                $('#country').val(data.order_shipping_address.country).change();
                $('#province').val(data.order_shipping_address.province).change();
                $('#address').val(data.order_shipping_address.address);
                $('#postal').val(data.order_shipping_address.postal_code);
              }else{
                $('#fname').val('');
                $('#lname').val('');
                $('#phone').val('');
                $('#email').val('');
                $('#country').val('');
                $('#province').val('').change();
                $('#city').val('').change();
                $('#address').val('');
                $('#postal').val('');
                $('#city-value').val('');
                $('#regency-value').val('');
              }
              var i = 0;
              $('#detail-table').find('tbody').html('');
                for (var key in data.product) {
                    addRow(u)
                    //calculateSubtotal(data.detail[key].amount);
                    //calculateTotal();
                    $('#shipping_fee').val(parseInt(data.delivery_fee));
                    //$('.item-row-'+u+'').eq(i).val(data.detail[key].id);
                    $('.packing-detail-id-'+u+'').eq(i).val(data.detail[key].id);
                    $('.cubic-row-'+u+'').eq(i).val(data.detail[key].total_cubic);
                    $('.colly-row-'+u+'').eq(i).val(data.detail[key].colly);
                    $('.item-name-'+u+'').eq(i).val(data.detail[key].item_description);
                    $('.booking-row-'+u+'').eq(i).val(data.detail[key].booking_no);
                     $('.quantity-row-'+u+'').eq(i).val(data.detail[key].quantity);
                    //$('.price-row-'+u+'').eq(i).val(data.detail[key].price);
                       
                    i++;
                }

              
            }).fail(function() {
                console.log('Fail to load member information')
            })
        } else {
            $('#fname').val('');
            $('#lname').val('');
            $('#phone').val('');
            $('#email').val('');
            $('#country').val('');
            $('#province').val('').change();
            $('#city').val('').change();
            $('#address').val('');
            $('#postal').val('');
            $('#city-value').val('');
            $('#regency-value').val('');
        }
    }).change();

    $('.product_select').on('change', function() {
        // Reset all input in row
        data = $(this).val();
        var fields = data.split('|');
        var product_id = fields[0];
        var product_price = fields[1];

        $(this).closest('tr').find('.product_price').val(product_price).trigger('input');
        $(this).closest('tr').find('.product_id').val(product_id).trigger('input');

        var qty = $(this).closest('tr').find('input.product_quantity').val();
        var prc = $(this).closest('tr').find('input.product_price').val();

        $(this).closest('tr').find('input.amount').val( (qty * prc) );
        calculateSubtotal();
        
    })
    $('#detail-table').on('keyup', 'input.product_quantity, input.product_price', function() {
        var qty = $(this).closest('tr').find('input.product_quantity').val();
        var prc = $(this).closest('tr').find('input.product_price').val();

        $(this).closest('tr').find('input.amount').val( (qty * prc) );
        
        calculateSubtotal();
    })
    function addRow(id) {
        var html = '<tr id="row'+id+'">' +
            '<input type="hidden" name="detail[detail_id][]" value="0">'+
            '<td><input type="text" class="form-control vehicle_no vehicle-no-row-'+id+'" name="detail[vehicle_number][]"></td>' +
            '<td><input type="hidden" class="form-control product_id product-id-row-'+id+'" name="detail[product_id][]"><input type="text" class="form-control make_model make-model-row-'+id+'" name="detail[make_model][]"></td>' +
            '<td><input type="text" class="form-control colour colour-row-'+id+'" name="detail[colour][]"></td>' +
            '<td><input type="text" class="form-control ord ord-row-'+id+'" name="detail[ord][]"></td>' +
            '<td><input type="text" class="form-control engine_cap engine-cap-row-'+id+'" name="detail[engine_cap][]"></td>' +
            '<td><input type="text" class="form-control mileage mileage-row-'+id+'" name="detail[mileage][]"></td>' +
            '<td><input type="text" class="form-control chassis_no chassis-no-row-'+id+'" name="detail[chassis_no][]"></td>' +
            '<td><input type="text" class="form-control engine_no angine-no-row-'+id+'" name="detail[engine_no][]"></td>' +
            '<td><input type="number" step=0.01 class="form-control amount amount-row-'+id+'" name="detail[amount][]"></td>' +
            '</tr>';
                                        

        $('#detail-table').find('tbody').append(html);
        // $('#detail-table tbody tr td').find('select').select2();
        // $('.product_select').on('change', function() {
        //     data = $(this).val();
        //     var fields = data.split('|');
        //     var product_id = fields[0];
        //     var product_price = fields[1];

        //     $(this).closest('tr').find('.product_price').val(product_price).trigger('input');
        //     $(this).closest('tr').find('.product_id').val(product_id).trigger('input');

        //     var qty = $(this).closest('tr').find('input.product_quantity').val();
        //     var prc = $(this).closest('tr').find('input.product_price').val();

        //     $(this).closest('tr').find('input.amount').val( (qty * prc) );
        //     calculateSubtotal();
            
        // })
        
    }

    $(document).on('click', 'td#delete-row', function() {
        $(this).parent().remove();
        calculateSubtotal();
        calculateTotal();
    })

     function calculateSubtotal() {
            subtotal = 0;
            $('.amount').each(function() {
                var amount = isNaN($(this).val()) || $(this).val() == '' ? 0 : $(this).val();
                //subtotal = subtotal + parseFloat(amount);
                subtotal = subtotal + parseInt(amount);
            })

            $('input[name="subtotal"]').val( subtotal );
           // $('#subtotal').number(subtotal, 3, ',', '.');
            $('#subtotal').html(subtotal);
            console.log(subtotal)
        calculateTotal();
    }

    function calculateTotal() {
        discount = $('#discount').val();
        // if ($('#discount_type').val() == '%') {
        //     subtotal_after_discount = Math.ceil(subtotal - (subtotal * (discount / 100)));
        // } else {
        //     subtotal_after_discount = Math.ceil(subtotal - discount);
        // }
        subtotal_after_discount = Math.ceil(subtotal);
        // $('input[name="discount"]').val( parseFloat(discount) );
        // $('input[name="discount_amount"]').val( subtotal - subtotal_after_discount );
        // $('input[name="subtotal_after_discount"]').val( subtotal_after_discount );
        // $('#subtotal_after_discount').html(subtotal - subtotal_after_discount);

        var shipping_fee = $('#input_shipping').val();
        var fee = isNaN(shipping_fee) || shipping_fee == '' ? 0 : shipping_fee;
        var subtotal_after_shipping = parseInt(subtotal_after_discount) + parseInt(fee)

        $('input[name="subtotal_after_shipping"]').val( subtotal_after_shipping );
        $('#subtotal_after_shipping').html( subtotal_after_shipping);

        $('#total').html( subtotal_after_shipping);
        $('#input_total').val( subtotal_after_shipping );
    }
    
        calculateSubtotal();
</script>
@endsection
