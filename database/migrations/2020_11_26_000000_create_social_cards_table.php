<?php

use App\Domains\Social\Models\Ads;
use App\Domains\Social\Models\Platform;
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
        /** 社群平台 */
        Schema::create('social_platform', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable();
            $table->string('name')->comment('社群平台名稱');
            $table->enum('action', array(
                Platform::ACTION_INACTION,
                Platform::ACTION_NOTIFICATION,
                Platform::ACTION_PUBLISH,
            ))->default(Platform::ACTION_PUBLISH)->comment('社群平台行為');
            $table->enum('type', array(
                Platform::TYPE_LOCAL,
                Platform::TYPE_FACEBOOK,
                Platform::TYPE_TWITTER,
                Platform::TYPE_PLURK,
                Platform::TYPE_TUMBLR,
                Platform::TYPE_DISCORD,
                Platform::TYPE_TELEGRAM,
            ))->default(Platform::TYPE_LOCAL)->comment('社群平台分類');
            $table->unsignedTinyInteger('active')->default(0)->comment('啟用');
            $table->json('config')->comment('設定');
            $table->timestamps();
            $table->softDeletes();
        });

        /** Ads 廣告 */
        Schema::create('social_cards_ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable();
            $table->morphs('model');
            $table->enum('type', array(
                Ads::TYPE_ALL,
                Ads::TYPE_BANNER,
                Ads::TYPE_CONTENT,
            ))->default(Ads::TYPE_BANNER)->comment('廣告分類');
            $table->string('name')->nullable()->comment('廣告名稱');
            $table->longText('content')->nullable()->comment('廣告內容');
            $table->json('picture')->nullable()->comment('圖片資訊');
            $table->json('deploy')->default('[]')->comment('部署文章');
            $table->integer('probability')->default(0)->comment('部署機率');
            $table->unsignedTinyInteger('render')->default(0)->comment('彩色渲染');
            $table->unsignedTinyInteger('payment')->default(0)->comment('付款狀態');
            $table->unsignedTinyInteger('active')->default(1)->comment('啟用');
            $table->timestamp('starts_at')->nullable()->comment('開始日期');
            $table->timestamp('ends_at')->nullable()->comment('結束日期');
            $table->timestamps();
            $table->softDeletes();

            $table->index([
                'id',
                'model_id',
                'model_type',
            ], 'social_cards_ads_id_model_id_model_type_index');
        });

        /** 主要文章 */
        Schema::create('social_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable();
            $table->morphs('model');
            $table->longText('content')->comment('內文');
            $table->json('config')->default('{}')->comment('文章設定');
            $table->json('picture')->default('{}')->comment('圖片資訊');
            $table->unsignedTinyInteger('active')->default(1)->comment('啟用');
            $table->boolean('blockade')->default(0)->comment('封鎖狀態');
            $table->unsignedBigInteger('blockade_by')->nullable()->comment('被誰封鎖');
            $table->string('blockade_remarks')->nullable()->comment('封鎖原因');
            $table->timestamp('blockade_at')->nullable()->comment('在什麼時候被封鎖');
            $table->timestamps();
            $table->softDeletes();

            $table->index([
                'id',
                'model_id',
                'model_type',
            ], 'social_cards_id_model_id_model_type_index');
        });

        /** 社群平台文章 */
        Schema::create('social_platform_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable();
            $table->enum('platform_type', array(
                Platform::TYPE_LOCAL,
                Platform::TYPE_FACEBOOK,
                Platform::TYPE_TWITTER,
                Platform::TYPE_PLURK,
                Platform::TYPE_TUMBLR,
                Platform::TYPE_DISCORD,
                Platform::TYPE_TELEGRAM,
            ))->default(Platform::TYPE_LOCAL)->comment('社群平台分類');
            $table->unsignedBigInteger('platform_id')->comment('社群平台 ID');
            $table->string('platform_string_id')->nullable()->comment('社群文章 String ID');
            $table->string('platform_url')->nullable()->comment('社群文章 URL');
            $table->unsignedBigInteger('card_id')->comment('文章 ID');
            $table->unsignedTinyInteger('active')->default(1)->comment('啟用');
            $table->integer('likes')->default(0)->comment('按讚數量');
            $table->integer('shares')->default(0)->comment('分享數量');
            $table->timestamps();
            $table->softDeletes();

            $table->index([
                'id',
                'platform_id',
                'card_id',
            ], 'social_platform_cards_id_platform_id_card_id_index');

            $table->foreign('platform_id')
                ->references('id')
                ->on('social_platform')
                ->onDelete('cascade');

            $table->foreign('card_id')
                ->references('id')
                ->on('social_cards')
                ->onDelete('cascade');
        });

        /** 群眾審核 */
        Schema::create('social_cards_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable();
            $table->morphs('model');
            $table->unsignedBigInteger('card_id')->comment('文章 ID');
            $table->integer('point')->default(0)->comment('票數權重');
            $table->json('config')->default('{}')->comment('設定');
            $table->timestamps();
            $table->softDeletes();

            $table->index([
                'id',
                'model_id',
                'model_type',
                'card_id',
            ], 'social_cards_reviews_id_model_id_model_type_card_id_index');

            $table->foreign('card_id')
                ->references('id')
                ->on('social_cards')
                ->onDelete('cascade');
        });

        /** 社群平台留言 */
        Schema::create('social_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable();
            $table->unsignedBigInteger('card_id')->comment('文章 ID');
            $table->unsignedBigInteger('platform_id')->nullable()->comment('平台 ID');
            $table->unsignedBigInteger('platform_card_id')->nullable()->comment('平台文章 ID');
            $table->string('comment_id')->nullable()->comment('社群平台 ID');
            $table->string('user_name')->nullable()->comment('使用者名稱');
            $table->string('user_id')->nullable()->comment('使用者 ID');
            $table->longText('user_avatar')->nullable()->comment('使用者大頭貼');
            $table->longText('content')->comment('留言內容');
            $table->unsignedTinyInteger('active')->default(1)->comment('啟用');
            $table->string('reply')->nullable()->comment('回覆自社群平台 ID');
            $table->unsignedTinyInteger('blockade')->default(0)->comment('封鎖狀態');
            $table->unsignedBigInteger('blockade_by')->nullable()->comment('被誰封鎖');
            $table->string('blockade_remarks')->nullable()->comment('封鎖原因');
            $table->timestamp('blockade_at')->nullable()->comment('在什麼時候被封鎖');
            $table->timestamps();
            $table->softDeletes();

            $table->index([
                'id',
                'card_id',
                'platform_id',
            ], 'social_comments_id_card_id_platform_id_index');

            $table->foreign('card_id')
                ->references('id')
                ->on('social_cards')
                ->onDelete('cascade');

            $table->foreign('platform_id')
                ->references('id')
                ->on('social_platform')
                ->onDelete('cascade');

            $table->foreign('platform_card_id')
                ->references('id')
                ->on('social_platform_cards')
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
        Schema::dropIfExists('social_comments');
        Schema::dropIfExists('social_cards_reviews');
        Schema::dropIfExists('social_platform_cards');
        Schema::dropIfExists('social_cards');
        Schema::dropIfExists('social_cards_ads');
        Schema::dropIfExists('social_platform');
    }
}
