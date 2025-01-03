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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ranking_application_id'); // Add this line for the relationship
            $table->string('category')->nullable();
            $table->string('type');
            $table->string('name');
            $table->string('title');
            $table->string('organization')->nullable();
            $table->string('designation')->nullable();
            $table->float('days')->nullable();
            $table->string('date');
            $table->text('raw_text');
            $table->string('image_path')->nullable(); // Add image path column
            $table->float('points')->nullable();
            $table->timestamps();

            // Define the relationship
            $table->foreign('ranking_application_id')->references('id')->on('ranking_applications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
