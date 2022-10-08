<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Kampanya');
            $table->string('code')->default('CAMPAIN');
            $table->decimal('qty')->nullable();
            $table->decimal('minimum_amount')->nullable();
            $table->enum('minimum_amount_type',['decimal','percent'])->default('decimal');
            $table->decimal('minimum_amount_discount',10,2)->default('0');
            $table->unsignedInteger('customer_id');
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('cart_rules');
    }
};
