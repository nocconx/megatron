<?php

require_once('LoginMethod.php');

class LoginMethodVK extends LoginMethod {
	protected $options = array(
		'maxAttempts' => 1,
		'return' => 0,
		'url' => 'https://m.vk.com'
	);

	protected function run() {
		DOM::$input->get_by_number(0)->send_input(parent::$Account->login);
		
		$this->waitBrowser();
		
		DOM::$input->get_by_number(1)->send_input(parent::$Account->password);
		
		$this->waitBrowser();
		
		DOM::$button->get_by_number(0)->click();
		
		$this->waitBrowser();
	}
	
	protected function before() {return;}
	
	protected function after() {return;}
	
	protected function isSuccess() {return;}
	
	protected function onSuccess() {return;}
	
	protected function isError() {return;}
	
	protected function onError() {return;}
	
	protected function wait() {
		$this->waitBrowser();
	}
}


$method = new LoginMethodVK($autoStart = false);
