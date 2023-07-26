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
        Schema::create('paintings', function (Blueprint $table) {
            $table->id();
            $table->string('name_ua');
            $table->integer('price')->nullable();
            $table->text('description_ua');
            $table->integer('width');
            $table->integer('height');
            $table->integer('long');
            $table->boolean('sold_status');
            $table->integer('category_id');
            $table->index(['name_ua']);
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
        Schema::dropIfExists('paintings');
    }
};
