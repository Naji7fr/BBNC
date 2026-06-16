<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Rijles pakket shown to students on the pakketten page. */
class Package extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'name',
        'description',
        'price',
        'lessons_count',
        'features',
        'is_popular',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'lessons_count' => 'integer',
            'features' => 'array',
            'is_popular' => 'boolean',
        ];
    }
}
