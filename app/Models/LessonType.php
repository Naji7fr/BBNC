<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/** Lesson category, e.g. Theorie or Praktijk. */
class LessonType extends Model
{
    /** @var list<string> */
    protected $fillable = ['name'];

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
