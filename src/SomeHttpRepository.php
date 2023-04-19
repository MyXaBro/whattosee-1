<?php

namespace App;

use Psr\Http\Client\ClientInterface;
use GuzzleHttp\Psr7\HttpFactory;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;

class SomeHttpRepository implements ImportRepository
{
    public function __construct(private ClientInterface $httpClient)
    {
    }

    /**
     * @inheritDoc
     * @throws ClientExceptionInterface
     */
    public function getFilm(string $imdbId): ?array
    {
        $responce = $this->httpClient->sendRequest($this->createRequest($imdbId));

        return json_decode($responce->getBody()->getContents(), true);
    }

    private function createRequest(string $imdbId): RequestInterface
    {
            $api = "http://www.omdbapi.com/?apikey=92eb7026";

        return (new HttpFactory())->createRequest('get', "$api&i=$imdbId");
    }
}