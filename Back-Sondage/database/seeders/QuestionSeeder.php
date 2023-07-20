<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'title' => 1,
                'body' => 'Votre adresse mail ?',
                'type' => 'B',
                'choices' => null,
            ],
            [
                'title' => 2,
                'body' => 'Votre âge ?',
                'type' => 'B',
                'choices' => null,
            ],
            [
                'title' => 3,
                'body' => 'Votre sexe ?',
                'type' => 'A',
                'choices' => ['Homme', 'Femme', 'Préfère ne pas répondre'],
            ],
            [
                'title' => 4,
                'body' => 'Nombre de personnes dans votre foyer (adulte & enfants – répondant inclus) ?',
                'type' => 'C',
                'choices' => null,
            ],
            [
                'title' => 5,
                'body' => 'Votre profession ? ',
                'type' => 'B',
                'choices' => null,
            ],
            [
                'title' => 6,
                'body' => 'Quelle marque de casque VR utilisez-vous ?',
                'type' => 'A',
                'choices' => ['Oculus Quest', 'Oculus Rift/s', 'HTC Vive,', 'Windows MixedReality', 'Valve index'],
            ],
            [
                'title' => 7,
                'body' => 'Sur quel magasin d’application achetez-vous des contenus VR ?',
                'type' => 'A',
                'choices' => ['SteamVR', 'Oculus store', 'Viveport', 'Windows store'],
            ],
            [
                'title' => 8,
                'body' => 'Quel casque envisagez-vous d’acheter dans un futur proche ?',
                'type' => 'A',
                'choices' => ['Oculus Quest', 'Oculus Go', 'HTC Vive Pro', 'PSVR', 'Autre', 'Aucun'],
            ],
            [
                'title' => 9,
                'body' => 'Au sein de votre foyer, combien de personnes utilisent votre casque VR pour regarder Bigscreen ?',
                'type' => 'C',
                'choices' => null,
            ],
            [
                'title' => 10,
                'body' => 'Vous utilisez principalement Bigscreen pour ….. ?',
                'type' => 'A',
                'choices' => ['regarder la TV en direct', 'regarder des films', 'travailler', 'jouer en solo', 'jouer en équipe'],
            ],
            [
                'title' => 11,
                'body' => 'Combien de points (de 1 à 5) donnez-vous à la qualité de l’image sur Bigscreen ?',
                'type' => 'C',
                'choices' => null,
            ],
            [
                'title' => 12,
                'body' => 'Combien de points (de 1 à 5) donnez-vous au confort d’utilisation de l’interface Bigscreen ?',
                'type' => 'C',
                'choices' => null,
            ],
            [
                'title' => 13,
                'body' => 'Combien de points (de 1 à 5) donnez-vous à la connexion réseau de Bigscreen ?',
                'type' => 'C',
                'choices' => null,
            ],
            [
                'title' => 14,
                'body' => 'Combien de points (de 1 à 5) donnez-vous à la qualité des graphismes 3D dans Bigscreen ?',
                'type' => 'C',
                'choices' => null,
            ],
            [
                'title' => 15,
                'body' => 'Combien de points (de 1 à 5) donnez-vous à la qualité audio dans Bigscreen ?',
                'type' => 'C',
                'choices' => null,
            ],
            [
                'title' => 16,
                'body' => 'Aimeriez-vous avoir des notifications plus précises au cours de vos sessions Bigscreen ?',
                'type' => 'A',
                'choices' => ['Oui', 'Non'],
            ],
            [
                'title' => 17,
                'body' => 'Aimeriez-vous pouvoir inviter un ami à rejoindre votre session via son smartphone ?',
                'type' => 'A',
                'choices' => ['Oui', 'Non'],
            ],
            [
                'title' => 18,
                'body' => 'Aimeriez-vous pouvoir enregistrer des émissions TV pour pouvoir les regarder ultérieurement ?',
                'type' => 'A',
                'choices' => ['Oui', 'Non'],
            ],
            [
                'title' => 19,
                'body' => 'Aimeriez-vous jouer à des jeux exclusifs sur votre Bigscreen ?',
                'type' => 'A',
                'choices' => ['Oui', 'Non'],
            ],
            [
                'title' => 20,
                'body' => 'Selon vous, quelle nouvelle fonctionnalité devrait exister sur Bigscreen ?',
                'type' => 'B',
                'choices' => null,
            ],
        ];

        foreach ($questions as $questionData) {
            $question = Question::create([
                'title' => $questionData['title'],
                'body' => $questionData['body'],
                'type' => $questionData['type'],
                'choices' => $questionData['choices'],
            ]);
        }

    }
}
