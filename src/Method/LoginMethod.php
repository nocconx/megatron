<?php

require_once('Method.php');

class LoginMethod extends Method {
	protected function isSuccess() {
		return true; // just for FUN
	}
	
	protected function onSuccess() {
		echo "HELL YEAH!!!\n";
	}
	
}
