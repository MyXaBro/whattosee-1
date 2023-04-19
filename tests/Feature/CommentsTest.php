<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Film;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CommentsTest extends TestCase
{
   use RefreshDatabase;

   /**
    * Получение списка комментариев
    */
    public function testGetFilmCommentsRoute()
    {
        $count = random_int(2, 10);

        $film = Film::factory()
            ->has(Comment::factory($count))
            ->create();

        dd($film->comments->first());

        $response = $this->getJson(route('comments.index', $film));

        $response->assertStatus(200);
        $response->assertJsonCount($count, 'data');
        $response->assertJsonFragment(['text' => $film->comments->first()->text]);
    }


    /**
     * Попытка добавления комментария гостем
     */
    public function testAddFilmCommentBtGuest()
    {
        $response = $this->postJson(route('comments.store', 1));

        $response->assertStatus(401);
    }

    /**
     * Проверка добавления комментария пользователем
     */
    public function testAddFilmCommentByUser()
    {
        $user = User::factory()->create();//создаём пользователя
        Sanctum::actingAs($user);//все действия будут происходить от имени этого пользователя

        $film = Film::factory()->create();//создаём фильм
        $comment = Comment::factory()->make();//комментарий

        $response = $this->postJson(route('comments.store', $film), $comment->toArray());//отправляем запрос на url (комментарий)
        $response->assertStatus(201);//убедимся, что он выдаёт правильный ответ

        $this->assertDatabaseHas('comments', [ //проверяем, что в таблице комментариев есть нужные данные
            'film_id' => $film->id,
            'user_id' => $user->id,
            'text' => $comment->text,
            'rating' => $comment->rating,
        ]);
    }

    /**
     * Попытка редактирования комментария не аутентифицированным пользователем.
     */
    public function testUpdateCommentByGuest()
    {
        $comment = Comment::factory()->create();

        $response = $this->patchJson(route('comments.update', $comment), []);

        $response->assertStatus(401);
    }

    /**
     * Попытка редактирования комментария пользователем не автором комментария.
     */
    public function testUpdateCommentByCommonUser()
    {
        Sanctum::actingAs(User::factory()->create());

        $comment = Comment::factory()->create();

        $response = $this->patchJson(route('comments.update', $comment), []);

        $response->assertStatus(403);
    }

    /**
     * Проверка попытки удаления комментария не аутентифицированным поллзователем
     */
    public function  testDeleteCommentByGuest()
    {
        $comment = Comment::factory()->create();

        $response = $this->deleteJson(route('comments.destroy', $comment->id));

        $response->assertStatus(401);
        $response->assertJsonFragment(['message' => 'Запрос требует аутентификации.']);
        $this->assertDatabaseHas('comments', [
           'id' => $comment->id,
        ]);
    }

    /**
     * Успешное удаление автором комментария без ответов
     */
    public function  testDeleteCommentByAuthor()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $comment = Comment::factory()->for($user)->create();

        $response = $this->deleteJson(route('comments.destroy', $comment));

        $response->assertStatus(201);
        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
        ]);
    }

}
