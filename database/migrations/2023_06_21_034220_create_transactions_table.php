<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference');  
            $table->string('email');
            $table->string('phone')->nullable();
            $table->integer('amount')->unsigned();
            $table->string('callback_url')->nullable();
            $table->string('gateway_response')->nullable();
            $table->string('paid_at')->nullable();
            $table->string('authorization_url')->nullable();
            $table->string('status')->default('pending');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
