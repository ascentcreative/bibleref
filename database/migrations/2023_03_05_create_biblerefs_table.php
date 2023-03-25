<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bible_refs', function (Blueprint $table) {
            $table->engine = 'MyIsam';
            $table->id();
            $table->string('biblerefable_type', 191)->index()->nullable();
            $table->integer('biblerefable_id')->index()->nullable();

            $table->string('biblerefable_key', 30)->index()->nullable();
            $table->integer('biblerefable_sort')->index()->nullable();

            $table->string('ref', 191)->nullable();
            $table->integer('book_id')->index();
            $table->integer('start_chapter')->index();
            $table->integer('start_verse')->index();
            $table->char('start_verse_suffix', 1)->index()->nullable();
            $table->integer('end_chapter')->index();
            $table->integer('end_verse')->index();
            $table->char('end_verse_suffix', 1)->index()->nullable();

            $table->string('start_key', 7)->index();
            $table->string('end_key', 7)->index();

            $table->index(['biblerefable_type', 'biblerefable_id', 'biblerefable_key'], 'biblerefable');
            $table->index(['book_id', 'start_key', 'end_key']);

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
        Schema::dropIfExists('bible_refs');
    }

};
