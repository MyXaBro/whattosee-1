<?php

namespace App;

interface ImportRepository
{
    /**
     * @param string $imdbId
     * @return array|null
     */
    public function getFilm(string $imdbId): ?array;
}