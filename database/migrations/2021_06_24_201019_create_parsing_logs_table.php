<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParsingLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parsing_logs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('request_method');
            $table->string('request_url');
            $table->string('response_http_code');
            $table->json('response_body');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parsing_logs');
    }
}
