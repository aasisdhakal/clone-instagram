<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Taggables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('taggables', function (Blueprint $table) {
		    $table->integer('tag_id');
		    $table->integer('taggable_id'); // for storing Post ID's
		    $table->string('taggable_type'); // Aside from Post, if you decide to use tags on other model eg. Videos, ...
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
