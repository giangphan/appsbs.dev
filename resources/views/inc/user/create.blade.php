@extends('layouts.main')

@push('head')
<link href="{{ asset('public/lib/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" />
@endpush

@section('page-head')
<h3>
    USER ACCOUNT MANAGEMENT
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
        <div class="col-md-12 col-lg-12" id="ProductInfo">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="">Create New User</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                       <form id="register_user" class="form-horizontal" role="form" method="POST" action="{{ route('user.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Register
                                </button>
                            </div>
                        </div>
                    </form>
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
    $('form#register_user').validate({
        rules : {
            name : {
                required : true,
            },
            email : {
                required : true,
                email: true,
            },
            password : {
                required : true,
                minlength:6,
            },
            password_confirmation : {
                required : true,
                equalTo: "#password"
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