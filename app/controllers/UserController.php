<?php

class UserController extends BaseController {

	// User Controller

	// Login Page
	//
	// @return Response
	public function showLogin() {
		if(Auth::check()) {
			return Redirect::to("/");
		}

		// show the form
		return View::make("login");
	}

	// Process Login
	//
	// @return Response
	public function doLogin() {
		if(Auth::check()) {
			return Redirect::to("/");
		}

		// Validate the info, create rules for the inputs
		$rules = array(
			"username" => "required",
			"password" => "required|min:8",
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if($validator->fails()) {
			return Redirect::to("login")
				->withErrors($validator) // send back all errors to the login form.
				->withInput(Input::except("password")); // send back the input (not the password) so that we can repopulate the form
		} else {
			// create our user data for the authentication
			$userdata = array(
				"username" => Input::get("username"),
				"password" => Input::get("password"),
			);

			// attempt to do the login
			if(Auth::attempt($userdata)) {

				// validation successful
				return Redirect::to("/");

			} else {
				return Redirect::to("login");
			}
		}
	}

	// Process Logout
	//
	// @return Response
	public function doLogout() {
		Auth::logout(); // log the user out of our application
		return Redirect::to("login"); // redirect the user to the login screen
	}

	// Registration Page
	//
	// @return Response
	public function showRegister() {
		if(Auth::check()) {
			return Redirect::to("/");
		}
		// show the form
		return View::make("register");
	}

	// Process Registration
	//
	// @return Response
	public function doRegister() {
		if(Auth::check()) {
			return Redirect::to("/");
		}
		// Validation.

		$rules = array(
			"username" => "required|unique:users,username",
			"email" => "required|email|unique:users,email",
			"password" => "required|min:8",
			"password-confirm" => "required|same:password",
		);

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) {
			return Redirect::to("register")
				->withErrors($validator)
				->withInput(Input::except("password", "password-confirm"));
		} else {
			$user = new User;

			$user->username = Input::get("username");
			$user->password = Hash::make(Input::get("password"));
			$user->email = Input::get("email");

			$user->save();
			
			// validation successful
			return Redirect::to("login");
		}
	}
}