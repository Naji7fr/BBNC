<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Scheduled driving lesson (date + time must be unique).
 */
class Lesson extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'date',
        'time',
        'lesson_type_id',
        'instructor_id',
        'location_id',
        'max_participants',
        'notes',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    public function lessonType(): BelongsTo
    {
        return $this->belongsTo(LessonType::class);
    }

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
