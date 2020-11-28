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
        Schema::create('social_platform', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('社群平台名稱');
            $table->string('type')->default('local')->comment('社群平台分類');
            $table->unsignedTinyInteger('active')->default(0)->comment('啟用');
            $table->json('config')->comment('設定');
            $table->timestamps();
            $table->softDeletes();
        });

        /** 廣告 */
        Schema::create('social_cards_ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('model');
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
            $table->json('config')->comment('設定');
            $table->unsignedTinyInteger('active')->default(1)->comment('啟用');
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
            $table->json('config')->comment('設定');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('card_id')
                ->references('id')
                ->on('social_cards')
                ->onDelete('cascade');
        });

        /** 社群平台留言 */
        Schema::create('social_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('card_id')->comment('文章 ID');
            $table->unsignedBigInteger('platform_id')->comment('平台 ID');
            $table->string('comment_id')->nullable()->comment('社群平台 ID');
            $table->string('user_name')->comment('使用者名稱');
            $table->string('user_id')->comment('使用者 ID');
            $table->longText('user_avatar')->comment('使用者大頭貼');
            $table->longText('content')->comment('留言內容');
            $table->unsignedTinyInteger('active')->default(1)->comment('啟用');
            $table->string('reply')->nullable()->comment('回覆自社群平台 ID');
            $table->unsignedTinyInteger('banned')->default(0)->comment('封鎖狀態');
            $table->unsignedBigInteger('banned_by')->nullable()->comment('被誰封鎖');
            $table->string('banned_remarks')->nullable()->comment('封鎖原因');
            $table->timestamp('banned_at')->nullable()->comment('在什麼時候被封鎖');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('card_id')
                ->references('id')
                ->on('social_cards')
                ->onDelete('cascade');

            $table->foreign('platform_id')
                ->references('id')
                ->on('social_platform')
                ->onDelete('cascade');
        });

        /** 文章圖片 */
        Schema::create('card_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('card_id')->comment('文章 ID');
            $table->string('storage')->comment('存放載體');
            $table->string('path')->nullable()->comment('檔案路徑');
            $table->string('name')->nullable()->comment('檔案名稱');
            $table->string('type')->nullable()->comment('檔案類型');
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
        Schema::dropIfExists('social_cards_review');
        Schema::dropIfExists('social_cards');
        Schema::dropIfExists('social_cards_ads');
        Schema::dropIfExists('social_platform');
    }
}
