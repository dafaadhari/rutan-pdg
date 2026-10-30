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
        Schema::create('halamans', function (Blueprint $table) {
            $table->id();
            $table->string('kategori', 30);
            $table->string('slug');
            $table->string('judul');
            $table->string('ringkasan')->nullable();
            $table->string('ikon', 30)->nullable();
            $table->string('grup', 50)->nullable();
            $table->longText('konten');
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->boolean('tampil_di_beranda')->default(false);
            $table->enum('status', ['draft', 'publikasi'])->default('publikasi');
            $table->timestamps();

            $table->unique(['kategori', 'slug']);
            $table->index(['kategori', 'status', 'urutan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('halamans');
    }
};
