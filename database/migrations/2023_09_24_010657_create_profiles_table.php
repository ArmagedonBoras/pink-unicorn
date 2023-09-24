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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('address')->nullable();
            $table->integer('zip')->nullable();
            $table->string('city')->nullable();
            $table->unsignedBigInteger('person_id')->nullable();
            $table->string('telephone')->nullable();
            $table->boolean('notifications')->default(true);
            $table->boolean('supporting')->default(false);
            $table->boolean('vapid')->default(false);
            $table->boolean('woman')->default(false);
            $table->boolean('bsk')->default(false);
            $table->boolean('board')->default(false);
            $table->boolean('study_circle')->default(false);
            $table->boolean('study_leader')->default(true);

            $table->date('study_leader_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
