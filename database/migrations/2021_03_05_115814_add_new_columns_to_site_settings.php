<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToSiteSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('alternate_site_logo')->nullable();
            $table->text('footer_short_desc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn('alternate_site_logo');
            $table->dropColumn('footer_short_desc');
        });
    }
}
