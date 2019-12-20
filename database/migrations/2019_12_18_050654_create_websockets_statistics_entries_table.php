<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * The web socket stats.
 */
class CreateWebSocketsStatisticsEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void Returns nothing.
     */
    public function up()
    {
        Schema::create('websockets_statistics_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('app_id');
            $table->integer('peak_connection_count');
            $table->integer('websocket_message_count');
            $table->integer('api_message_count');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void Returns nothing.
     */
    public function down()
    {
        Schema::dropIfExists('websockets_statistics_entries');
    }
}
