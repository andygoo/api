<?php

$application = __DIR__;
$modules = __DIR__ . '/../kohana/modules';
$system = __DIR__ . '/../kohana/system';

define('DOCROOT', realpath(__DIR__) . DIRECTORY_SEPARATOR);
define('APPPATH', realpath($application) . DIRECTORY_SEPARATOR);
define('MODPATH', realpath($modules) . DIRECTORY_SEPARATOR);
define('SYSPATH', realpath($system) . DIRECTORY_SEPARATOR);
unset($application, $modules, $system);

require SYSPATH.'classes/Kohana.php';

date_default_timezone_set('Asia/Shanghai');
setlocale(LC_ALL,"chs");

spl_autoload_register(array('Kohana', 'auto_load'));
ini_set('unserialize_callback_func', 'spl_autoload_call');

error_reporting(E_ALL | E_STRICT);
//error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT);
//ini_set('display_errors', TRUE);

Kohana::init(array(
    'base_url' => '/',
    'index_file' => false,
));

Kohana::modules(array(
    'database' => MODPATH . 'database',
    'helper' => MODPATH . 'helper',
    'cache' => MODPATH . 'cache',
    'devtools' => MODPATH . 'devtools',
    'logreader' => MODPATH . 'logreader',
    'myadmin' => MODPATH . 'myadmin',
    'media' => MODPATH . 'media',
));
Kohana::$log->attach(new Log_File(APPPATH . 'logs'));

Route::set('list_apis', '<controller>(/<action>)(.<format>)', array('format'=>'(json|xml)'))
->defaults(array('controller' => 'api', 'action' => 'index'));

Route::set('catch_all', '<path>', array('path' => '.*'))
->defaults(array('controller' => 'error', 'action' => '404'));

try {
	echo Request::instance()->execute();
} catch(Exception $e) {
	$response = array('errno'=>$e->getCode(), 'errmsg'=>$e->getMessage());
	$uri = Request::instance()->uri();
	$pathinfo = pathinfo($uri);
	if (!empty($pathinfo['extension'])) {
		$format = $pathinfo['extension'];
	} else {
		$format = 'json';
	}
	$response['url'] = $_SERVER['REQUEST_URI'];
	//$response['data'] = file_get_contents('php://input');
	if ($format == 'xml') {
		header('Content-Type: application/xml; charset=utf-8');
		echo Arr::toxml($response, 'response');
	} else {
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}
	Kohana::$log->add(Log::ERROR, json_encode($response, JSON_UNESCAPED_UNICODE));
}

