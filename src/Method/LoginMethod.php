<?php

require_once('Method.php');

class LoginMethod extends Method {
	protected function isSuccess() {
		return DOM::$anchor->get_by_href("/following", false)->is_exist();
	}
	
	protected function onSuccess() {
		echo "HELL YEAH!!!\n";
	}
	
}
