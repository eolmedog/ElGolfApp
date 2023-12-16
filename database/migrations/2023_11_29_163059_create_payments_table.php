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
            Schema::create('payments', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('email');
                $table->string('first_name');
                $table->string('last_name');
                $table->decimal('amount', 12, 0);
                $table->string('social_id');
                $table->text('description');
                $table->integer('hours');
                $table->string('payment_status');
                $table->timestamp('payment_date')->nullable();
                $table->string('payment_method')->nullable();
                $table->string('payment_id')->nullable();
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            Schema::dropIfExists('payments');
        });
    }
};
