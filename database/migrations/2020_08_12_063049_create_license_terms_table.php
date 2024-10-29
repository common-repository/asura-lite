<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenseTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('license_terms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('license_id');
            $table->unsignedBigInteger('term_id');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->unique(['license_id', 'term_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('license_terms');
    }
}
