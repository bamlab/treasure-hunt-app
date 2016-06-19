<?php

require __DIR__.'/../vendor/autoload.php';

use TreasureHunt\TreasureHunt;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new TreasureHunt();
$app['debug'] = true;
$app->get('/', function (Request $request) {
    return new Response('Welcome to Treasure Hunt app!');
});
$app->run(Request::createFromGlobals());
