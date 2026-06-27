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
        Schema::create('culinaries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('history')->nullable();
            $table->longText('description')->nullable();
            $table->json('main_ingredients')->nullable();
            $table->string('location_zone')->nullable();
            $table->text('address')->nullable();
            $table->string('maps_url')->nullable();
            $table->json('images')->nullable();
            $table->boolean('is_popular')->default(false);
            $table->boolean('is_published')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 180)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['is_published', 'is_popular'], 'cul_pub_pop');
            $table->index(['location_zone'], 'cul_zone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('culinaries');
    }
};
