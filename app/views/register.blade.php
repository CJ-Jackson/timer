@extends("layouts.master")

@section("title")User Registration @stop

@section("content")
<section>
{{ Form::open(array("url" => "register")) }}
<h1>User Registration</h1>
<p>
	{{ $errors->first("username") }}
	{{ $errors->first("email") }}
	{{ $errors->first("password") }}
	{{ $errors->first("password-confirm") }}
</p>

<div class="row">

<div class="col-md-6">
	{{ Form::label("username", "Username") }}
	{{ Form::text("username", null, array("class" => "form-control")) }}
</div>

<div class="col-md-6">
	{{ Form::label("email", "Email") }}
	{{ Form::email("email", null, array("class" => "form-control")) }}
</div>

</div>

<div class="row">

<div class="col-md-6">
	{{ Form::label("password", "Password") }}
	{{ Form::password("password", array("class" => "form-control")) }}
</div>

<div class="col-md-6">
	{{ Form::label("password-confirm", "Confirm Password") }}
	{{ Form::password("password-confirm", array("class" => "form-control")) }}
</div>

</div>

<p>{{ Form::submit("Submit!") }}</p>

{{ Form::close() }}
</section>
@stop