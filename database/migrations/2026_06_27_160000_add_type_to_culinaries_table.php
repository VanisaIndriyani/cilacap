<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('culinaries', function (Blueprint $table) {
            $table->string('type', 20)->default('khas')->after('slug');
            $table->index(['type'], 'cul_type');
        });
    }

    public function down(): void
    {
        Schema::table('culinaries', function (Blueprint $table) {
            $table->dropIndex('cul_type');
            $table->dropColumn('type');
        });
    }
};
