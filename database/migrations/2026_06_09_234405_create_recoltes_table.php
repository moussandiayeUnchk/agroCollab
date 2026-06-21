<?php

use App\Models\User;
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
        Schema::create('recoltes', function (Blueprint $table) {
            $table->id();
            $table->string("produit"); // Ex: Mil, Arachide, Maïs (le produit précis)
            $table->decimal('quantity', 8, 2);
            $table->date('date_depot');
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            // Le lien vers la catégorie
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recoltes');
    }
};
