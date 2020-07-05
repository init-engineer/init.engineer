<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSocialCardsTable.
 */
class CreateSocialCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('model');
            $table->longText('content');
            $table->unsignedTinyInteger('active')->default(1);
            $table->unsignedTinyInteger('is_banned')->default(0);
            $table->unsignedBigInteger('banned_user_id')->nullable();
            $table->string('banned_remarks')->nullable();
            $table->timestamp('banned_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('social_media_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('card_id');
            $table->morphs('model');
            $table->string('social_type');
            $table->string('social_connections');
            $table->string('social_card_id');
            $table->integer('num_like')->default(0);
            $table->integer('num_share')->default(0);
            $table->unsignedTinyInteger('active')->default(1);
            $table->unsignedTinyInteger('is_banned')->default(0);
            $table->unsignedBigInteger('banned_user_id')->nullable();
            $table->string('banned_remarks')->nullable();
            $table->timestamp('banned_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('card_id')
                ->references('id')
                ->on('social_cards')
                ->onDelete('cascade');
        });

        Schema::create('social_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('card_id');
            $table->unsignedBigInteger('media_id')->nullable();
            $table->string('media_comment_id')->nullable();
            $table->string('user_name');
            $table->string('user_id');
            $table->longText('user_avatar');
            $table->longText('content');
            $table->unsignedTinyInteger('active')->default(1);
            $table->string('reply_media_comment_id')->nullable();
            $table->unsignedTinyInteger('is_banned')->default(0);
            $table->unsignedBigInteger('banned_user_id')->nullable();
            $table->string('banned_remarks')->nullable();
            $table->timestamp('banned_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('card_id')
                ->references('id')
                ->on('social_cards')
                ->onDelete('cascade');
        });

        Schema::create('card_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('card_id');
            $table->morphs('model');
            $table->string('storage');
            $table->string('avatar_path')->nullable();
            $table->string('avatar_name')->nullable();
            $table->string('avatar_type')->nullable();
            $table->unsignedTinyInteger('active')->default(1);
            $table->unsignedTinyInteger('is_banned')->default(0);
            $table->unsignedBigInteger('banned_user_id')->nullable();
            $table->string('banned_remarks')->nullable();
            $table->timestamp('banned_at')->nullable();
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
        Schema::dropIfExists('card_images');
        Schema::dropIfExists('social_comments');
        Schema::dropIfExists('social_media_cards');
        Schema::dropIfExists('social_cards');
    }
}
