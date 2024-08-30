<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('varos', function (Blueprint $table) {
            $table->id();
            $table->string('nev');
            $table->unsignedBigInteger('megye_id');
            $table->foreign('megye_id')->references('id')->on('megyes')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
        public function down(): void
        {
            Schema::table('varos', function (Blueprint $table) {
                $table->dropForeign(['megye_id']);
                $table->dropColumn('megye_id');
                $table->dropSoftDeletes();
            });

            Schema::dropIfExists('varos');
        }
};
