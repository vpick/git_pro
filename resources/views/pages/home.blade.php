@extends('layout.layout1')

@section('content')

<div class="clear"></div>
<div class="bodycont">
  <div id="wrap2" style="min-height:530px;">
    <form action="{{ route('login.store') }}" method="POST">
      @csrf
      <div class="login-cont">
        <h1 class="loginhd">Login Here</h1>
        <div class="login-row">
          <div class="loginname">Email</div>
          <div class="admintxtfld-box">
            <input type="email" name="email">
          </div>        
          <div class="clear"></div>
        </div>
  <!--       <div class="loginreq-field">* This Field Required </div> -->
        
        <div class="login-row">
          <div class="loginname">Password</div>
          <div class="admintxtfld-box">
            <input type="password" name="password">
          </div>
          <div class="clear"></div>
        </div>
        
        <div class="clear"></div>
        <div class="contact-row" style="width:325px;">
          <div style="background:none; border:none; margin-top:15px;">
          
            <input type="submit" class="btn" value="Login">
           <br>
          </div>
        </div>
        <div class="clear"></div>
      </div>
    </form>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
</div>
<div class="clear"></div>
@endsection