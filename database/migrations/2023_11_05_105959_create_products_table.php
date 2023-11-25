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
        Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slug');
        $table->string('price');
        $table->string('commission');
        $table->string('ex_date');
        $table->longText('description');
        $table->string('name_promotion');
        $table->string('image');
        $table->longText('link');
        $table->enum('status',['Enabled','Disabled'])->default('Enabled');
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
        Schema::dropIfExists('products');
    }
};
