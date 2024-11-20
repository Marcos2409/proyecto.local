<?php
use proyecto\app\exceptions\NotFoundException;
use proyecto\core\Router;
use proyecto\core\Request;
use proyecto\core\App;
try {

    require_once 'core/bootstrap.php';

    App::get('router')->direct(Request::uri(), Request::method());
    
} catch (NotFoundException $notFoundException) {
    die($notFoundException->getMessage());
}
