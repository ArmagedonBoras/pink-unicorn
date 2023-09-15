<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFortnoxInvoiceRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fortnox_invoice_rows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fortnox_invoice_id');
            $table->string('article_number');
            $table->string('cost_center')->nullable();
            $table->decimal('delivered_quantity');
            $table->string('description')->nullable();
            $table->decimal('price')->nullable();
            $table->string('unit')->nullable();
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
        Schema::dropIfExists('fortnox_invoice_rows');
    }
}
