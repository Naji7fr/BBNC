<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Repositories\LessonRepositoryInterface;
use App\Exceptions\DuplicateLessonException;
use App\Exceptions\LessonStoreException;
use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\LessonType;
use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

/**
 * Business logic layer between controllers and the lesson repository.
 * Normalizes time format and wraps database errors in domain exceptions.
 */
class LessonService
{
    public function __construct(
        private readonly LessonRepositoryInterface $lessonRepository,
    ) {}

    /**
     * @return Collection<int, Lesson>
     */
    public function getAllLessons(): Collection
    {
        try {
            return $this->lessonRepository->allOrdered();
        } catch (Throwable $exception) {
            throw new LessonStoreException(
                'Lesoverzicht kon niet worden geladen.',
                previous: $exception,
            );
        }
    }

    /** Load a single lesson with relations for the edit form. */
    public function getLesson(int $id): Lesson
    {
        try {
            return $this->lessonRepository->find($id);
        } catch (Throwable $exception) {
            throw new LessonStoreException(
                'Les kon niet worden gevonden.',
                previous: $exception,
            );
        }
    }

    /**
     * Dropdown data shared by create and edit forms.
     *
     * @return array{
     *     lessonTypes: Collection<int, LessonType>,
     *     instructors: Collection<int, Instructor>,
     *     locations: Collection<int, Location>
     * }
     */
    public function getFormData(): array
    {
        return [
            'lessonTypes' => LessonType::query()->orderBy('name')->get(),
            'instructors' => Instructor::query()->orderBy('name')->get(),
            'locations' => Location::query()->orderBy('name')->get(),
        ];
    }

    /** Create lesson; duplicate date/time raises DuplicateLessonException. */
    public function storeLesson(array $data): Lesson
    {
        try {
            $data['time'] = $this->normalizeTime($data['time']);

            return $this->lessonRepository->store($data);
        } catch (DuplicateLessonException $exception) {
            throw $exception;
        } catch (Throwable $exception) {
            throw new LessonStoreException(previous: $exception);
        }
    }

    /** Update lesson; excludes current lesson from duplicate check. */
    public function updateLesson(Lesson $lesson, array $data): Lesson
    {
        try {
            $data['time'] = $this->normalizeTime($data['time']);

            return $this->lessonRepository->update($lesson, $data);
        } catch (DuplicateLessonException $exception) {
            throw $exception;
        } catch (Throwable $exception) {
            throw new LessonStoreException(previous: $exception);
        }
    }

    public function deleteLesson(Lesson $lesson): void
    {
        try {
            $this->lessonRepository->delete($lesson);
        } catch (Throwable $exception) {
            throw new LessonStoreException(
                'Les kon niet worden verwijderd.',
                previous: $exception,
            );
        }
    }

    /** HTML time input sends H:i; database TIME column expects H:i:s. */
    private function normalizeTime(string $time): string
    {
        return strlen($time) === 5 ? $time.':00' : $time;
    }
}
