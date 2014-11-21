<?php

class Timer extends Eloquent {

	protected $table = "timers";

	public function user() {
		return $this->belongsTo("User", "user_id");
	}

	// Stop Timer
	//
	// @return void
	public function stopTimer() {
		$this->stop = new \DateTime;
		$this->save();
	}

	// Create Timer
	//
	// @return Timer
	static public function newTimer($name, $user) {
		$timer = new Timer();
		$timer->name = (string) $name;
		$timer->start = new \DateTime;
		$user->timers()->save($timer);
		return $timer;
	}

}