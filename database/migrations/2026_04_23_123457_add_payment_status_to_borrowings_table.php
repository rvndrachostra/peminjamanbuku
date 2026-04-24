<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (! Schema::hasColumn('borrowings', 'payment_status')) {
            Schema::table('borrowings', function (Blueprint $table) {
                $table->string('payment_status')->default('none')->after('payment_method');
            });
        }

        if (! Schema::hasColumn('borrowings', 'payment_requested_at')) {
            Schema::table('borrowings', function (Blueprint $table) {
                $table->timestamp('payment_requested_at')->nullable()->after('payment_status');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('borrowings', 'payment_requested_at')) {
            Schema::table('borrowings', function (Blueprint $table) {
                $table->dropColumn('payment_requested_at');
            });
        }

        if (Schema::hasColumn('borrowings', 'payment_status')) {
            Schema::table('borrowings', function (Blueprint $table) {
                $table->dropColumn('payment_status');
            });
        }
    }
};
