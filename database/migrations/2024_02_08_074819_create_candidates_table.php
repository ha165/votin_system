<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('election_id');
            $table->unsignedBigInteger('position_id');
            $table->unsignedBigInteger('party_id');
            $table->string('name');
            $table->string('student_id');
            $table->string('course');
            $table->text('manifesto')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
            $table->foreign('election_id')->references('id')->on('elections')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('party_id')->references('id')->on('parties')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
