<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Получение профиля пользователя
     */
    public function show()
    {
        return $this->success([]);
    }

    /**
     * Обновление профиля пользователя
     */
    public function update()
    {
        return $this->success([]);
    }
}
