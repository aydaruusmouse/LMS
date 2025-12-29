<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn(['btn_link', 'course_id', 'action_type']);
            $table->string('sliderable_id')->nullable()->after('media_id');
            $table->string('sliderable_type')->nullable()->after('sliderable_id');
        });
        Schema::table('slider_languages', function (Blueprint $table) {
            $table->dropColumn('language_id');
            $table->string('title')->nullable()->after('slider_id');
            $table->string('lang')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sliders', function (Blueprint $table) {
            //
        });
    }
};
