<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOauthOriginalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_oauth_original', function (Blueprint $table) {
            $table->comment = "用户授权登陆信息表";
            $table->unsignedBigInteger('user_oauth_id')->primary();
            $table->json('platform_original')->comment('元数据');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_oauth_original');
    }
}
