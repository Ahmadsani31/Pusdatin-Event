<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_event', function (Blueprint $table) {
            $table->id();
            $table->string('nama_event')->nullable();
            $table->date('jadwal_pelaksanaan_mulai')->nullable();
            $table->date('jadwal_pelaksanaan_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_event');
    }
}
