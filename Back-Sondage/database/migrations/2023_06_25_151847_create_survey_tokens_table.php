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
        // Crée la table "survey_tokens" dans la base de données
        Schema::create('survey_tokens', function (Blueprint $table) {
            // Identifiant unique auto-incrémenté pour chaque enregistrement
            $table->id();
            // Token unique pour les enquêtes, utilisé pour regrouper les réponses
            $table->string('token')->unique();
            // Colonnes de date de création (created_at) et de date de mise à jour (updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Supprime la table "survey_tokens" de la base de données si elle existe
        Schema::dropIfExists('survey_tokens');
    }
};
