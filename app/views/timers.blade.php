@extends("layouts.master")

@section("title")Timers @stop

@section("content")
<section>
	<h1>Timers</h2>
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Start</th>
				<th>End</th>
				<th>Option</th>
			</tr>
		</thead>
		<tbody>
		@foreach ($timers as $timer)
			<tr>
				<td>{{$timer->name}}</td>
				<td>{{$timer->start}}</td>
				<td>{{$timer->stop}}</td>
				<td><a href="stoptimer/{{$timer->id}}">Stop</a></td>
			</tr>
		@endforeach
		</tbody>
	</table>
</section>

<section>
	<h2>Add Timer</h2>
</section>

@stop