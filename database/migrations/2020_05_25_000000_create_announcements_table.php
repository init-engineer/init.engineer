<?php

use App\Domains\Announcement\Models\Announcement;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateAnnouncementsTable.
 */
class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->enum('area', array(
                Announcement::AREA_FRONTEND,
                Announcement::AREA_BACKEND,
            ))->nullable();
            $table->enum('type', array(
                Announcement::TYPE_PRIMARY,
                Announcement::TYPE_SECONDARY,
                Announcement::TYPE_SUCCESS,
                Announcement::TYPE_DANGER,
                Announcement::TYPE_WARNING,
                Announcement::TYPE_INFO,
                Announcement::TYPE_LIGHT,
                Announcement::TYPE_DARK,
            ))->default('info');
            $table->text('message');
            $table->boolean('enabled')->default(true);
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
}
