<?php

DEFINE('DEFAULT_MAX_ATTEMPTS', 5);
DEFINE('DEFAULT_RETURN', FALSE);
DEFINE('DEFAULT_RESULT', FALSE);

interface MethodInterface {
	public function __construct(array $options, $autoStart = false);
	public function __destruct();
	public function __invoke(...$value);
	
	public function navigate($url);
	public function waitBrowser();
	public function launch();
	public function debug();
	
	public function setMaxAttempts($maxAttempts);
	public function getMaxAttempts();
	
	public function setReturn($return);
	public function getReturn();
	
	public function setResult($result);
	public function getResult();
	
	public function setUrl($url);
	public function getUrl();
}

abstract class MethodAbstract implements MethodInterface {
	protected $maxAttempts;
	protected $return;
	protected $result;
	protected $url;
	
	public function __construct(array $options, $autoStart = false) {
		if (!is_array($options))
			$options = unserialize($options);
		
		if (is_array($options) && count($options) > 1)
			extract($options);
		
		if (isset($maxAttempts))
			$this->setMaxAttempts($maxAttempts);
		else $this->setMaxAttempts(DEFAULT_MAX_ATTEMPTS);
		
		if (isset($return))
			$this->setReturn($return);
		else $this->setReturn(DEFAULT_RETURN);
		
		$this->setResult(DEFAULT_RESULT);
		
		if (isset($url))
			$this->setUrl($url);
		
		if ($autoStart)
			$this->launch();
		
	}
	
	public function __destruct() {
		echo "Method " . get_class($this) . "says \"Bye-bye...:`(\"\n";
	}
	
	public function __invoke(...$value) {
		return (property_exists($this, $value) ? $this->$value : false);
	}
	
	public function debug() {
		echo "<pre>";
			var_dump($this->getReturn());
		echo "</pre>";
		
		return;
	}
	
	public function navigate($url) {
		echo "Browser navigating to url " . $url . "...\n";
		
		WEB::$browser->navigate($url);

		$this->waitBrowser();
		
		return;
	}
	
	public function waitBrowser() {
		echo "Browser waiting...brr..\n";
		
		WEB::$browser->wait_js();
		WEB::$browser->wait();
		
		return;
	}
	
	public function setMaxAttempts($maxAttempts) {
		$this->maxAttempts = $maxAttempts;
		
		return $this;
	}
	
	public function getMaxAttempts() {
		return $this->maxAttempts;
	}
	
	public function setReturn($return) {
		$this->return = $return;
		
		return $this;
	}
	
	public function getReturn() {
		return $this->return;
	}
	
	public function setResult($result) {
		$this->result = $result;
		
		return $this;
	}
	
	public function getResult() {
		return $this->result;
	}
	
	public function setUrl($url) {
		$this->url = $url;
		
		return $url;
	}
	
	public function getUrl() {
		return $this->url;
	}
	
	public function launch($debug = false) {
		for ($attempt = 1; $attempt <= $this->getMaxAttempts(); $attempt++):
			$this->_start();
			
			if ($url = $this->getUrl())
				$this->navigate($url);

			$this->_before();
			
				$this->tick();
		
			$result = $this->_run();
			
				$this->tick();
			
			$this->_after();
			
				$this->tick();
			
			$this->_finish();
			
			if ($this->check())
				break;
		endfor;
		
		if (isset($result))
			$this->setResult($result);
		
		if ($this->getReturn())
			return $this->getResult();
		
		if ($debug)
			$this->debug();
		
		return;
	}
		
	abstract protected function start();
	
	protected function _start() {
		echo "Method " . get_class($this) . ": initialised action START\n";
		
		return $this->start();
	}
	
	abstract protected function finish();
	
	protected function _finish() {
		echo "Method " . get_class($this) . ": initialised action FINISH\n";
		
		return $this->finish();
	}
	
	abstract protected function run();
	
	protected function _run() {
		echo "Method " . get_class($this) . ": initialised action RUN\n";
		
		return $this->run();
	}
	
	abstract protected function before();
	
	protected function _before() {
		echo "Method " . get_class($this) . ": initialised action BEFORE\n";
		
		return $this->before();
	}
	
	abstract protected function after();
	
	protected function _after() {
		echo "Method " . get_class($this) . ": initialised action AFTER\n";
		
		return $this->after();
	}
	
	abstract protected function isSuccess();
	
	protected function _isSuccess() {
		echo "Method " . get_class($this) . ": initialised action IS_SUCCESS\n";
		
		return $this->isSuccess();
	}
	
	abstract protected function isError();
	
	protected function _isError() {
		echo "Method " . get_class($this) . ": initialised action IS_ERROR\n";
		
		return $this->isError();
	}
	
	abstract protected function onSuccess();
	
	protected function _onSuccess() {		
		echo "Method " . get_class($this) . ": initialised action ON_SUCCESS :)\n";
		
		return $this->onSuccess();
	}
	
	abstract protected function onError();
	
	protected function _onError() {
		echo "Method " . get_class($this) . ": initialised action ON_ERROR :(\n";
		
		return $this->onError();
	}
	
	abstract protected function wait();
	
	protected function _wait() {
		echo "Method " . get_class($this) . ": initialised action WAIT\n";
		
		return $this->wait();
	}
	
	private function tick() {
		if ($this->_wait());
		
		return;
	}
	
	private function check() {		
		if ($result = $this->success());
		else $result = $this->error();
		
		return $result;
	}
	
	private function success() {
		if (FALSE === $this->isSuccess()) 
			return false;
		
		$this->onSuccess();
		
		return true;
	}
	
	private function error() {
		if (FALSE === $this->isError())
			return false;
			
		$this->onError();
		
		return false;
	}
}

class Method extends MethodAbstract {
	protected function start() {return;}
	protected function finish() {return;}
	protected function run() {return;}
	protected function before() {return;}
	protected function after() {return;}
	protected function wait() {return;}
	protected function onSuccess() {return;}
	protected function onError() {return;}
	protected function isSuccess() {return true;}
	protected function isError() {return false;}
}
