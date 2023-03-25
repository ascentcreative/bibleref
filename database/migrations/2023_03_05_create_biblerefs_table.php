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
            $table->id();
            $table->string('biblerefable_type')->index()->nullable();
            $table->integer('biblerefable_id')->index()->nullable();

            $table->string('biblerefable_key')->index()->nullable();
            $table->string('biblerefable_sort')->index()->nullable();

            $table->string('ref')->nullable();
            $table->integer('book_id')->index();
            $table->integer('start_chapter')->index();
            $table->integer('start_verse')->index();
            $table->char('start_verse_suffix')->index()->nullable();
            $table->integer('end_chapter')->index();
            $table->integer('end_verse')->index();
            $table->char('end_verse_suffix')->index()->nullable();

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
