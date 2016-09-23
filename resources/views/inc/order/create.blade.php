@extends('layouts.main')

@push('head')
<link href="{{ asset('public/lib/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" />
@endpush

@section('page-head')
<h3>
    CREATE AN ORDER
</h3>
<span class="sub-title">Welcome to SBS Nails Dashboard</span>
@endsection

@section('content')
<div class="row">
    @if (count($errors) > 0)
    <div class="col-sm-12" id="ErrorPanel">
        <div class="panel">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif
    <form action="{{ route('order.store') }}" class="" method="post" id="order_add">
        {!! csrf_field(); !!}
        <div class="col-md-12 col-lg-6" id="OrderInfo">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="">ORDER INFO</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 col-xs-6 form-group">
                            <label for="code">Code</label>
                            <input type="text" name="code" tabindex="2" class="form-control">
                        </div>
                        <div class="col-md-4 col-xs-6 form-group">
                            <label for="customer">Customer</label>
                            <input type="text" name="customer" tabindex="3" class="form-control">
                        </div>
                        <div class="col-md-4 col-xs-6 form-group">
                            <label for="phone">Tel</label>
                            <input type="text" name="phone" tabindex="4" class="form-control">
                        </div>
                        <div class="col-md-4 col-xs-6 form-group">
                            <label for="class">Class</label>
                            <input type="text" name="class" tabindex="5" class="form-control">
                        </div>
                        <div class="col-md-4 col-xs-6 form-group">
                            <label for="orderDate">Order Date</label>
                            <input type="text" name="orderDate" tabindex="6" class="form-control" data-provide="datepicker" data-date-format="yyyy/mm/dd">
                        </div>
                        <div class="col-md-4 col-xs-6 form-group">
                            <label for="payment">Payment</label>
                            <select name="payment" class="form-control" tabindex="7">
                                <option value="Cash">Cash</option>
                                <option value="Money Order">Money Order</option>
                                <option value="Check">Check</option>
                                <option value="Credit Card">Credit Card</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" tabindex="8" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" tabindex="9" class="form-control">
                        </div>

                    </div>
{{--                     <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="total">Sub-Total</label>
                            <input type="number" name="total" min="0" tabindex="9" class="form-control">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="deposit">Deposit</label>
                            <input type="number" name="deposit" min="0" tabindex="10" class="form-control">
                        </div>

                    </div> --}}
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="orderNote">Notes</label>
                            <textarea form="order_add" name="orderNote" tabindex="10" class="form-control "></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6" id="ProductInfo">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="">PRODUCT INFO</h3>
                </div>
                <div class="panel-body">
                    <div id="products" class="">
                        <table id="ProductList" class="table table-condensed table-hover table-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th class="col-md-3 col-xs-2">Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $col => $product)
                                <tr>
                                    <td>{{ $col+1 }}</td>
                                    <td><input type="hidden" name="item[]" value="{{ $product->name }}">{{ $product->name }}</td>
                                    <td><input type="hidden" name="price[]" value="{{ $product->price }}">${{ $product->price }}</td>
                                    <td>
                                        <input type="number" min="0" name="quantity[]" class="form-control input-sm" value="0"></td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="bs-example">
                                <table id="FeeList" class="table table-noborder table-responsive" cellspacing="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td class="col-md-6">
                                                Subtotal
                                            </td>
                                            <td>
                                                <input type="number" id="totalbill" readonly name="subtotal" min="0" tabindex="-1" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Shipping fee
                                            </td>
                                            <td>
                                                <input type="number" id="shipping" name="shippingfee" tabindex="11" min="0" value="0" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Total
                                            </td>
                                            <td>
                                                <input type="number" id="totalfinal" readonly name="total" min="0" tabindex="-1" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Deposit
                                            </td>
                                            <td>
                                                <input type="number" id="deposit" name="deposit" min="0" tabindex="12" class="form-control">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="submit-bar ">
                            <div class="col-md-12">
                                <button class="btn btn-info pull-right" type="submit"><i class="fa fa-cloud-download"></i> Create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endsection

    @push('scripts')
    <script src="{{ asset('public/lib/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>

    <script>
        $('form#order_add').validate({
            rules : {
                code : {
                    required : true,
                },
                customer : {
                    required : true,
                },
                phone : {
                    required : true,
                },
                address : {
                    required : true,
                },
                orderDate : {
                    required : true,
                },
                payment : {
                    required : true,
                },
                'product[]' : {
                    required:true,
                },
                'quantity[]' : {
                    required:true,
                }
            },
            submitHandler : function() {
                return true;
            }
        })
        function calc_total(subtotal,shipping){
            $('#totalfinal').val(subtotal+shipping);
        }

        function sum_row_table(){
            $('#ProductList>tbody>tr').each(function(){
                var price = parseFloat($(this).find('td:nth-child(' + 3 + ')').text().replace('$',''));
                var quantity = parseInt($(this).find('td:nth-child(' + 4 + ')>input[type="number"]').val());
                $(this).find('td:nth-child(' + 5 + ')').html('$' + Math.round(price * quantity*100)/100);
            });
        }
        $(document).ready(function(){
            var subtotal = 0;
            var shipping = parseFloat($('#shipping').val());
            sum_row_table();
            $('#ProductList>tbody>tr>td:nth-child(' + 4 + ')').change( function(){
                subtotal = 0;
                sum_row_table();
                var row = $('#ProductList>tbody>tr').length;
                for(i = 1; i <= row; i++){
                    subtotal += parseFloat($('#ProductList>tbody>tr:nth-child('+i+')>td:nth-child(5)').text().replace('$',''));
                };
                subtotal = Math.round(subtotal*100)/100;
                $('#totalbill').val(subtotal);
                calc_total(subtotal,shipping);
            });
            $('#shipping').change(function(){
                shipping = parseFloat($(this).val());
                calc_total(subtotal,shipping);
            });
        });
    </script>
    @endpush