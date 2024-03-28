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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voter_id')->constrained('users')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('election_id')->constrained('elections')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('position_id')->constrained('positions')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('candidate_id')->constrained('candidates')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('parties_id')->constrained('parties')->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
