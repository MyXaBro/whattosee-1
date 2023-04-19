<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Film;

class FavoriteController extends Controller
{
    /**
     * Получение списка фильмов добавленных пользователем в избранное
     */
    public function index()
    {
        return $this->success([]);
    }

    /**
     * Добавление фильма в избранное.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request, Film $film)
    {
        return $this->success([], 201);
    }

    /**
     * Удаление фильма из избранного
     */
    public function destroy(Film $film)
    {
        return $this->success([], 201);
    }
}
