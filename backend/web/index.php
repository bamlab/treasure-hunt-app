<?php

require __DIR__.'/../vendor/autoload.php';

$conf = require __DIR__.'/../conf/settings.php';

use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\SerializerServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use TreasureHunt\Api\Command\CreateGameCommand;
use TreasureHunt\Command\CreateGameCommandHandler;
use TreasureHunt\Command\SignupUserCommand;
use TreasureHunt\Command\SignupUserCommandHandler;
use TreasureHunt\TreasureHunt;

Request::enableHttpMethodParameterOverride();

$app = new TreasureHunt([
    'debug' => $conf['debug'],
]);

$app->register(new SerializerServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new DoctrineServiceProvider(), [
    'db.options' => $conf['database'],
]);

$app->extend('serializer.normalizers', function(array $normalizers) {
    return array_merge($normalizers, [new ObjectNormalizer()]);
});

$app['app.signup_user_handler'] = function (TreasureHunt $app) {
    return new SignupUserCommandHandler(
        $app['validator'],
        $app['db'],
        $app['serializer']
    );
};

$app['app.create_game_handler'] = function (TreasureHunt $app) {
    return new CreateGameCommandHandler(
        $app['validator'],
        $app['db'],
        $app['serializer']
    );
};

$app->before(function (Request $request) {
    $contentType = strtolower($request->headers->get('Content-Type'));
    if ('application/json' !== $contentType) {
        throw new BadRequestHttpException('HTTP requests must include "Content-Type: application/json" header.');
    }
});

$app->post('/users', function (Request $request) use ($app) {
    $command = $app['serializer']->deserialize(
        $request->getContent(),
        SignupUserCommand::class,
        'json'
    );

    return $app['app.signup_user_handler']->handle($command);
});

$app->get('/users/ranking', function (Request $request) use ($app) {

});

$app->post('/users/{id}/games', function (Request $request) {

});

$app->put('/users/{user}/games/{game}', function (Request $request) {

});

$app->get('/games', function (Request $request) {

});

$app->post('/games', function (Request $request) use ($app) {
    $command = $app['serializer']->deserialize(
        $request->getContent(),
        CreateGameCommand::class,
        'json'
    );

    return $app['app.create_game_handler']->handle($command);
});

$app->run(Request::createFromGlobals());
