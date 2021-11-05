<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewToProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->integer('new_arrival_days')->default(0);
            $table->dateTime('new_arrival_expired_date')->nullable();
            $table->float('discount_price', 15,2)->default(0);
            $table->float('discount_percent', 3,1)->default(0);
            $table->dateTime('last_view')->nullable();
            $table->integer('total_view')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn('new_arrival_days');
            $table->dropColumn('new_arrival_expired_date');
            $table->dropColumn('discount_price');
            $table->dropColumn('discount_percent');
            $table->dropColumn('last_view');
            $table->dropColumn('total_view');
        });
    }
}
