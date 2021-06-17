<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWikiProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wiki_projects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('项目名称');
            $table->string('description', 2000)->nullable(true)->comment('项目描述');
            $table->unsignedInteger('type')->comment('项目类型，1-公开/ 0-私密');
            $table->boolean("sync_to_blog")->comment("是否同步到博客")->default(true);
            $table->unsignedInteger('doc_count')->default(0)->comment('文档数量');
            $table->string('thumb')->comment('项目封面图');
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
        Schema::dropIfExists('wiki_projects');
    }
}
