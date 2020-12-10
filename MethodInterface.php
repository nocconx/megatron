<?php

interface MethodInterface {
	protected $maxAttempts;
	protected $return;
	protected $result;
	protected $url;
	
	public function __construct(array $options, $autoStart = false);
	public function __destruct();
	public function __invoke(...$value);
	
	public function navigate();
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
	
	abstract protected function start();
	protected function _start();
	
	abstract protected function finish();
	protected function _finish();
	
	abstract protected function run();
	protected function _run();
	
	abstract protected function before();
	protected function _before();
	
	abstract protected function after();
	protected function _after();
	
	abstract protected function wait();
	protected function _wait();
	
	abstract protected function onSuccess();
	protected function _onSuccess();
	
	abstract protected function onError();
	protected function _onError();
	
	abstract protected function isSuccess();
	protected function _isSuccess();
	
	abstract protected function isError();
	protected function _isError();
	
	private function check();
	private function success();
	private function error();
	private function tick();
	
}
