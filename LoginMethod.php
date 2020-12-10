<?php

/* Setting default methods */

require_once('Method.php');

class LoginMethod extends Method {
	protected function start() {
		//change Account model properties is_working = 1
	}
	
	protected function finish() {
		//change Account model properties is_working = 0
	}
	
	protected function isSuccess() {		
		return true;
	}
	
	protected function isError() {
		return false;
	}
}
