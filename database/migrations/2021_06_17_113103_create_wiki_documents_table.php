<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWikiDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wiki_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wiki_project_id')->comment('所属项目ID');
            $table->foreign('wiki_project_id')->references('id')->on('wiki_projects')->onDelete('cascade');
            $table->string('name')->comment('文档名称');
            $table->boolean('type')->comment('类型，1-文件夹/ 0-文档');
            $table->unsignedInteger('parent_id')->comment('父级ID');
            $table->unsignedInteger('sort')->default(0)->comment('排序');
            $table->longText('content')->nullable(true)->comment('文档内容');
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
        Schema::dropIfExists('wiki_documents');
    }
}
