@extends('login.layout')
@section('title') {{ 'Login'}}
@stop 

@section('content')
<div class="container">
  
  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    
    <div class="col-md-4">
      <section class="login-form">
       <div class="login">
          <form class="form-horizontal" method="POST" action="{{route('login.submit')}}">
                        {{ csrf_field() }}
          <div>
            <img src="{{ URL::asset('image/LOGO.png') }}" width="150px" height="150px">
            <h3 style="font-family: impact;margin-top: -10%; text-align: center;">Stalls Management System</h3>
          </div>
          <input type="email" name="email" placeholder="Email" required class="form-control input-lg" />
          @if ($errors->has('email'))
          <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif
          
          <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Password"/>
          @if ($errors->has('password'))
          <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
          </span>
          @endif
          
          <!-- <div class="pwstrength_viewport_progress"></div> -->
          
          
          <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Sign in</button>
         
          
        </form>
       </div>
        
      </section>  
      </div>
      
      <div class="col-md-4"></div>
      

  </div>
</div>
@stop