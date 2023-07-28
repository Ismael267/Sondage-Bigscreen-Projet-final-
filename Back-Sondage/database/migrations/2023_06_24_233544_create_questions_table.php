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
        // Crée la table "questions" dans la base de données
        Schema::create('questions', function (Blueprint $table) {
            // Identifiant unique auto-incrémenté pour chaque enregistrement
            $table->id();
            // Titre de la question (chaîne de caractères)
            $table->string('title');
            // Corps ou contenu de la question (texte)
            $table->text('body');
            // Type de la question : 'A', 'B' ou 'C' (énumération)
            $table->enum('type',['A','B','C']);
            // Choix possibles pour la question, stockés en format JSON (peut être nul)
            $table->json('choices')->nullable();
            // Colonnes de date de création (created_at) et de date de mise à jour (updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Supprime la table "questions" de la base de données si elle existe
        Schema::dropIfExists('questions');
    }
};
