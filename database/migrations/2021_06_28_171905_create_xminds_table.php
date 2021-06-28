<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXmindsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xmind_map', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('xmind_category_id');
            $table->foreign('xmind_category_id')->references('id')->on('xmind_categories')->onDelete('cascade');
            $table->string('name')->nullable(false);
            $table->boolean('type')->default(\App\Models\Xmind\Xmind::TYPE_PUBLIC)->comment('项目类型，1-公开/ 0-私密');
            $table->longText('content')->nullable(true);
            $table->unsignedInteger('order')->default(10000);
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
        Schema::dropIfExists('xmind_map');
    }
}
