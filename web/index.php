<?php

include __DIR__ . '/classes/Router.php';
include __DIR__ . '/classes/Response.php';
include __DIR__ . '/classes/Request.php';
include __DIR__ . '/classes/Hal.php';

$router = new Router('web');
$req = new Request();
$res = new Response();

$router->get('/', function() use ($req, $res) {
    // Aber was?
    $movies = file_get_contents(__DIR__ . '/../data/movies.json');
    $movies = json_decode($movies);

    $hal = new Hal();

    $self = new stdClass();
    $self->href = $req->getAddress();

    $hal->setLinks('self', $self);
    $hal->setData('movies', $movies);

    return $res->json($hal);
});

$router->error('404', function() use ($req, $res) {
    echo "Fehler";
});

$router->start($req);
