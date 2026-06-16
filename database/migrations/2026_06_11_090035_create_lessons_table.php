<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->foreignId('lesson_type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('instructor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('location_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('max_participants');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['date', 'time']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
