<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Получение списка жанров
     */
    public function index()
    {
        return $this->success([]);
    }

    /**
     * Редактирование жанра
     */
    public function update(Request $request, Genre $genre)
    {
        return $this->success([]);
    }
}
