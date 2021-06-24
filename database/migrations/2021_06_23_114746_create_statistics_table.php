<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistic_visitor', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment("统计时间名称");
            $table->string('scene')->comment("场景值");
            $table->string('location')->comment("位置（二级分类）");
            $table->string('ip')->nullable()->comment("用户IP");
            $table->text('content')->nullable()->comment("自定义统计内容");
            $table->dateTime('date')->comment("访问日期，格式 Y-m-d");
            $table->timestamps();
        });

        Schema::create('statistic_visit', function (Blueprint $table) {
            $table->id();
            $table->string('scene')->comment("场景值");
            $table->string('location')->comment("位置（二级分类）");
            $table->unsignedInteger('uv')->default(0)->comment("UV数");
            $table->integer('pv')->default(0)->comment("PV数");
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
        Schema::dropIfExists('statistic_event');
        Schema::dropIfExists('statistic_visit');
    }
}
