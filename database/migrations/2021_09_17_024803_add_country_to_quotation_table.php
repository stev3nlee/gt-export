<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCountryToQuotationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotation', function (Blueprint $table) {
            $table->string('country')->nullable();
            $table->string('country_code')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->float('shipping_fee', 15,2)->default(0);
            $table->text('payload')->nullable();
            

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
            $table->dropColumn('country');
            $table->dropColumn('country_code');
            $table->dropColumn('region');
            $table->dropColumn('city');
            $table->dropColumn('shipping_fee');
            $table->dropColumn('payload');
        });
    }
}
