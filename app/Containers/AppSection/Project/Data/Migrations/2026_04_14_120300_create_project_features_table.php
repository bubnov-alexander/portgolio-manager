<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_features', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();

            $table->index(['project_id', 'sort']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_features');
    }
};
