<?php

require __DIR__.'/../vendor/autoload.php';

use TreasureHunt\TreasureHunt;
use Symfony\Component\HttpFoundation\Request;

Request::enableHttpMethodParameterOverride();

$app = new TreasureHunt();
$app['debug'] = true;

$app->post('/users', function (Request $request) use ($app) {
    
});

$app->get('/users/ranking', function (Request $request) use ($app) {

});

$app->post('/users/{id}/games', function (Request $request) {

});

$app->put('/users/{user}/games/{game}', function (Request $request) {

});

$app->get('/games', function (Request $request) {

});

$app->post('/games', function (Request $request) {

});

$app->run(Request::createFromGlobals());
