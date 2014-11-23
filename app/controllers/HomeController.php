<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome() {
		if(!Auth::check()) {
			return Redirect::to("login");
		}

		return View::make('hello');
	}

	public function showTimers() {
		if(!Auth::check()) {
			return Redirect::to("login");
		}

		return View::make('timers', array(
			"user" =>Auth::user(),
			"timers" => Auth::user()->timers()->orderBy("name")->get(),
		));
	}

	public function createTimer() {
		if(!Auth::check()) {
			return Redirect::to("login");
		}

		$rules = array(
			"name" => "required|min:8",
		);

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) {
			return Redirect::to("/")
				->withErrors($validator); // send back all errors to the login form.
		} else {
			$name = Input::get("name");

			Timer::newTimer($name, Auth::user());

			return Redirect::to("/");
		}
	}

	public function stopTimer($id) {
		if(!Auth::check()) {
			return Redirect::to("login");
		}

		Auth::user()->timers()->where("id", "=", $id)->firstOrFail()->stopTimer();

		return Redirect::to("/");
	}

	public function startTimer($id) {
		if(!Auth::check()) {
			return Redirect::to("login");
		}

		Auth::user()->timers()->where("id", "=", $id)->firstOrFail()->startTimer();

		return Redirect::to("/");
	}

}
