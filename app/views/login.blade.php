@extends("layouts.master")

@section("title")Login @stop

@section("content")
<section>
{{ Form::open(array("url" => "login")) }}
<h1>Login</h1>

<!-- if there are login errors, show them here -->
<p>
	{{ $errors->first("username") }}
	{{ $errors->first("password") }}
</p>

<p>
	{{ Form::label("username", "Username") }}
	{{ Form::text("username", null, array("class" => "form-control")) }}
</p>

<p>
	{{ Form::label("password", "Password") }}
	{{ Form::password("password", array("class" => "form-control")) }}
</p>

<p>{{ Form::submit("Submit!") }}</p>

{{ Form::close() }}

<a href="/register">Register</a>
</section>
@stop