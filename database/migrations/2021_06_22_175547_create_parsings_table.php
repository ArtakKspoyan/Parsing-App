<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParsingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parsings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('link');
            $table->text('description');
            $table->json('author')->nullable();
            $table->string('pubDate');
            $table->json('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parsings');
    }
}
