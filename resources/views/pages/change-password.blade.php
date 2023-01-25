@extends('layout.layout',['activePage' => 'home', 'titlePage' => 'Home'])

@section('content')

<div id="wrap" >
  <section class="bodymain" style="min-height:580px;">
    <aside class="middle-container">
      <div class="admin-inr"><br>
		<div class="" >
			@if(\Request::old('success'))
			<div class="alert alert-success" > {{\Request::old('success')}} </div>
			@elseif(\Request::old('error'))
			<div class="alert alert-danger" > {{\Request::old('error')}} </div>
			@endif
			</div>
        <form action="{{ route('admin.reset-password.store') }}" method="POST">
          	@csrf
			<div class="form-outer" style="margin-left:320px; width:500px;">
				<h1>Change Password</h1>
				<div class="contact-row">
				<div class="name">Current Password</div>
				<div class="txtfld-box">
					<input type="password" name="old_password">
				</div>
				@error('old_password')
					<span class="text-danger">{{ $message }}</span>
				@enderror
				</div>
				<div class="clear"></div>
				<div class="contact-row">
				<div class="name">New Password</div>
				<div class="txtfld-box">
					<input type="password" name="new_password">
				</div>
				@error('new_password')
					<span class="text-danger">{{ $message }}</span>
				@enderror
				</div>
				<div class="clear"></div>
				<div class="contact-row">
					<div class="name">Confirm Password</div>
					<div class="txtfld-box">
						<input type="password" name="confirm_password">
					</div>
					@error('confirm_password')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>
				<div class="clear">&nbsp;</div>
				<div class="contact-row">
					<div class="name" style="float:right; width:1px;">&nbsp;</div>
						<div style="background:none; border:none; float:left;">
							<input type="submit" class="btn" value="Change Password">
							<br>
						</div>
					</div>
				</div>
        	</form>
		    <div class="clear">&nbsp;</div>        
        <div class="clear"></div>
      </div>
    </aside>
    <div class="clear"></div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </section>
</div>
<div class="clear"></div>
@endsection