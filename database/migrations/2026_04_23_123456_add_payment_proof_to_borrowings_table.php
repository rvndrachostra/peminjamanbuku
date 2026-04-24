<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (! Schema::hasColumn('borrowings', 'payment_method')) {
            Schema::table('borrowings', function (Blueprint $table) {
                $table->string('payment_method')->nullable()->after('fine_status');
            });
        }

        if (! Schema::hasColumn('borrowings', 'payment_proof')) {
            Schema::table('borrowings', function (Blueprint $table) {
                $table->string('payment_proof')->nullable()->after('payment_method');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('borrowings', 'payment_proof')) {
            Schema::table('borrowings', function (Blueprint $table) {
                $table->dropColumn('payment_proof');
            });
        }

        if (Schema::hasColumn('borrowings', 'payment_method')) {
            Schema::table('borrowings', function (Blueprint $table) {
                $table->dropColumn('payment_method');
            });
        }
    }
};
