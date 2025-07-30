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
        Schema::create('presence_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('presence_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->string('jabatan');
            $table->string('asal_instansi'); // ← Sudah diperbaiki penulisannya
            $table->string('tanda_tangan')->nullable(); // boleh kosong
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presence_details');
    }
};
