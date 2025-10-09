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
    Schema::create('productos', function (Blueprint $table) {
        $table->id();
        $table->string('Referencia', 100);
        $table->decimal('Gramos', 38, 2)->nullable();
        $table->string('Tamano', 50)->nullable();
        $table->string('Color', 50)->nullable();
        $table->decimal('PrecioUnitario', 38, 2);
        $table->integer('CantidadStock')->default(0);
        $table->string('Estado', 50)->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
