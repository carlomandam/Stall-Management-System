@extends('layout.app')
@section('title')
{{ 'New User'}}
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register new user</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/Register">
                        {{csrf_field()}}
                        <div class="form-group {{ $errors->has('fname') ? ' has-error' : '' }}">
                            <label for="fname" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="fname" type="text" class="form-control" name="fname" value="{{ old('fname') }}" required autofocus>

                                @if ($errors->has('fname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mname" class="col-md-4 control-label">Middle Name</label>

                            <div class="col-md-6">
                                <input id="mname" type="text" class="form-control" name="mname" value="{{ old('mname') }}" autofocus>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('lname') ? ' has-error' : '' }}">
                            <label for="lname" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="lname" type="text" class="form-control" name="lname" value="{{ old('lname') }}" required autofocus>

                                @if ($errors->has('lname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('lname') ? ' has-error' : '' }}">
                            <label for="lname" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="pass" type="password" class="form-control" name="pass" value="{{ old('pass') }}" required autofocus>

                                @if ($errors->has('pass'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pass') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lname" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="cpass" type="password" class="form-control" name="pass_confirmation" required autofocus>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Role</label>

                            <div class="col-md-6">
                                <select class="js-example-basic-multiple stypeSelect form-control" id="role" name="role" style="width:100%"> 
                                	<option value="Admin">Administrator</option>
                                	<option value="Staff">Staff</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
<script>
	@if(Session::get('Status') == 'Success')
		toastr.success('New user registered');
	@endif
</script>
@stop