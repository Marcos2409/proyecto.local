<?php
use proyecto\core\App;
use proyecto\core\Request;
use proyecto\core\Router;
use proyecto\app\utils\MyLog;

require __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '/../app/config.php';
App::bind('config', $config); // Guardamos la configuración en el contenedor de servicios

$router = Router::load(__DIR__ . '/../app/' . $config['routes']['filename']);
App::bind('router',$router);

$logger = MyLog::load(__DIR__ . '/../logs/' . $config['logs']['filename'], $config['logs']['level']);
App::bind('logger',$logger);