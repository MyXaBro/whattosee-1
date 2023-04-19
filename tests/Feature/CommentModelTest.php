<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Проверка подстановки имени автора комментария.
     * В заивисимости от наличия указания на автора или нет
     */
    public function testAuthorName()
    {
        $user = User::factory()->create();//создаём случайного пользователя
        $userComment = Comment::factory()->for($user)->create();//создаём комментарии для этого пользователя
        $guestComment = Comment::factory()->create(['user_id' => null]);//создаём комментарии без пользователя (гость)

        $this->assertEquals($user->name, $userComment->author);
        $this->assertEquals(Comment::DEFAULT_AUTHOR, $guestComment->author);
    }
}
