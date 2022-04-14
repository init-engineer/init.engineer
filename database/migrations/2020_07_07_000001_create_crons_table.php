<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateCronsTable.
 *
 * @extends Migration
 */
class CreateCronsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('crons', function (Blueprint $table) {
            $table->string('command')->comment('Command 指令');
            $table->integer('next_run')->comment('下次執行時間');
            $table->integer('last_run')->comment('上次執行時間');
            $table->timestamps();
            $table->softDeletes();

            $table->primary('command');
            $table->index('next_run');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('crons');
    }
}
