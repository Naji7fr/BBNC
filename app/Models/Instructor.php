<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/** Driving instructor assigned to lessons. */
class Instructor extends Model
{
    /** @var list<string> */
    protected $fillable = ['name'];

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
