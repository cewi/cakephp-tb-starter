<?php
use Cake\Routing\Router;

Router::plugin('Cewi/CakephpTbStarter', function ($routes) {
    $routes->fallbacks();
});
