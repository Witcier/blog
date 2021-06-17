<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavigationSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigation_sites', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('order')->default(10000);
            $table->unsignedBigInteger('navigation_category_id');
            $table->foreign('navigation_category_id')->references('id')->on('navigation_categories')->onDelete('cascade');
            $table->string('title', 50);
            $table->string('describe', 300);
            $table->string('url', 250);
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
        Schema::dropIfExists('navigation_sites');
    }
}
