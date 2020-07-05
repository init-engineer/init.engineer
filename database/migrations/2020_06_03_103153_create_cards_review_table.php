<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateCardsReviewTable.
 */
class CreateCardsReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_cards_review', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('card_id');
            $table->morphs('model');
            $table->integer('point')->default(0);
            $table->longText('roles');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('card_id')
                ->references('id')
                ->on('social_cards')
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
        Schema::dropIfExists('social_cards_review');
    }
}
