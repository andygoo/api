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

$allowd = '(test|test2)';
Route::set('list_apis', '<controller>/<action>(.<format>)', array('controller'=>$allowd))->defaults(array('controller' => 'api','action' => '404'));
Route::set('catch_all', '<path>', array('path' => '.*'))->defaults(array('controller' => 'api','action' => '404'));

echo Request::instance()->execute();
//try {echo Request::instance()->execute();} catch(Exception $e) {}

