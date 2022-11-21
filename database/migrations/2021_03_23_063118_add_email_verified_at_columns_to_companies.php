<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailVerifiedAtColumnsToCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('companies', 'email_verified_at')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->date('email_verified_at')->nullable();

            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('companies', 'email_verified_at')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->dropColumn('email_verified_at');
            });
        }
    }
}
