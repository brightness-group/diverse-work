<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToJobAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_alerts', function (Blueprint $table) {
            $table->string('salary_offered_ids')->nullable();
            $table->string('job_type_ids')->nullable();
            $table->string('career_level_ids')->nullable();
            $table->string('job_experience_ids')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_alerts', function (Blueprint $table) {
            $table->dropColumn('salary_offered_ids');
            $table->dropColumn('job_type_ids');
            $table->dropColumn('career_level_ids');
            $table->dropColumn('job_experience_ids');
        });
    }
}
