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
        Schema::create('mangos', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('name');
            $table->date('buy_date');
            $table->unsignedBigInteger('source_area_id');
            $table->double('total_kg');
            $table->double('buying_price')->default(0);
            $table->double('selling_price')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }







    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mangos');
    }
};
