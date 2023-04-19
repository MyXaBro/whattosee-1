<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Получение списка фильмов
     */
    public function index()
    {
        return $this->success([]);
    }

    /**
     * Добавление фильма в базу
     */
    public function store(Request $request)
    {
        return $this->success([], 201);
    }

    /**
     * Получение информации о фильме
     */
    public function show(Film $film)
    {
        return $this->success([]);
    }

    /**
     * Редактирование фильма
     */
    public function update(Request $request, Film $film)
    {
        return $this->success([]);
    }

    /**
     * Получение списка похожих фильмов
     */
    public function similar(Film $film)
    {
        return $this->success([]);
    }
}
