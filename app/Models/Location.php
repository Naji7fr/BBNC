<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/** Physical location where a lesson takes place. */
class Location extends Model
{
    /** @var list<string> */
    protected $fillable = ['name'];

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
