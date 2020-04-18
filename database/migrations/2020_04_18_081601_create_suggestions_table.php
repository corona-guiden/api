<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuggestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suggestions', function (Blueprint $table) {
            $table->id();

            $table->text('question');
            $table->longText('answer');
            $table->enum('status', ['new', 'updated', 'approved']);
            $table->string('source');
            $table->string('previous_answer')->nullable();
            $table->unsignedInteger('qna_id')->nullable();
            $table->string('question_id')->unsigned();

            $table->timestamp('source_updated_at');
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
        Schema::dropIfExists('suggestions');
    }
}
