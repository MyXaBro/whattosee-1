<?php

use App\Services\FilmService;
use App\SomeHttpRepository;
use GuzzleHttp\Client;

require_once __DIR__ . '/vendor/autoload.php';

$client = new Client();
$repository = new SomeHttpRepository($client);
$service = new FilmService($repository);

$filmData = $service->requestFilm('tt0468569');

echo json_encode($filmData);
