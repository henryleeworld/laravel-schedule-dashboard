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
            ->create(TOTEM_TABLE_PREFIX.'tasks', function (Blueprint $table) {
                $table->id();
                $table->string('description');
                $table->string('command');
                $table->string('parameters')->nullable();
                $table->string('expression')->nullable();
                $table->string('timezone')->default('UTC');
                $table->boolean('is_active')->default(true);
                $table->boolean('dont_overlap')->default(false);
                $table->boolean('run_in_maintenance')->default(false);
                $table->string('notification_email_address')->nullable();
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(TOTEM_DATABASE_CONNECTION)
            ->dropIfExists(TOTEM_TABLE_PREFIX.'tasks');
    }
};
