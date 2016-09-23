@extends('layouts.main')

@push('head')
<link href="{{ asset('public/lib/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" />
@endpush

@section('page-head')
<h3>
    CREATE A PRODUCT
</h3>
<span class="sub-title">Welcome to SBS Nails Dashboard</span>
@endsection

@section('content')
<div class="row">
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
        <div class="col-md-12 col-lg-12">
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        </div>
        @endif
        @endforeach
    </div> <!-- end .flash-message -->
    {!! csrf_field(); !!}
    <div class="col-md-12 col-lg-12" id="OrderInfo">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="">All Products</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                <div class="col-md-12 form-group">
                    <table id="ProductList" class="table table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $col => $item)
                            <tr>
                                <td>{{ $col+1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="action-button"><a class="edit-order-row" href="product/{{ $item->id }}/edit"><i class="fa fa-edit"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
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
        },
        submitHandler : function() {
            return true;
        }
    })
    $(document).ready(function(){

    });
</script>
@endpush