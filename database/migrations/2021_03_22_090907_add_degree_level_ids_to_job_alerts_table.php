<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDegreeLevelIdsToJobAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_alerts', function (Blueprint $table) {
            
            $table->string('degree_level_ids')->nullable();
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
            $table->dropColumn('degree_level_ids');
        });
    }
}
