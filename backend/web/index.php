<?php

require __DIR__.'/../vendor/autoload.php';

$conf = require __DIR__.'/../conf/settings.php';

use TreasureHunt\TreasureHunt;
use Silex\Provider\DoctrineServiceProvider;
use Symfony\Component\HttpFoundation\Request;

Request::enableHttpMethodParameterOverride();

$app = new TreasureHunt();
$app->register(new DoctrineServiceProvider(), [
    'db.options' => $conf['database'],
]);
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
