<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('faq_category_id')->nullable();
            $table->text('question')->nullable();
            $table->text('answer')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('faq_category_id')->references('id')->on('faq_category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq');
    }
}
