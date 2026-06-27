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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('location_zone')->nullable();
            $table->text('address')->nullable();
            $table->string('maps_url')->nullable();
            $table->string('opening_hours')->nullable();
            $table->unsignedInteger('ticket_price')->nullable();
            $table->json('facilities')->nullable();
            $table->json('images')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 180)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['destination_category_id', 'is_published', 'is_featured'], 'dest_cat_pub_feat');
            $table->index(['location_zone'], 'dest_zone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
