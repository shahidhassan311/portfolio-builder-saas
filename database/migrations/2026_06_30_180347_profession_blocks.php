<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profession_blocks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('profession_id')
                ->constrained('professions')
                ->cascadeOnDelete();

            $table->foreignId('block_id')
                ->constrained('blocks')
                ->cascadeOnDelete();

            $table->boolean('is_default')->default(true);
            $table->unsignedInteger('display_order')->default(1);

            $table->timestamps();

            $table->unique(['profession_id', 'block_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profession_blocks');
    }
};
