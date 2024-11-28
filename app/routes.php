<?php
$router->get ('', 'PagesController@index');
$router->get ('about', 'PagesController@about');
$router->get ('blog', 'PagesController@blog');

$router->get ('recipes', 'RecetasController@index', 'ROLE_USER');
$router->get ('recipes/:id', 'RecetasController@show', 'ROLE_USER');
$router->post('recipes/nueva', 'RecetasController@nueva', 'ROLE_ADMIN');

$router->get ('login', 'AuthController@login');
$router->post('check-login', 'AuthController@checkLogin');
$router->get ('logout', 'AuthController@logout');

$router->get ('registro', 'AuthController@registro');
$router->post('check-registro', 'AuthController@checkRegistro');

$router->get ('profile', 'AuthController@perfil');
