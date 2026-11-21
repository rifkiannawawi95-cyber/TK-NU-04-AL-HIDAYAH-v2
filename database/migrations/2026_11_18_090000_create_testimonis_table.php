<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonis', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('peran', 100)->default('Wali Santri');
            $table->unsignedTinyInteger('rating')->default(5);
            $table->text('pesan');
            $table->boolean('is_approved')->default(false);
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            $table->index(['is_approved', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonis');
    }
};
