<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class UpdateSocialAdsRenderTable.
 */
class UpdateSocialAdsRenderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('social_cards_ads', function (Blueprint $table) {
            $table->unsignedTinyInteger('render')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('social_cards_ads', function ($table) {
            $table->dropColumn('render');
        });
    }
}
