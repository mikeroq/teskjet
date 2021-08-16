<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToNavigationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('navigations', function (Blueprint $table) {
            $table->boolean('is_hidden')->default(0)->after('user_level');
        });

        Schema::table('navigation_children', function (Blueprint $table) {
            $table->boolean('is_hidden')->default(0)->after('user_level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('navigations', function (Blueprint $table) {
            $table->dropColumn('is_hidden');
        });

        Schema::table('navigation_children', function (Blueprint $table) {
            $table->dropColumn('is_hidden');
        });
    }
}
