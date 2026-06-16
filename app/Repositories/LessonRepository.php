<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\LessonRepositoryInterface;
use App\Exceptions\DuplicateLessonException;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

/**
 * Data access for lessons.
 * Uses MySQL stored procedure sp_store_lesson when available; falls back on SQLite.
 */
class LessonRepository implements LessonRepositoryInterface
{
    public function store(array $data): Lesson
    {
        if ($this->supportsStoredProcedure()) {
            return $this->storeViaProcedure($data);
        }

        // SQLite (local/tests) has no stored procedures.
        return $this->storeViaFallback($data);
    }

    public function find(int $id): Lesson
    {
        return Lesson::query()
            ->with(['lessonType', 'instructor', 'location'])
            ->findOrFail($id);
    }

    public function update(Lesson $lesson, array $data): Lesson
    {
        try {
            // BR-02: only one lesson per date + time slot.
            if ($this->existsAtSlot($data['date'], $data['time'], $lesson->id)) {
                throw new DuplicateLessonException;
            }

            $lesson->update($data);

            return $lesson->fresh(['lessonType', 'instructor', 'location']);
        } catch (QueryException $exception) {
            if ($this->isDuplicateError($exception)) {
                throw new DuplicateLessonException;
            }

            throw $exception;
        }
    }

    public function delete(Lesson $lesson): void
    {
        $lesson->delete();
    }

    /**
     * @return Collection<int, Lesson>
     */
    public function allOrdered(): Collection
    {
        return Lesson::query()
            ->with(['lessonType', 'instructor', 'location'])
            ->orderBy('date')
            ->orderBy('time')
            ->get();
    }

    /**
     * Check if a time slot is taken; optionally ignore one lesson (for updates).
     */
    public function existsAtSlot(string $date, string $time, ?int $exceptLessonId = null): bool
    {
        return Lesson::query()
            ->whereDate('date', $date)
            ->where('time', $time)
            ->when($exceptLessonId, fn ($query) => $query->where('id', '!=', $exceptLessonId))
            ->exists();
    }

    /** Call sp_store_lesson: duplicate check + insert in one database operation. */
    private function storeViaProcedure(array $data): Lesson
    {
        try {
            $result = DB::select(
                'CALL sp_store_lesson(?, ?, ?, ?, ?, ?, ?)',
                [
                    $data['date'],
                    $data['time'],
                    $data['lesson_type_id'],
                    $data['instructor_id'],
                    $data['location_id'],
                    $data['max_participants'],
                    $data['notes'] ?? null,
                ],
            );

            $lessonId = (int) ($result[0]->lesson_id ?? 0);

            return Lesson::query()->findOrFail($lessonId);
        } catch (QueryException $exception) {
            if ($this->isDuplicateError($exception)) {
                throw new DuplicateLessonException;
            }

            throw $exception;
        }
    }

    private function storeViaFallback(array $data): Lesson
    {
        try {
            if ($this->existsAtSlot($data['date'], $data['time'])) {
                throw new DuplicateLessonException;
            }

            return Lesson::query()->create($data);
        } catch (QueryException $exception) {
            if ($this->isDuplicateError($exception)) {
                throw new DuplicateLessonException;
            }

            throw $exception;
        }
    }

    private function supportsStoredProcedure(): bool
    {
        return DB::connection()->getDriverName() === 'mysql';
    }

    /** Match duplicate errors from stored procedure, SQLite, or MySQL unique index. */
    private function isDuplicateError(QueryException $exception): bool
    {
        $message = $exception->getMessage();

        return str_contains($message, 'Er staat al een les gepland op dit tijdstip')
            || str_contains($message, 'UNIQUE constraint failed: lessons.date, lessons.time')
            || str_contains($message, 'Duplicate entry');
    }
}
