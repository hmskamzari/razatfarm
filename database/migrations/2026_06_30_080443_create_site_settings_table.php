<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('phone_primary')->nullable();
            $table->string('phone_secondary')->nullable();
            $table->string('phone_tertiary')->nullable();
            $table->string('email')->nullable();
            $table->json('address')->nullable(); // Translatable
            $table->json('visit_hours')->nullable(); // Translatable - farm visiting hours
            $table->json('support_hours')->nullable(); // Translatable - customer service hours
            $table->string('map_embed_url')->nullable();
            $table->json('social_links')->nullable(); // { facebook: '', instagram: '', ... }
            $table->json('footer_copyright')->nullable(); // Translatable
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
