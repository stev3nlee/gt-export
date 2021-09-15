<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToQuotationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotation', function (Blueprint $table) {
            $table->string('product_name')->nullable();
            $table->float('price', 14,2)->nullable();
            $table->date('dob')->nullable();
            $table->dateTime('expired_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotation', function (Blueprint $table) {
            $table->dropColumn('product_name');
            $table->dropColumn('price');
            $table->dropColumn('dob');
            $table->dropColumn('expired_date');
        });
    }
}
