<?php

namespace Tests\Feature;

use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\LessonType;
use App\Models\Location;
use App\Models\User;
use Database\Seeders\LessonSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LessonStoreTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed([UserSeeder::class, LessonSeeder::class]);
    }

    private function actingAsStaff(): self
    {
        return $this->actingAs(User::query()->where('email', 'admin@bbnc.nl')->first());
    }

    public function test_gast_heeft_geen_toegang_tot_lesbeheer(): void
    {
        $this->get(route('lessons.index'))->assertRedirect(route('login'));
    }

    public function test_nieuwe_les_wordt_zichtbaar_in_lesoverzicht(): void
    {
        $response = $this->actingAsStaff()->post(route('lessons.store'), [
            'date' => '2026-06-15',
            'time' => '16:00',
            'lesson_type_id' => LessonType::first()->id,
            'instructor_id' => Instructor::first()->id,
            'location_id' => Location::first()->id,
            'max_participants' => 10,
        ]);

        $response->assertRedirect(route('lessons.index'));
        $response->assertSessionHas('success');

        $this->actingAsStaff()->get(route('lessons.index'))
            ->assertOk()
            ->assertSee('16:00')
            ->assertSee('15-06-2026');
    }

    public function test_dubbel_tijdstip_geeft_foutmelding(): void
    {
        $existing = Lesson::first();

        $response = $this->actingAsStaff()->from(route('lessons.create'))->post(route('lessons.store'), [
            'date' => $existing->date->format('Y-m-d'),
            'time' => substr($existing->time, 0, 5),
            'lesson_type_id' => LessonType::first()->id,
            'instructor_id' => Instructor::first()->id,
            'location_id' => Location::first()->id,
            'max_participants' => 10,
        ]);

        $response->assertRedirect(route('lessons.create'));
        $response->assertSessionHasErrors('time');
        $this->assertEquals(
            'Er staat al een les gepland op dit tijdstip',
            session('errors')->first('time')
        );
    }

    public function test_les_kan_worden_bijgewerkt(): void
    {
        $lesson = Lesson::first();

        $response = $this->actingAsStaff()->put(route('lessons.update', $lesson), [
            'date' => $lesson->date->format('Y-m-d'),
            'time' => '11:00',
            'lesson_type_id' => $lesson->lesson_type_id,
            'instructor_id' => $lesson->instructor_id,
            'location_id' => $lesson->location_id,
            'max_participants' => 25,
        ]);

        $response->assertRedirect(route('lessons.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('lessons', [
            'id' => $lesson->id,
            'max_participants' => 25,
        ]);
    }
}
