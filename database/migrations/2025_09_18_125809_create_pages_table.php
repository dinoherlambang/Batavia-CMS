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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->enum('status', ['draft', 'published', 'private'])->default('draft');
            $table->string('template')->default('default'); // Template file name
            $table->string('featured_image')->nullable();
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('parent_id')->nullable(); // For page hierarchy
            $table->integer('sort_order')->default(0);
            $table->boolean('show_in_menu')->default(true);
            $table->boolean('is_homepage')->default(false);
            $table->json('custom_fields')->nullable(); // Additional metadata
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('pages')->onDelete('cascade');
            $table->index(['status', 'published_at']);
            $table->index(['slug', 'status']);
            $table->index('parent_id');
            $table->index('show_in_menu');
            // Note: fullText index removed for SQLite compatibility
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
