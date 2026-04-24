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
        if (! Schema::hasColumn('books', 'image')) {
            Schema::table('books', function (Blueprint $table) {
                $table->string('image')->nullable()->after('description');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('books', 'image')) {
            Schema::table('books', function (Blueprint $table) {
                $table->dropColumn('image');
            });
        }
    }
};
