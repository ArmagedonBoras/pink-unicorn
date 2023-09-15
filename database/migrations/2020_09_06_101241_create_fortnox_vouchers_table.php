<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFortnoxVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fortnox_vouchers', function (Blueprint $table) {
            $table->id();
            $table->integer('voucher_number')->nullable()->comment('key in fortnox');
            $table->string('cost_center')->nullable();
            $table->string('description')->nullable();
            $table->string('voucher_series', 3)->nullable();
            $table->integer('year')->nullable();
            $table->timestamp('synced_at')->nullable();
            $table->timestamps();
            $table->unique(['voucher_number', 'voucher_series']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fortnox_vouchers');
    }
}
