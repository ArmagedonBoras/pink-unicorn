<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFortnoxInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fortnox_invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('document_number')->unique()->nullable()->comment('key in fortnox');
            $table->string('customer_number');
            $table->string('customer_name')->nullable();
            $table->decimal('balance')->nullable();
            $table->boolean('cancelled')->nullable();
            $table->boolean('credit')->nullable();
            $table->string('payment_way')->nullable();
            $table->string('invoice_type')->default('INVOICE');
            $table->date('due_date')->nullable();
            $table->date('invoice_date')->nullable();
            $table->string('print_template')->default('st');
            $table->decimal('total')->nullable();
            $table->timestamp('synced_at')->nullable();
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
        Schema::dropIfExists('fortnox_invoices');
    }
}
