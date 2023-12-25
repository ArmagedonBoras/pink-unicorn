<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId("owned_by");
            $table->foreignId('parent_id')->nullable()->default(null);
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->default('');
            $table->text('body')->nullable();
            $table->foreignId('visibility')->nullable();
            $table->foreignId('scope')->nullable();
            $table->foreignId('availability')->nullable();
            $table->foreignId('activity')->nullable();
            $table->foreignId('activity_type')->nullable();
            $table->boolean('has_signup')->default(false);
            $table->boolean('is_recurring')->default(false);
            $table->integer('signup_seats')->default(10000);
            $table->dateTime('recurring_default_at')->nullable();
            $table->string('recurring_year')->nullable()->default('*');
            $table->string('recurring_month')->nullable()->default('*');
            $table->string('recurring_day')->nullable()->default('*');
            $table->string('recurring_week')->nullable()->default('*');
            $table->string('recurring_week_of_month')->nullable()->default('*');
            $table->string('recurring_weekday')->nullable()->default('*');
            $table->timestamp('recurring_end_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
