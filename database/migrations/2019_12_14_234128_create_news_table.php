<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateNewsTable.
 */
class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('model');
            $table->longText('title');
            $table->longText('image')->nullable();
            $table->longText('content');
            $table->longText('url');
            $table->longText('hashtag')->nullalbe();
            $table->string('layout')->default('frontend.news.layout.default');
            $table->integer('viewer')->default(0);
            $table->unsignedTinyInteger('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('news_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('news_id');
            $table->morphs('model');
            $table->longText('content');
            $table->unsignedTinyInteger('active')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('news_id')
                ->references('id')
                ->on('news')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_comments');
        Schema::dropIfExists('news');
    }
}
