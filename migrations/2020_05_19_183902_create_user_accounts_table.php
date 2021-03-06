<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

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
            if (method_exists($table, 'id')) {
                $table->id();
            } else {
                $table->increments('id');
            }
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
