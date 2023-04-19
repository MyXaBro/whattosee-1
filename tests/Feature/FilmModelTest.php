<?php

namespace Tests\Feature;

use App\Models\Film;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilmModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Проверка правильности вычисления рейтинга фильма
     */
    public function testFilmRating()
    {
        // Создаем фильм
        $film = Film::factory()->create();

        // Создаем комментарии к фильу, которые влияют на его рейтинг
        $comments = [
            ['text' => 'Good film', 'rating' => 4],
            ['text' => 'Average film', 'rating' => 3],
            ['text' => 'Excellent film', 'rating' => 5],
        ];

        foreach ($comments as $comment) {
            $film->comments()->create($comment);
        }

        // Проверяем, что рейтинг вычисляется правильно
        $this->assertEquals(4, $film->rating);

        // Создаем новый комментарий с оценкой и проверяем, что рейтинг обновился
        $film->comments()->create(['text' => 'Very good film', 'rating' => 5]);

        $this->assertEquals(4.3, $film->rating);
    }
}
