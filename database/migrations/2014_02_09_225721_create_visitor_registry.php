<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateVisitorRegistry.
 */
class CreateVisitorRegistry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_registry', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip', 32);
            $table->string('country', 4)->nullable();
            $table->string('city', 64)->nullable();
            $table->integer('user_id')->nullable();
            $table->string('hittable_type');
            $table->string('hittable_function');
            $table->integer('hittable_content')->nullable();
            $table->integer('clicks')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('visitor_registry');
    }
}
