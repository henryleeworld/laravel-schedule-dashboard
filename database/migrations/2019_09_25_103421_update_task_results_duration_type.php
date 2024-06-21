<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Studio\Totem\Database\TotemMigration;

return new class extends TotemMigration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->migrateDurationValues();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->migrateDurationValues(false);
    }

    /**
     * @param  bool  $toFloat
     */
    private function migrateDurationValues(bool $toFloat = true)
    {
        Schema::connection(TOTEM_DATABASE_CONNECTION)
            ->table(TOTEM_TABLE_PREFIX.'task_results', function (Blueprint $table) {
                // Move string duration column temporarily
                $table->renameColumn('duration', 'duration_old');
            });

        Schema::connection(TOTEM_DATABASE_CONNECTION)
            ->table(TOTEM_TABLE_PREFIX.'task_results', function (Blueprint $table) use ($toFloat) {
                // Create new decimal column
                if ($toFloat) {
                    $table->decimal('duration', 24, 14)->default(0.0);
                } else {
                    $table->string('duration')->default('');
                }
            });

        // Copy old duration data into new column
        DB::connection(TOTEM_DATABASE_CONNECTION)
            ->table(TOTEM_TABLE_PREFIX.'task_results')
            ->select(['id', 'duration_old'])
            ->chunkById(100, function ($rows) use ($toFloat) {
                foreach ($rows as $row) {
                    DB::connection(TOTEM_DATABASE_CONNECTION)
                        ->table(TOTEM_TABLE_PREFIX.'task_results')
                        ->where('id', $row->id)
                        ->update([
                            'duration' => $toFloat ? floatval($row->duration_old) : (string) $row->duration_old,
                        ]);
                }
            });

        Schema::connection(TOTEM_DATABASE_CONNECTION)
            ->table(TOTEM_TABLE_PREFIX.'task_results', function (Blueprint $table) {
                // Remove temp column
                $table->dropColumn('duration_old');
            });
    }
};
