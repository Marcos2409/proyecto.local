<?php
$router->get ('', 'PagesController@index');
$router->get ('about', 'PagesController@about');
$router->get ('blog', 'PagesController@blog');
$router->get ('recipes', 'PagesController@recipes');
$router->get ('recipes_details', 'PagesController@recipes_details');

