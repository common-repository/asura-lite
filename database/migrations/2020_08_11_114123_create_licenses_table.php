<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('hash');
            $table->string('tail');
            $table->boolean('status')->default(true);
            $table->string('source')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedInteger('max_activated')->nullable();
            $table->timestamp('expire_at')->nullable();
            $table->timestamps();
            
            $table->index('key');
            $table->index('hash');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('licenses');
    }
}
