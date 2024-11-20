<?php

namespace proyecto\app\controllers;

use proyecto\core\App;
use proyecto\core\Response;

class PagesController
{
    /**
     * @throws QueryException
     */
    public function index()
    {
        Response::renderView(
            'index',
            'layout',
        );
    }
    public function about()
    {
        Response::renderView(
            'about',
            'layout',
        );
    }
    public function blog()
    {
        Response::renderView(
            'blog',
            'layout',
        );
    }
    public function recipes()
    {
        Response::renderView(
            'recipes',
            'layout',
        );
    }
    public function recipes_details()
    {
        Response::renderView(
            'recipes_details',
            'layout',
        );
    }
}
