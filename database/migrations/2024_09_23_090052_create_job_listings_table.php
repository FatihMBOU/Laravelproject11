<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('job_listings', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('employer_id')->nullable(); // Voeg de kolom toe
        //$table->foreignId('employer_id')->constrained()->onDelete('cascade'); // Zorg ervoor dat dit maar één keer voorkomt
        $table->string('title');
        $table->string('salary');
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
        Schema::dropIfExists('job_listings');
    }
}
