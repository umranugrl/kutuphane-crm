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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id'); // Kategoriyi ekleyen kullanıcı
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('category_name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'passive'])->default('active'); // 1-0 yerine net değerler
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
