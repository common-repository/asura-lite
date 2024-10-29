<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('apis', function (Blueprint $table) {
            $table->id();
            $table->string('label')->nullable();
            $table->string('key');
            $table->string('secret');
            $table->set('permission', ['global', 'custom']);
            $table->boolean('status')->default(false);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->index(['key', 'secret']);
            $table->unique(['key', 'secret']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apis');
    }
}
