<?php

/** Controller Class **
* @Resource Resource
* @Account Account
* @Tab Tab
*
* Main manage entity 
*
* Example: 
* class VKController
* methods = [
*	'login' => ['class' => 'LoginMethodVK'],
*   'register' => ['class' => 'RegisterMethodVK'],
*   'topic' => ['class' => 'TopicMethodVK'],
*   'confirm' => ['class' => 'ConfirmMethod'],
*	'logout' => ['class' => 'LogoutMethod'],
*	'wait' => ['class' => 'WaitMethod'],
* ]
*
* 
**/

class Controller {
	public $Resource;
	public $Account;
	public $Tab;
	
	public $options; // move to child class Array('browserSettings' => [], 'useProxy' => true, 'multithread' => true)
	public $methods; // Array('login' => ['object' => 'LoginMehod'], 'register' => ['object' => 'RegisterMethod']);
	
	public function __construct(Resource $Resource, Account $Account) {
		$this->Resource = $Resource; // Set get
		$this->Account = $Account; // SET GET
		$this->Tab = new Tab; // ??? SET GET
	}
	
	public function __destruct() {
		unset($this);
	}
	
	public function __call($target, $params = array()) {
		if (in_array($target, $this->methods)) {
			$object = $this->methods[array_search($target, $this->methods)]['class'];
			
			if (!method_exists($object, $method = 'launch')) {
				return false;
			} 
			
			$callable = $object->$method;
			
			if (is_array($params) && count($params) > 0) {
				$result = call_user_func_array($callable, $params);
			} else {
				$result = call_user_func($callable, $params);
			}
			
			return $result;
		}
	}
	
	public function __get($param) {
		if (isset($this->Account->param))
			return $this->Account->param;
	}
	
	public function __set($param, $value) {
		if (isset($this->Account->param))
			$this->Account->param = $value;
			
		return $this;
	}
	
	public function __clone() {
		$Account = new Account;
		
		$this->Account = $Account;
		
		return $this;
	}
	
	public function __invoke(...$values) {
		return $values;
	}
}
