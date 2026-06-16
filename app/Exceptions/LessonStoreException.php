<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Throwable;

/**
 * Wraps unexpected failures while persisting a lesson.
 */
class LessonStoreException extends Exception
{
    public function __construct(
        string $message = 'Les kon niet worden opgeslagen.',
        int $code = 0,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
