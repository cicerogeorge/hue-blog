<?php
// file: app/config/routes.php

$routes = array();

// default route
$routes['default'] = 'posts/index';

$routes['login'] = 'session/login';
$routes['logout'] = 'session/logout';