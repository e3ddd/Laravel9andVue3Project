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
        Schema::create('products_attributes_values', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('string_value')->nullable();
            $table->integer('integer_value')->nullable();
            $table->timestamps();


            $table->foreignId('attribute_id')
                ->constrained('products_attributes')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_attributes_values');
    }
};
