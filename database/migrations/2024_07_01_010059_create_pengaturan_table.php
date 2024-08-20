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
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('slug')->unique();
            $table->string('nama_web');
            $table->string('telp');
            $table->string('email');
            $table->string('jam_kerja');
            $table->text('alamat');
            $table->text('deskripsi');
            $table->string('logo');
            $table->string('favicon');
            $table->string('banner');
            $table->string('background');
            $table->string('ig')->nullable();
            $table->text('map');
            $table->string('akreditas');
            $table->string('youtube')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan');
    }
};
