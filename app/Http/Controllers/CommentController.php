<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Film;

class CommentController extends Controller
{
    /**
     * Получение списка комментариев к фильму
     */
    public function index(Film $film)
    {
        return $this->success([]);
    }

    /**
     * Добавление отзыва к фильму
     */
    public function store(Request $request, Film $film)
    {
        $user = $request->user(); // получаем текущего авторизованного пользователя
        $comment = new Comment([
            'text' => $request->input('text'),
            'rating' => $request->input('rating'),
        ]);
        $comment->user()->associate($user);
        $film->comments()->save($comment);
        return response()->json($comment, 201);
    }

    /**
     * Редактирование комментария
     */
    public function update(Request $request, Comment $comment)
    {
        return $this->success([]);
    }

    /**
     * Удаление комментария
     */
    public function destroy(Comment $comment)
    {
        return $this->success([], 201);
    }
}
