<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('articul');
            $table->text('description');
            $table->integer('size');
            // $table->float('width');
            // $table->integer('girth');
            $table->integer('quantity')->default(1);
            $table->json('image');
            $table->float('cost')->default(0);
            $table->integer('markup')->default(0);
            $table->float('price');
            $table->float('sale')->default(0);
            $table->foreignId('category_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('gender_id')->nullable();
            $table->integer('season')->default(0);
            $table->integer('color')->nullable();
            $table->integer('parent_id')->default(0);
            $table->boolean('is_active');
            $table->timestamps();
            $table->softDeletes();
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
}
