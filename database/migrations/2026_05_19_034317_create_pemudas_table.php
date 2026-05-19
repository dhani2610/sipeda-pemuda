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
        Schema::create('pemudas', function (Blueprint $table) {
            $table->id();
            $table->string('registration_type');
            $table->string('full_name_reg');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('religion');
            $table->integer('age')->nullable();
            $table->string('email');
            $table->text('address');
            $table->string('social_media')->nullable();

            // Kolom Berkas
            $table->string('photo')->nullable();
            $table->string('document_ktp')->nullable();
            $table->string('doc_ijazah')->nullable();
            $table->string('doc_sehat')->nullable();
            $table->string('doc_narkoba')->nullable();
            $table->string('doc_skck')->nullable();
            $table->string('doc_bpjs')->nullable();
            $table->string('doc_toefl')->nullable();
            $table->string('doc_rekomendasi')->nullable();
            $table->string('doc_karya_nyata')->nullable();
            $table->string('doc_rekomendasi_kab')->nullable();
            $table->string('doc_aktif_pendidikan')->nullable();
            $table->string('doc_izin_ortu')->nullable();
            $table->string('doc_nib')->nullable();
            $table->string('doc_omset')->nullable();
            $table->string('doc_tempat_usaha')->nullable();
            $table->enum('status', ['PENDING', 'APPROVE', 'REJECT'])->default('PENDING');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemudas');
    }
};
