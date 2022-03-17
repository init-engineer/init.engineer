<?php

use App\Domains\Companie\Models\CompanieJobs;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateCompanieJobsTable.
 *
 * @extends Migration
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
         * 公司 Companies
         */
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable();
            $table->morphs('model');
            $table->string('name')->comment('名稱');
            $table->json('logo')->default([
                'local' => null,
                'storage' => null,
                'imgur' => null,
            ])->comment('公司 Logo 圖片資訊 - 單張');
            $table->json('banner')->default([
                'local' => null,
                'storage' => null,
                'imgur' => null,
            ])->comment('公司 Logo 圖片資訊 - 單張');
            $table->json('pictures')->default([
                [
                    'local' => null,
                    'storage' => null,
                    'imgur' => null,
                ],
                [
                    'local' => null,
                    'storage' => null,
                    'imgur' => null,
                ],
                [
                    'local' => null,
                    'storage' => null,
                    'imgur' => null,
                ],
            ])->comment('公司相關圖片資訊 - 多張');
            $table->enum('area', [
                '臺北市', '新北市', '桃園市', '臺中市', '臺南市',
                '高雄市', '基隆市', '新竹市', '嘉義市', '新竹縣',
                '苗栗縣', '彰化縣', '南投縣', '雲林縣', '嘉義縣',
                '屏東縣', '宜蘭縣', '花蓮縣', '臺東縣', '澎湖縣',
                '金門縣', '連江縣', '海外',
            ])->comment('區域');
            $table->string('address')->comment('地址');
            $table->integer('scale')->nullable()->comment('人數');
            $table->string('tax')->nullable()->comment('統一編號');
            $table->integer('capital')->nullable()->comment('資本額');
            $table->string('email')->comment('信箱');
            $table->string('phone')->nullable()->comment('電話');
            $table->string('description')->default('我們沒有任何簡介 :)')->comment('簡介');
            $table->json('content')->default([
                '公司介紹' => '我們沒有任何公司介紹 :)',
                '經營理念' => '我們沒有任何經營理念 :)',
                '福利制度' => '我們沒有任何福利制度 :)',
            ])->comment('詳細介紹');
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
            $table->json('picture')->default([
                'local' => null,
                'storage' => null,
                'imgur' => null,
            ])->comment('成員大頭貼圖片資訊');
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
            $table->enum('type', [
                CompanieJobs::JOB_FULL_TIME,
                CompanieJobs::JOB_PART_TIME,
                CompanieJobs::JOB_DISPATCHED,
                CompanieJobs::JOB_INTERNSHIP,
            ])->default(CompanieJobs::JOB_FULL_TIME)->comment('職缺類型');
            $table->json('content')->default([
                // 工作範疇
                'scope' => null,
                // 工作需求
                'require' => null,
                // 遠端工作
                'remote' => null,
            ])->comment('內容資訊');
            $table->json('pay')->default([
                // 支薪方式
                'type' => null,
                // 薪資範圍
                'amount' => [
                    // 薪水最低
                    'min' => null,
                    // 薪水最高
                    'max' => null,
                ],
            ])->comment('薪資範圍');
            $table->unsignedTinyInteger('publish')->default(0)->comment('職缺發佈');
            $table->timestamp('publish_at')->nullable()->comment('在什麼時候發佈的');
            $table->unsignedTinyInteger('closure')->default(0)->comment('職缺關閉');
            $table->timestamp('closure_at')->nullable()->comment('在什麼時候關閉的');
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
