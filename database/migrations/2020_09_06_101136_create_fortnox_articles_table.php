<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFortnoxArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fortnox_articles', function (Blueprint $table) {
            $table->id();
            $table->string('article_number')->unique()->comment('key in fortnox');
            $table->string('description')->nullable();
            $table->decimal('sales_price')->nullable()->default(0);
            $table->boolean('active')->nullable();
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
        Schema::dropIfExists('fortnox_articles');
    }
}
