<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

/** BR-02: thrown when date + time slot is already occupied. */
class DuplicateLessonException extends Exception
{
    public function __construct()
    {
        parent::__construct('Er staat al een les gepland op dit tijdstip');
    }
}
