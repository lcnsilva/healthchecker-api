<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('targets', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name', 120);
            $table->string('url', 2048);
            $table->boolean('is_paused')->default(false);
            $table->timestamps();

            $table->index('user_id');
            $table->unique(['user_id', 'url']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('targets');
    }
};
