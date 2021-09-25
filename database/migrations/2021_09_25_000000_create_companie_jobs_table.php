<?php

use App\Domains\Companie\Models\CompanieJobs;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateCompanieJobsTable.
 */
class CreateCompanieJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        /**
         * 公司
         */
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable();
            $table->morphs('model');
            $table->string('name')->comment('名稱');
            $table->string('description')->comment('簡介');
            $table->longText('content')->comment('詳細介紹');
            $table->integer('scale')->comment('人數');
            $table->json('picture')->default(json_encode(array(
                'local' => null,
                'storage' => null,
                'imgur' => null,
            )))->comment('公司 Logo 圖片資訊');
            $table->unsignedTinyInteger('active')->default(0)->comment('啟用狀態');
            $table->boolean('blockade')->default(0)->comment('封鎖狀態');
            $table->unsignedBigInteger('blockade_by')->nullable()->comment('被誰封鎖');
            $table->string('blockade_remarks')->nullable()->comment('封鎖原因');
            $table->timestamp('blockade_at')->nullable()->comment('在什麼時候被封鎖');
            $table->timestamps();
            $table->softDeletes();
        });

        /**
         * 公司成員
         */
        Schema::create('companie_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable();
            $table->morphs('model');
            $table->unsignedBigInteger('companie_id')->comment('公司 ID');
            $table->json('picture')->default(json_encode(array(
                'local' => null,
                'storage' => null,
                'imgur' => null,
            )))->comment('成員大頭貼圖片資訊');
            $table->string('name')->comment('名稱');
            $table->string('office')->comment('職稱');
            $table->longText('about')->default('Undefined.')->comment('關於我');
            $table->timestamps();
            $table->softDeletes();

            $table->index([
                'id',
                'model_type',
                'model_id',
                'companie_id',
            ], 'companie_members_id_model_type_model_id_companie_id_index');

            $table->foreign('companie_id')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade');
        });

        /**
         * 公司相關連結
         */
        Schema::create('companie_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable();
            $table->morphs('model');
            $table->unsignedBigInteger('companie_id')->comment('公司 ID');
            $table->string('icon')->comment('ICON 種類');
            $table->string('url')->comment('連結');
            $table->timestamps();
            $table->softDeletes();

            $table->index([
                'id',
                'model_type',
                'model_id',
                'companie_id',
            ], 'companie_links_id_model_type_model_id_companie_id_index');

            $table->foreign('companie_id')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade');
        });

        /**
         * 職缺
         */
        Schema::create('companie_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable();
            $table->morphs('model');
            $table->unsignedBigInteger('companie_id')->comment('公司 ID');
            $table->string('name')->comment('職缺名稱');
            $table->enum('type', array(
                CompanieJobs::JOB_FULL_TIME,
                CompanieJobs::JOB_PART_TIME,
                CompanieJobs::JOB_DISPATCHED,
                CompanieJobs::JOB_INTERNSHIP,
            ))->default(CompanieJobs::JOB_FULL_TIME)->comment('職缺類型');
            $table->json('content')->default(json_encode(array(
                // 工作範疇
                'scope' => null,
                // 工作需求
                'require' => null,
                // 遠端工作
                'remote' => null,
            )))->comment('內容資訊');
            $table->json('pay')->default(json_encode(array(
                // 支薪方式
                'type' => null,
                // 薪資範圍
                'amount' => array(
                    // 薪水最低
                    'min' => null,
                    // 薪水最高
                    'max' => null,
                ),
            )))->comment('薪資範圍');
            $table->unsignedTinyInteger('active')->default(0)->comment('啟用狀態');
            $table->boolean('blockade')->default(0)->comment('封鎖狀態');
            $table->unsignedBigInteger('blockade_by')->nullable()->comment('被誰封鎖');
            $table->string('blockade_remarks')->nullable()->comment('封鎖原因');
            $table->timestamp('blockade_at')->nullable()->comment('在什麼時候被封鎖');
            $table->timestamps();
            $table->softDeletes();

            $table->index([
                'id',
                'model_type',
                'model_id',
                'companie_id',
            ], 'companie_jobs_id_model_type_model_id_companie_id_index');

            $table->foreign('companie_id')
                ->references('id')
                ->on('companies')
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
        Schema::dropIfExists('companie_jobs');
        Schema::dropIfExists('companie_links');
        Schema::dropIfExists('companie_members');
        Schema::dropIfExists('companies');
    }
}
