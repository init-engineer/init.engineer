<?php

use App\Models\Social\Ads;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class UpdateSocialAdsTypeTable.
 */
class UpdateSocialAdsTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('social_cards_ads', function (Blueprint $table) {
            $table->enum('type', array(
                Ads::TYPE_ALL,
                Ads::TYPE_BANNER,
                Ads::TYPE_CONTENT,
            ))->default(Ads::TYPE_BANNER)->comment('廣告分類');
            $table->longText('content')->nullable()->comment('廣告內容');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('social_cards_ads', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('content');
        });
    }
}
