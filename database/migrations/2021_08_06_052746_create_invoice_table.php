<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('quotation_id')->nullable();
            $table->string('invoice_number')->nullable();
            $table->unsignedBigInteger('member_id')->nullable();
            $table->date('date')->nullable();
            $table->string('payment_terms')->nullable();
            $table->string('type')->nullable();
            $table->string('port_of_destination')->nullable();
            $table->string('consignee_address')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('email')->nullable();
            $table->float('sub_total',12,2)->nullable();
            $table->float('shipping_cost',12,2)->nullable();
            $table->float('total',12,2)->nullable();
            $table->enum('status',['draft', 'paid', 'cancel']);
            $table->softDeletes();
            $table->timestamps();
            $table->unique('invoice_number');

            $table->foreign('member_id')->references('id')->on('member')->onDelete('cascade');
            $table->foreign('quotation_id')->references('id')->on('quotation')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice');
    }
}
