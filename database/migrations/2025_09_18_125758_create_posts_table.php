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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->enum('status', ['draft', 'published', 'scheduled', 'private'])->default('draft');
            $table->enum('post_type', ['post', 'article', 'news'])->default('post');
            $table->string('featured_image')->nullable();
            $table->json('gallery')->nullable(); // Array of image URLs
            $table->unsignedBigInteger('author_id');
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('allow_comments')->default(true);
            $table->integer('views_count')->default(0);
            $table->integer('reading_time')->nullable(); // in minutes
            $table->json('custom_fields')->nullable(); // Additional metadata
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['status', 'published_at']);
            $table->index(['slug', 'status']);
            $table->index('author_id');
            $table->index('is_featured');
            // Note: fullText index removed for SQLite compatibility
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
