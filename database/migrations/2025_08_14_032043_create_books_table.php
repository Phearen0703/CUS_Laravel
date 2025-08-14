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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('ebook')->nullable();
            $table->string('title');
            $table->string('author');
            $table->string('publisher');
            $table->date('published_date')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('pdf')->nullable();

            // Foreign keys
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categorys')->onDelete('set null');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');

            // Unique constraints
            $table->unique(['code', 'title'], 'unique_book_code_title');

            // Soft deletes & timestamps
            $table->softDeletes(); // Adds deleted_at
            $table->timestamps();

            // Indexes
            $table->index(['created_by', 'updated_by', 'deleted_by'], 'idx_books_user_actions');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
