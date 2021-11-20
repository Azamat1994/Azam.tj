<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrudeSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crude_sizes', function (Blueprint $table) {
            $table->foreignId('crude_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('size');
            $table->integer('quantity');
            $table->timestamps();

            $table->unique(['crude_id', 'size']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crude_sizes');
    }
}
