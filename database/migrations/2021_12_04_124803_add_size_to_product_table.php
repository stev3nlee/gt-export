<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSizeToProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->float('length', 15,2)->default(0);
            $table->float('width', 15,2)->default(0);
            $table->float('height', 15,2)->default(0);
            $table->float('dimension', 15,2)->default(0);

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
            $table->dropColumn('length');
            $table->dropColumn('height');
            $table->dropColumn('width');
            $table->dropColumn('dimension');
        });
    }
}
