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
        if (Schema::hasTable('prestasis') && !Schema::hasColumn('prestasis', 'foto')) {
            Schema::table('prestasis', function (Blueprint $table) {
                $table->string('foto')->nullable()->after('keterangan');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('prestasis') && Schema::hasColumn('prestasis', 'foto')) {
            Schema::table('prestasis', function (Blueprint $table) {
                $table->dropColumn('foto');
            });
        }
    }
};

