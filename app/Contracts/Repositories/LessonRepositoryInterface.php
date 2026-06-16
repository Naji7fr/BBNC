<?php

declare(strict_types=1);

namespace App\Contracts\Repositories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Collection;

/**
 * Repository contract for lesson persistence (supports stored procedure on MySQL).
 */
interface LessonRepositoryInterface
{
    /** Insert a new lesson. */
    public function store(array $data): Lesson;

    public function find(int $id): Lesson;

    public function update(Lesson $lesson, array $data): Lesson;

    public function delete(Lesson $lesson): void;

    /**
     * @return Collection<int, Lesson>
     */
    public function allOrdered(): Collection;

    /** Used to enforce BR-02: one lesson per date + time. */
    public function existsAtSlot(string $date, string $time, ?int $exceptLessonId = null): bool;
}
