<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateUsersTable.
 */
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->string('first_name')->nullable()->comment('名字');
            $table->string('last_name')->nullable()->comment('姓氏');
            $table->string('email')->unique()->comment('電子郵件');
            $table->string('avatar_type')->default('gravatar')->comment('大頭貼位址');
            $table->string('avatar_location')->nullable()->comment('大頭貼路徑');
            $table->string('password')->nullable()->comment('密碼');
            $table->timestamp('password_changed_at')->nullable()->comment('上次更新密碼時間');
            $table->unsignedTinyInteger('active')->default(1)->comment('啟用');
            $table->string('confirmation_code')->nullable()->comment('驗證 Code');
            $table->boolean('confirmed')->default(config('access.users.confirm_email') ? false : true)->comment('驗證狀態');
            $table->string('timezone')->nullable()->comment('時區');
            $table->timestamp('last_login_at')->nullable()->comment('上次登入時間');
            $table->string('last_login_ip')->nullable()->comment('上次登入來源');
            $table->boolean('to_be_logged_out')->default(false)->comment('是否需要自動登出');
            $table->string('api_token', 60)->unique()->nullable()->default(null)->comment('API Token');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
