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
        Schema::create('trip_itinerary_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_package_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('day');
            $table->string('time')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('title')->nullable();
            $table->text('notes')->nullable();
            $table->nullableMorphs('itemable');
            $table->timestamps();

            $table->index(['trip_package_id', 'day', 'sort_order'], 'trip_items_sort');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_itinerary_items');
    }
};
