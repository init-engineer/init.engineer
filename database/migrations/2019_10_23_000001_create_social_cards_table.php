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
    public function up(): void
    {
        /** 社群平台 Token */
        Schema::create('social_token', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('社群平台名稱');
            $table->string('type')->default('local')->comment('社群平台分類');
            $table->unsignedTinyInteger('active')->default(0)->comment('啟用');
            $table->longText('config')->comment('設定');
            $table->timestamps();
            $table->softDeletes();
        });

        /** 廣告 */
        Schema::create('social_cards_ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->comment('廣告名稱');
            $table->string('ads_path')->nullable()->comment('圖檔路徑');
            $table->integer('number_max')->default(-1)->comment('最多部署上限');
            $table->integer('number_min')->default(-1)->comment('最少部署下限');
            $table->integer('incidence')->default(0)->comment('部署機率');
            $table->unsignedTinyInteger('active')->default(1)->comment('啟用');
            $table->timestamp('started_at')->nullable()->comment('開始日期');
            $table->timestamp('end_at')->nullable()->comment('結束日期');
            $table->timestamps();
            $table->softDeletes();
        });

        /** 主要文章 */
        Schema::create('social_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('model');
            $table->longText('content')->comment('內文');
            $table->longText('config')->comment('設定');
            $table->unsignedTinyInteger('active')->default(1)->comment('啟用');
            $table->boolean('confirmed')->default(false)->comment('驗證狀態');
            $table->boolean('banned')->default(false)->comment('封鎖狀態');
            $table->unsignedBigInteger('banned_by')->nullable()->comment('被誰封鎖');
            $table->string('banned_remarks')->nullable()->comment('封鎖原因');
            $table->timestamp('banned_at')->nullable()->comment('在什麼時候被封鎖');
            $table->timestamps();
            $table->softDeletes();
        });

        /** 群眾審核 */
        Schema::create('social_cards_review', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('card_id')->comment('文章 ID');
            $table->morphs('model');
            $table->integer('point')->default(0)->comment('票數權重');
            $table->longText('config')->comment('設定');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('card_id')
                ->references('id')
                ->on('social_cards')
                ->onDelete('cascade');
        });

        /** 社群平台文章 */
        Schema::create('social_cards_post', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('card_id')->comment('文章 ID');
            $table->unsignedBigInteger('token_id')->comment('平台 ID');
            $table->string('social_card_id')->comment('社群平台 ID');
            $table->integer('num_like')->default(0)->comment('按讚數量');
            $table->integer('num_share')->default(0)->comment('分享數量');
            $table->unsignedTinyInteger('active')->default(1)->comment('啟用');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('card_id')
                ->references('id')
                ->on('social_cards')
                ->onDelete('cascade');

            $table->foreign('token_id')
                ->references('id')
                ->on('social_token')
                ->onDelete('cascade');
        });

        /** 社群平台留言 */
        Schema::create('social_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('card_id')->comment('文章 ID');
            $table->unsignedBigInteger('token_id')->comment('平台 ID');
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

            $table->foreign('token_id')
                ->references('id')
                ->on('social_cards_post')
                ->onDelete('cascade');
        });

        /** 文章圖片 */
        Schema::create('card_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('card_id')->comment('文章 ID');
            $table->string('storage')->comment('存放載體');
            $table->string('avatar_path')->nullable()->comment('檔案路徑');
            $table->string('avatar_name')->nullable()->comment('檔案名稱');
            $table->string('avatar_type')->nullable()->comment('檔案類型');
            $table->unsignedTinyInteger('active')->default(1)->comment('啟用');
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
    public function down(): void
    {
        Schema::dropIfExists('card_images');
        Schema::dropIfExists('social_comments');
        Schema::dropIfExists('social_cards_post');
        Schema::dropIfExists('social_cards_review');
        Schema::dropIfExists('social_cards');
        Schema::dropIfExists('social_cards_ads');
        Schema::dropIfExists('social_token');
    }
}
