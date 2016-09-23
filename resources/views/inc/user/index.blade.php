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
                <h3 class="">All users</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                <div class="col-md-12 form-group">
                    <table id="UserList" class="table table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Active</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $col => $user)
                            <tr>
                                <td>{{ $col+1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->active }}</td>
                                <td>{{ $user->role }}</td>
                                <td class="action-button"><a class="edit-order-row" href="user/{{ $user->id }}/edit"><i class="fa fa-edit"></i></a></td>
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