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

	// Start Timer
	//
	// @return void
	public function startTimer() {
		$stop = new \DateTime($this->stop);
		$start = new \DateTime($this->start);

		// At this point $start and $stop should be DateTime object for consistency

		// I used timestamp because it's easy to work, number of seconds since 1st Jan 1970 00:00 UTC.
		// Timestamp is always UTC, no matter where you are, it's mitigate time zone complexity.

		$diff = $stop->getTimestamp() - $start->getTimestamp();
		$this->stop = null;

		$now = new \DateTime();
		$diff = $now->getTimestamp() - $diff;

		$now->setTimestamp($diff);

		$this->start = $now;
		
		$this->save();
	}

	// Get Seconds
	//
	// @return int
	public function seconds() {
		$stop = $this->stop;

		// Can't trust '==' or '!=', can be unpreditable.
		// Extreme Case: http://blog.laravel.com/csrf-vulnerability-in-laravel-4/
		if($stop === null) {
			$stop = new \DateTime;
		} else {
			$stop = new \DateTime($stop);
		}

		$start = new \DateTime($this->start);

		// At this point $start and $stop should be DateTime object for consistency

		return $stop->getTimestamp() - $start->getTimestamp();
	}

	// Is Ticking?
	//
	// @return bool
	public function isTicking() {
		if($this->stop === null) {
			return true;
		}
		return false;
	}

	// Create Timer
	//
	// @return Timer
	static public function newTimer($name, $user) {
		$timer = new Timer();
		$timer->name = (string) $name;
		$timer->start = new \DateTime;
		$timer->user_id = $user->id;
		$timer->save();
		return $timer;
	}

}