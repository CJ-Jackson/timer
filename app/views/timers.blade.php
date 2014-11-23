@extends("layouts.master")

@section("title")Timers @stop

@section("head")
<style type="text/css">
#user {
	display: block;
	position: relative;
	top: 1em;
	margin-bottom: 1em;
	text-align: right;
}

.second-stopped {
	color: red;
}

/*
I can archive responsive design, easy, go by the width of the device.

@media (max-width: 400px) {
	...
}
*/

</style>
@stop

@section("content")

	<div class="row">
	<div class="col-md-6">
		<header><h1>Timers</h1></header>
	</div>
	<div class="col-md-6">
		<span id="user">Logged in as {{$user->username}}, (<a href="/logout">Logout</a>)</span>
		<div class="clearfix"></div>
	</div>
	</div>
<section>
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Total Seconds</th>
				<th>Option</th>
			</tr>
		</thead>
		<tbody>
		<?php $totalSeconds = 0 ?>
		@foreach ($timers as $timer)
			@if(!$timer->isTicking()) <tr class="second-stopped"> @else <tr class="second-going"> @endif
				<?php $seconds = $timer->seconds(); $totalSeconds += $seconds; ?>
				<td>{{$timer->name}}</td>
				<td class="tick">{{$seconds}}</td>
				<td>
					@if($timer->isTicking())
					<a href="/stoptimer/{{$timer->id}}">Stop</a>
					@else
					<a href="/starttimer/{{$timer->id}}">Start</a>
					@endif
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
<strong>Overall Total: </strong> <span class="total-tick">{{$totalSeconds}}</span>
</section>

<section>
{{ Form::open(array("url" => "newtimer")) }}
	<header><h2>Add Timer</h2></header>

<p>
	{{ $errors->first("name") }}
</p>

<p>
	{{ Form::label("name", "Name") }}
	{{ Form::text("name", null, array("class" => "form-control")) }}
</p>

<p>{{ Form::submit("Submit!") }}</p>

{{ Form::close() }}
</section>

@stop