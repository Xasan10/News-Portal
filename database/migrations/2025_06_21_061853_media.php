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
        // Schema::create('media',function(Blueprint $table){

        //     $table->id();
        //     $table->foreignId('article_id')->constrained()->onDelete('cascade');
        //     $table->string('media_url'); // Can be a YouTube URL or local path
        //     $table->enum('file_type', ['image', 'video', 'document', 'external'])->default('external');
        //     $table->string('caption')->nullable();
        //     $table->timestamps();


        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
