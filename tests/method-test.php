<?php

$xhe_host = "127.0.0.1:7016";

require_once('C:\XWeb\Human Emulator Studio 7.0.56\Templates\xweb_human_emulator.php');
require_once('..\Method\Method.php');
require_once('..\Method\LoginMethod.php');

$options = array(
	'maxAttempts' => 1,
	'return' => true,
	'url' => 'https://pinterest.ru/login'
);

$Method = new LoginMethod($options, false);
$Method->launch();

