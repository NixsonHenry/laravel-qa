<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique(); 
            $table->text('body');
            $table->unsignedInteger('views')->default(0); // Record how many times the question is viewed?
            $table->unsignedInteger('answers')->default(0); // How many answers the question has?
            $table->integer('votes')->default(0); // How many people are faulting a question?
            $table->unsignedInteger('best_answer_id')->nullable(); // We need to record the accepted or this answer id (a question could have no answer or has answer but none of them is accepted by the created of the question)
            $table->timestamps();

            // $table->unsignedInteger('user_id'); // Keep track of the user that created the question
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
