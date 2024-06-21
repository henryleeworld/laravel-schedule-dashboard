<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Studio\Totem\Database\TotemMigration;

return new class extends TotemMigration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection(TOTEM_DATABASE_CONNECTION)
            ->create(TOTEM_TABLE_PREFIX.'task_frequencies', function (Blueprint $table) {
                $table->id();
                $table->foreignId('task_id');
                $table->string('label');
                $table->string('interval');
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(TOTEM_DATABASE_CONNECTION)
            ->dropIfExists(TOTEM_TABLE_PREFIX.'task_frequencies');
    }
};
