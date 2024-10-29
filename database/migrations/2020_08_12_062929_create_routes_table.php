<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('api_id');
            $table->string('route');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->index('route');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes');
    }
}
