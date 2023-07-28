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
        // Crée la table "answers" dans la base de données
        Schema::create('answers', function (Blueprint $table) {
            // Identifiant unique auto-incrémenté pour chaque enregistrement
            $table->id();
            // Réponse à la question (chaîne de caractères)
            $table->string("answer");
            // Clé étrangère pour lier la réponse à une question spécifique (avec l'option de suppression en cascade)
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
            // Clé étrangère pour lier la réponse à un token d'enquête spécifique (avec l'option de suppression en cascade)
            $table->foreignId('survey_token_id')->constrained('survey_tokens')->onDelete('cascade');
            // Colonnes de date de création (created_at) et de date de mise à jour (updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Supprime la table "answers" de la base de données si elle existe
        Schema::dropIfExists('answers');
    }
};
