<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOauthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_oauths', function (Blueprint $table) {
            $table->comment = "第三方应用认证表";
            $table->id();
            // $table->unsignedBigInteger('user_id')->index()->comment('用户id');
            $table->string('user_id')->index()->default('')->comment('绑定的user_id');
            $table->string('platform', 20)->index()->comment('应用类型');
            $table->string('platform_id')->index()->comment('第三方账号ID');
            $table->string('access_token')->nullable();
            $table->string('refresh_token')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->unsignedTinyInteger('status')->index()->comment('授权状态');
            $table->string('name')->nullable()->comment('用户名');
            $table->string('avatar')->nullable()->comment('头像');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_oauths');
    }
}
