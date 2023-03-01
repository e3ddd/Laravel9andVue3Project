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
        Schema::create('products_size_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value');
            $table->timestamps();

            $table->foreignId('subcategory_id')
                ->constrained('categories')
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
        Schema::dropIfExists('product_size_attribute');
    }
};
