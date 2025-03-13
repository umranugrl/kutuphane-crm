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
        Schema::create('readers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id'); // Kullanıcıyı ekleyen kişi
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('reader_full_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('readers', function (Blueprint $table) {
            //
        });
    }
};
