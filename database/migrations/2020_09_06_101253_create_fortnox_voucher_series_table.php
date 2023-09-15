<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFortnoxVoucherSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fortnox_voucher_series', function (Blueprint $table) {
            $table->id();
            $table->string('code', 3)->unique()->comment('key in fortnox');
            $table->string('description')->nullable();
            $table->boolean('manual');
            $table->integer('year');
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
        Schema::dropIfExists('fortnox_voucher_series');
    }
}
