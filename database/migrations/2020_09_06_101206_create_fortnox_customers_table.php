<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFortnoxCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fortnox_customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_number')->unique()->nullable()->comment('key in fortnox');
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('city')->nullable();
            $table->string('email')->nullable();
            $table->string('email_invoice')->nullable();
            $table->string('email_invoice_c_c')->nullable();
            $table->string('country')->default('Sverige')->nullable();
            $table->string('country_code')->default('SE')->nullable();
            $table->string('currency')->default('SEK')->nullable();
            $table->string('name');
            $table->string('your_reference')->nullable();
            $table->string('organisation_number')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('price_list')->default('A')->nullable();
            $table->string('terms_of_payment')->default('30')->nullable();
            $table->boolean('show_price_v_a_t_included')->default(true);
            $table->string('default_delivery_types');
            $table->string('v_a_t_type')->nullable();
            $table->string('v_a_t_number')->nullable();
            $table->string('type')->default('PRIVATE');
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
        Schema::dropIfExists('fortnox_customers');
    }
}
