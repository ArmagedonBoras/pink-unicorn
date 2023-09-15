<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFortnoxVoucherRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fortnox_voucher_rows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fortnox_voucher_id');
            $table->string('account', 4);
            $table->string('cost_center')->nullable();
            $table->decimal('credit')->nullable();
            $table->decimal('debit')->nullable();
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
        Schema::dropIfExists('fortnox_voucher_rows');
    }
}
