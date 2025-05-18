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
        Schema::create('category_content', function (Blueprint $table) {
            $table->uuid('content_id');
            $table->uuid('category_id');

            // Foreign key constraints (pastikan tabel utama pakai uuid)
            $table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            // Komposit primary key
            $table->primary(['content_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_content');
    }
};
