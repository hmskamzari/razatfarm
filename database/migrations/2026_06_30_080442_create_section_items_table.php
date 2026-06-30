<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('section_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_section_id')->constrained()->cascadeOnDelete();
            $table->string('image')->nullable();
            $table->json('heading')->nullable(); // Translatable
            $table->json('body')->nullable(); // Translatable
            $table->string('value')->nullable(); // e.g. stat numbers like "1,085"
            $table->string('link_url')->nullable();
            $table->json('link_label')->nullable(); // Translatable
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('section_items');
    }
};
