<?php

require __DIR__.'/../vendor/autoload.php';

$conf = require __DIR__.'/../conf/settings.php';

use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\SerializerServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use TreasureHunt\TreasureHunt;

Request::enableHttpMethodParameterOverride();

$app = new TreasureHunt();
$app->register(new SerializerServiceProvider());
$app->register(new ValidatorServiceProvider());
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
