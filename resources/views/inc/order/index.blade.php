@extends('layouts.main')
@push('head')
<link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datatables/datatables.min.css') }}"/>
@endpush
@section('page-head')
<h3>
    ORDER LIST
</h3>
<span class="sub-title">Welcome to Shopping Dashboard</span>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-body">
                <table id="OrderList" class="table table-hover dataTable" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Code</th>
                            <th>Customer</th>
                            <th>Class</th>
                            <th>Status</th>
                            <th>Note</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Code</th>
                            <th>Customer</th>
                            <th>Class</th>
                            <th>Status</th>
                            <th>Note</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
{{ csrf_field() }}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Change Status of Order</h4>
    </div>
    <form action="" method="post" id="order_add">
      <div class="modal-body">
          {{ csrf_field() }}
          <select class="form-control" name="statusnew">
            @foreach($listStatus as $status)
            <option value="{{ $status->id }}">{{ $status->name }}</option>
            @endforeach
        </select>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
</div>
</div>
</div>
@endsection

@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.12/af-2.1.2/b-1.2.2/b-print-1.2.2/r-2.1.0/sc-1.4.2/se-1.2.0/datatables.min.js"></script>
<script>
    function addFuncButton(val) {
        return '<a class="edit-status-button" data-id="'+val+'" href="#"><i class="fa fa-cogs"></i></a> <a class="edit-order-row" href="order/'+val+'/edit" data-id="'+val+'"><i class="fa fa-edit"></i></a>';
    }
    function addStatusClass(val) {
        return '<span class="status '+val+'">'+val+'</span>';
    }
    function convertDateFormat(val) {
        var dt = val.split('-');
        return dt[1]+'/'+dt[2]+'/'+dt[0];
    }
    function format ( d ) {
        var conlai = d.tongTien - d.traTruoc;
    // `d` is the original data object for the row
    var text = '<div class="row details-row"><div class="col-xs-6"><p><b>Phone</b>: '+d.phone+
    '</p><p><b>Email</b>: '+d.email+'</div><div class="col-xs-6"><p><b>Total</b>: $'+d.total+
    '</p><p><b>Deposit</b>: $'+d.deposit+
    '</p></div><div class="col-md-6"><p><b>Address</b>: '+d.address+
    '</p><p><b>Payment Method</b>: '+d.payment+'</div><div class="col-md-6"><p><b>Order Date</b>: ' + d.orderDate +
    '</p></div><div class="col-md-6"><p><b>Updated at</b>: ' + d.updated_at +
    '</p></div></div>';
    text += '<div class="col-xs-12 col-md-8 col-md-offset-1 table-responsive"><table cellspacing="0" class="table table-bordered">'+
    '<thead><tr><th>Product</th><th>Price</th><th>Quantity</th></tr></thead>';
    for (i = 0; i < d.detail.length; i++) {
        text += '<tr><td>'+d.detail[i].name+'</td>'+
        '<td>'+d.detail[i].price+'</td>'+
        '<td>'+d.detail[i].quantity+'</td></tr>';
    }
    text +='</table></div>';
    return text;
}
$(function() {
    var table = $('#OrderList').DataTable({
        serverSide: true,
        ajax: {
            'url': '{{ route('datatables.dataOrders') }}',
            'headers': {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
        ordering: false,
        columns: [
        {
            "className":      'details-control',
            "orderable":      false,
            "data":           null,
            "defaultContent": ''
        },
        { data: 'code'},
        { data: 'customer'},
        { data: 'class'},
        { data: 'status.name'},
        { data: 'note'},
        { data :'id', className:'action-button' }
        ],
        "columnDefs": [
        {
            "render": function (data, type, row) {
                return addStatusClass(data);
            },
            "targets": [4]
        },
        {
            "render": function (data, type, row) {
                return addFuncButton(data);
            },
            "targets": [6]
        },
        ]
    });
});
$(document).ready(function () {
    $('#OrderList tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = $('#OrderList').DataTable().row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
    $('#OrderList tbody').on('click', 'a.edit-status-button', function (event) {
        event.preventDefault();
        var proID = $(this).attr("data-id");
        var token = $("input[name=_token]").val();
        $.ajax({
            url: 'order/' + proID,
            type:'post',
            cache:false,
            data:{"_token":token, "info":proID},
            success: function(data) {
              var form = $('#myModal').find('form');
              form.attr('action','/order/status/'+data[1][0].id);
              $('#myModal').modal('toggle');
          }
      });
        return false;
    });
});
</script>
@endpush