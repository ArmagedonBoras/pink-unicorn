<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFortnoxFinancialYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fortnox_financial_years', function (Blueprint $table) {
            $table->id('fortnox_id')->comment('model key due to id is the key in fortnox');
            $table->foreignId('id')->unique()->comment('key in fortnox');
            $table->date('from_date');
            $table->date('to_date');
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
        Schema::dropIfExists('fortnox_financial_years');
    }
}
