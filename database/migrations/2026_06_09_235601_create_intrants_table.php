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
        Schema::create('intrants', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string("categorie");
            // Quantité enregistrée lors de la toute première création
            $table->decimal('stock_initial', 8, 2)->default(0.00);
            // Quantité qui évolue au fil des réapprovisionnements et des distributions
            $table->decimal("quantiteDisponible",8,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intrants');
    }
};
