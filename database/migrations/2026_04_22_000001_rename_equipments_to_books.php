<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::rename('equipments', 'books');

        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('condition');
            $table->string('author')->after('name');
            $table->year('year_published')->after('author');
            $table->renameColumn('code', 'isbn');
        });
    }

    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->renameColumn('isbn', 'code');
            $table->dropColumn('year_published');
            $table->dropColumn('author');
            $table->string('condition')->nullable();
        });

        Schema::rename('books', 'equipments');
    }
};