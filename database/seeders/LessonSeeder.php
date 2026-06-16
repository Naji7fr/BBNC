<?php

namespace Database\Seeders;

use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\LessonType;
use App\Models\Location;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $theorie = LessonType::create(['name' => 'Theorie']);
        $praktijk = LessonType::create(['name' => 'Praktijk']);

        $jan = Instructor::create(['name' => 'Jan de Vries']);
        $lisa = Instructor::create(['name' => 'Lisa Jansen']);
        $piet = Instructor::create(['name' => 'Piet Bakker']);

        $lokaal1 = Location::create(['name' => 'Lokaal 1']);
        $hal2 = Location::create(['name' => 'Hal 2']);
        $lokaal3 = Location::create(['name' => 'Lokaal 3']);

        Lesson::create([
            'date' => '2026-06-11',
            'time' => '09:00:00',
            'lesson_type_id' => $theorie->id,
            'instructor_id' => $jan->id,
            'location_id' => $lokaal1->id,
            'max_participants' => 20,
        ]);

        Lesson::create([
            'date' => '2026-06-11',
            'time' => '14:00:00',
            'lesson_type_id' => $praktijk->id,
            'instructor_id' => $lisa->id,
            'location_id' => $hal2->id,
            'max_participants' => 12,
            'notes' => 'Beginners groep',
        ]);

        Lesson::create([
            'date' => '2026-06-12',
            'time' => '10:30:00',
            'lesson_type_id' => $theorie->id,
            'instructor_id' => $piet->id,
            'location_id' => $lokaal3->id,
            'max_participants' => 15,
            'notes' => 'Examen voorbereiding',
        ]);
    }
}
