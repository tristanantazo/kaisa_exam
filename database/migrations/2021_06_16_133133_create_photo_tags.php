<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_tags', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('photo_id')->constrained('photos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('tags')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photo_tags');
    }
}
