<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Create MySQL stored procedure for lesson creation with duplicate check.
     */
    public function up(): void
    {
        if (DB::connection()->getDriverName() !== 'mysql') {
            return;
        }

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_store_lesson');

        DB::unprepared(<<<'SQL'
            CREATE PROCEDURE sp_store_lesson(
                IN p_date DATE,
                IN p_time TIME,
                IN p_lesson_type_id BIGINT UNSIGNED,
                IN p_instructor_id BIGINT UNSIGNED,
                IN p_location_id BIGINT UNSIGNED,
                IN p_max_participants SMALLINT UNSIGNED,
                IN p_notes TEXT
            )
            BEGIN
                DECLARE duplicate_count INT DEFAULT 0;

                SELECT COUNT(*)
                INTO duplicate_count
                FROM lessons
                WHERE date = p_date
                  AND time = p_time;

                IF duplicate_count > 0 THEN
                    SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'Er staat al een les gepland op dit tijdstip';
                END IF;

                INSERT INTO lessons (
                    date,
                    time,
                    lesson_type_id,
                    instructor_id,
                    location_id,
                    max_participants,
                    notes,
                    created_at,
                    updated_at
                ) VALUES (
                    p_date,
                    p_time,
                    p_lesson_type_id,
                    p_instructor_id,
                    p_location_id,
                    p_max_participants,
                    p_notes,
                    NOW(),
                    NOW()
                );

                SELECT LAST_INSERT_ID() AS lesson_id;
            END
        SQL);
    }

    public function down(): void
    {
        if (DB::connection()->getDriverName() !== 'mysql') {
            return;
        }

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_store_lesson');
    }
};
