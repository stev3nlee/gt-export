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
                    @if(isset($data)) Update Invoice @else Create Invoice @endif <div style="float: right;"><input type="text" name="invoice_number" @if(isset($data)) disabled @endif value="{{ isset($data) ? $data->invoice_number : $invoice_number }}">
                    @if($errors->has('invoice_number')) <span class="help-block">{{ $errors->first('invoice_number') }}</span>  @endif</div>
                </div>

                <div class="box-body">
                      {!! csrf_field() !!}
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Quotation</label>
                            <select name="quotation_id" class="form-control select2 select-quotation" @if(isset($data)) disabled="disabled" @endif>
                              <option value="0">Select Quotation</option>
                              @foreach($quotations as $quotation)
                              <option value="{{ $quotation->id }}" @if(isset($data)) @if($data->quotation_id == $quotation->id) selected @endif @endif>#{{ $quotation->quotation_number }}</option>
                              @endforeach
                            </select>
                            @if($errors->has('quotation_id')) <span class="help-block">{{ $errors->first('quotation_id') }}</span>  @endif
                          </div>

                          <div class="form-group">
                            <label for="fname">First Name <span class="required">*</span></label>
                            <input type="text" name="first_name" id="first-name" class="form-control" value="{{ isset($data) ? $data->first_name : old('first_name') }}"/>
                            @if($errors->has('first_name')) <span class="help-block">{{ $errors->first('first_name') }}</span>  @endif
                          </div>

                          <div class="form-group">
                            <label for="fname">Last Name <span class="required">*</span></label>
                            <input type="text" name="last_name" id="last-name" class="form-control" value="{{ isset($data) ? $data->last_name : old('last_name') }}"/>
                            @if($errors->has('last_name')) <span class="help-block">{{ $errors->first('last_name') }}</span>  @endif
                          </div>

                          <div class="form-group">
                            <label for="fname">Date of Birth</label>
                            <input type="text" name="dob" readonly autocomplete="off" id="dob" class="form-control datepicker_invoice" value="{{ isset($data->dob) ? date('d/m/Y', strtotime($data->dob)) : old('dob') }}"/>
                            @if($errors->has('dob')) <span class="help-block">{{ $errors->first('dob') }}</span>  @endif
                          </div>
                        </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname">Consignee Adress <span class="required">*</span></label>
                                        <textarea name="consignee_address" style="height: 108px;" class="form-control" >{{ isset($data) ? $data->consignee_address : old('consignee_address') }}</textarea>
                                        @if($errors->has('consignee_address')) <span class="help-block">{{ $errors->first('consignee_address') }}</span>  @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="lname">Contact No <span class="required">*</span></label>
                                        <input name="contact_no" id="contact-no" type="text" class="form-control" value="{{ isset($data) ? $data->contact_no : old('contact_no') }}"/>
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
                                    <input name="date" type="text" readonly autocomplete="off" class="form-control datepicker_invoice" value="{{ isset($data) ? date('d/m/Y', strtotime($data->date)) : old('date') }}"/>
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
                                    <td id="delete-row" width="30px" class="text-center"><a href="javacsript:void(0)"><i class="fa fa-trash fa-fw" style="color: red"></i></a></td>
                                </tr>
                                @endforeach
                                @else
                                <tbody id="element-order">
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="10" class="text-center bg-slate" id="add-row"><span><i class="fa fa-plus fa-fw" style="cursor: pointer;"></i> Add Product</span></td>
                                </tr>
                                </tfoot>
                                @endif
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
                                    <label class="col-sm-7 control-label text-right">Shipping
                                        <input type="number"  style="width: 40%; float: right;" step="0.01" name="shipping" id="input_shipping" class="form-control" value="{{ isset($data) ? $data->shipping_fee : old('shipping_fee') }}">
                                    </label>
                                    <div class="col-sm-5">
                                        <label class="col-sm-10 control-label text-right">
                                            <label id="shipping_price"></label>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-7 control-label text-right">Payment Received
                                        <input type="number" style="width: 40%; float: right;" step="0.01" name="payment_received" id="payment_received" class="form-control" value="{{ isset($data) ? $data->payment_received : old('payment_received') }}">
                                    </label>
                                    <div class="col-sm-5">
                                        <label class="col-sm-10 control-label text-right">
                                            <label id="price_received"></label>
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
<!-- <script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script> -->
<script>
    var u=1;
    $('.select-quotation').change(function() {
        var token = '{{ csrf_token() }}';
        //var order_id = @if(isset($data)){{ $data->id }}@else 0 @endif;
        var url = "{{ url(config('backpack.base.route_prefix').'/quotation/data') }}";
        // if(order_id){
        //     var url = "{{ url(config('backpack.base.route_prefix').'/invoice/data') }}";
        // }
        u++;
        if (this.value > 0) {
            $.ajax({
                url: url,
                type: 'POST',
                data: { quotation_id: this.value, _token: token }
            }).done(function(data) {
              var i = 0;
              $('#first-name').val(data.first_name);
              $('#last-name').val(data.last_name);
              $('#dob').val(data.dob);
              $('#contact-no').val(data.phone);
              $('#input_shipping').val(data.shipping_fee);
              $('#detail-table').find('tbody').html('');
                //for (var key in data.product) {
                    addRow(u)
                    console.log(data.product.color);
                    //calculateSubtotal(data.price);
                    //calculateTotal();
                    //$('#shipping_fee').val(parseInt(data.delivery_fee));
                    //$('.item-row-'+u+'').eq(i).val(data.detail[key].id);
                    //$('.packing-detail-id-'+u+'').eq(i).val(data.detail[key].id);
                    $('.make-model-row-'+u+'').eq(i).val(data.product.model[0].name);
                    $('.product-id-row-'+u+'').eq(i).val(data.product.id);
                    $('.colour-row-'+u+'').eq(i).val(data.product.color);
                    $('.engine-cap-row-'+u+'').eq(i).val(data.product.engine_capacity);
                    $('.mileage-row-'+u+'').eq(i).val(data.product.mileage);
                    $('.chassis-no-row-'+u+'').eq(i).val(data.product.chassis_no);
                    $('.engine-no-row-'+u+'').eq(i).val(data.product.engine_no);
                    $('.amount-row-'+u+'').eq(i).val(data.price);
                    calculateSubtotal();
                       
                    i++;
                //}

              
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
    });

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
    $('#detail-table').on('keyup', 'input.amount', function() {
        // var qty = $(this).closest('tr').find('input.product_quantity').val();
        // var prc = $(this).closest('tr').find('input.product_price').val();

        // $(this).closest('tr').find('input.amount').val( (qty * prc) );
        
        calculateSubtotal();
    })

    $('#input_shipping, #payment_received').on('keyup', function() {
        
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
            '<td><input type="text" class="form-control engine_no engine-no-row-'+id+'" name="detail[engine_no][]"></td>' +
            '<td><input type="number" step=0.01 class="form-control amount amount-row-'+id+'" name="detail[amount][]"></td>' +
            '<td id="delete-row" width="30px" class="text-center"><a href="javacsript:void(0)"><i class="fa fa-trash fa-fw" style="color: red"></i></a></td>' +
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

    $('#add-row').on('click', function() {
       var html = '<tr>' +
            '<input type="hidden" name="detail[detail_id][]" value="0">'+
            '<td><input type="text" class="form-control vehicle_no vehicle-no-row" name="detail[vehicle_number][]"></td>' +
            '<td><input type="hidden" class="form-control product_id product-id-row" name="detail[product_id][]"><input type="text" class="form-control make_model make-model-row" name="detail[make_model][]"></td>' +
            '<td><input type="text" class="form-control colour colour-row" name="detail[colour][]"></td>' +
            '<td><input type="text" class="form-control ord ord-row" name="detail[ord][]"></td>' +
            '<td><input type="text" class="form-control engine_cap engine-cap-row" name="detail[engine_cap][]"></td>' +
            '<td><input type="text" class="form-control mileage mileage-row" name="detail[mileage][]"></td>' +
            '<td><input type="text" class="form-control chassis_no chassis-no-row" name="detail[chassis_no][]"></td>' +
            '<td><input type="text" class="form-control engine_no engine-no-row" name="detail[engine_no][]"></td>' +
            '<td><input type="number" step=0.01 class="form-control amount amount-row" name="detail[amount][]"></td>' +
            '<td id="delete-row" width="30px" class="text-center"><a href="javacsript:void(0)"><i class="fa fa-trash fa-fw" style="color: red"></i></a></td>' +
            '</tr>';
                                        

        $('#detail-table').find('tbody').append(html);
    })

     function calculateSubtotal() {
            subtotal = 0;
            $('.amount').each(function() {
                var amount = isNaN($(this).val()) || $(this).val() == '' ? 0 : $(this).val();
                //subtotal = subtotal + parseFloat(amount);
                subtotal = subtotal + parseInt(amount);
            })

            $('input[name="subtotal"]').val( subtotal );
           //$('#subtotal').number(subtotal, 3, ',', '.');
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
        var payment_received = $('#payment_received').val();
        $('#shipping_price').html( shipping_fee);
        $('#price_received').html( payment_received);
        var fee = isNaN(shipping_fee) || shipping_fee == '' ? 0 : shipping_fee;
        var received = isNaN(payment_received) || payment_received == '' ? 0 : payment_received;
        var subtotal_after_shipping = parseFloat(subtotal_after_discount) + parseFloat(fee);
        var subtotal_after_payment = parseFloat(subtotal_after_discount) + parseFloat(fee) - parseFloat(received);

        $('input[name="subtotal_after_shipping"]').val( subtotal_after_payment );
        $('#subtotal_after_shipping').html( subtotal_after_payment);

        $('#total').html( subtotal_after_payment);
        $('#input_total').val( subtotal_after_shipping );
    }
    
        calculateSubtotal();
</script>
@endsection
