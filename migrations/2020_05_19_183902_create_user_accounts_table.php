<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->comment = "用户账号表";
            $table->id();
            // $table->unsignedBigInteger('user_id')->default(0)->index()->comment('用户id');
            $table->string('user_id')->index()->default('')->comment('绑定的user_id');
            $table->string('account', 80)->index()->comment('登陆的账号');
            $table->string('password')->nullable()->comment('密码');
            $table->unsignedTinyInteger('type')->comment('账号类型');
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
        Schema::dropIfExists('user_accounts');
    }
}
