<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->string('thumbnail')->nullable();
            $table->string('chassis_no')->nullable();
            $table->string('model_code')->nullable();
            $table->string('product_type')->nullable();
            $table->string('registration_year')->nullable();
            $table->string('registration_month')->nullable();
            $table->string('manufacture_year')->nullable();
            $table->string('manufacture_month')->nullable();
            $table->string('mileage')->nullable();
            $table->string('mileage_km')->nullable();
            $table->string('engine_capacity')->nullable();
            $table->string('engine_no')->nullable();
            $table->string('fuel')->nullable();
            $table->string('steering')->nullable();
            $table->string('drive_type')->nullable();
            $table->string('color')->nullable();
            $table->string('engine_code')->nullable();
            $table->string('number_of_doors')->nullable();
            $table->integer('seats')->nullable();
            $table->integer('total_seats')->nullable();
            $table->float('weight', 15,2)->nullable();
            $table->float('total_weight', 15,2)->nullable();
            $table->text('remarks')->nullable();
            

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
            $table->dropColumn('thumbnail');
            $table->dropColumn('product_type');
            $table->dropColumn('registration_year');
            $table->dropColumn('registration_month');
            $table->dropColumn('chassis_no');
            $table->dropColumn('model_code');
            $table->dropColumn('mileage');
            $table->dropColumn('mileage_km');
            $table->dropColumn('engine_capacity');
            $table->dropColumn('engine_no');
            $table->dropColumn('fuel');
            $table->dropColumn('steering');
            $table->dropColumn('drive_type');
            $table->dropColumn('color');
            $table->dropColumn('engine_code');
            $table->dropColumn('number_of_doors');
            $table->dropColumn('seats');
            $table->dropColumn('total_seats');
            $table->dropColumn('weight');
            $table->dropColumn('total_weight');
            $table->dropColumn('remarks');
        });
    }
}
