<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nav_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('菜单名称');
            $table->string("path")->unique()->comment('访问路径');
            $table->unsignedInteger('order')->default(100)->comment('顺序');
            $table->unsignedInteger('target')->default(0)->comment('0:原窗口打开；1:新窗口打开');
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
        Schema::dropIfExists('nav_menus');
    }
}
