<?php

namespace proyecto\core;

use proyecto\app\exceptions\NotFoundException;

class Router
{
    private $routes;
    /**
     * @param array $routes
     * @return void
     */
    public function get(string $uri, string $controller): void
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post(string $uri, string $controller): void
    {
        $this->routes['POST'][$uri] = $controller;
    }


    /**
     * @param string $uri
     * @param string $method
     * @return void
     * @throws NotFoundException
     * @throws AppException
     */
    public function direct(string $uri, string $method): void
    {
        if (!array_key_exists($uri, $this->routes[$method]))
            throw new NotFoundException("No se ha definido una ruta para la uri solicitada");

        list($controller, $action) = explode('@', $this->routes[$method][$uri]);

        $this->callAction($controller, $action);
    }
    /**
     * @param string $controller
     * @param string $action
     * @return void
     * @throws NotFoundException
     * @throws AppException
     */
    private function callAction(string $controller, string $action): void
    {
        $controller = App::get('config')['project']['namespace'] . '\\app\\controllers\\' . $controller;
        $objController = new $controller();
        if (!method_exists($objController, $action))
            throw new NotFoundException("El controlador $controller no responde al action $action");
        $objController->$action();
    }

    private function __construct()
    {
        $this->routes = [
            'GET' => [],
            'POST' => []
        ];
    }
    /**
     * @param sring $file
     * @return Router
     */
    public static function load(string $file): Router
    {
        $router = new Router();
        require $file;
        return $router;
    }

    public function redirect(string $path)
    {
        header('location: /' . $path);
    }
}