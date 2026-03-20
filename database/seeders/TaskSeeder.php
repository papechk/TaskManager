<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = [
            [
                'tetitle' => 'Configurer le serveur de production',
                'tedescription' => 'Mettre en place le serveur Nginx avec SSL et configurer les variables d\'environnement pour le déploiement.',
                'testart_date' => '2026-03-01',
                'tedue_date' => '2026-03-10',
                'testart_time' => '09:00',
                'teend_time' => '17:00',
                'testatus' => 'terminée',
                'tepriority' => 'haute',
                'teuser_created_by' => 1,
                'teuser_assigned_to' => 1,
            ],
            [
                'tetitle' => 'Créer la maquette du dashboard',
                'tedescription' => 'Réaliser la maquette Figma du nouveau tableau de bord avec les graphiques de statistiques.',
                'testart_date' => '2026-03-05',
                'tedue_date' => '2026-03-15',
                'testart_time' => '10:00',
                'teend_time' => '18:00',
                'testatus' => 'en cours',
                'tepriority' => 'moyenne',
                'teuser_created_by' => 1,
                'teuser_assigned_to' => 2,
            ],
            [
                'tetitle' => 'Rédiger la documentation API',
                'tedescription' => 'Documenter tous les endpoints REST API avec Swagger/OpenAPI et ajouter des exemples de requêtes.',
                'testart_date' => '2026-03-10',
                'tedue_date' => '2026-03-20',
                'testart_time' => '08:30',
                'teend_time' => '16:30',
                'testatus' => 'en cours',
                'tepriority' => 'haute',
                'teuser_created_by' => 2,
                'teuser_assigned_to' => 3,
            ],
            [
                'tetitle' => 'Corriger le bug d\'authentification',
                'tedescription' => 'Le token JWT expire prématurément après 10 minutes au lieu de 60. Vérifier la configuration dans auth.php.',
                'testart_date' => '2026-03-12',
                'tedue_date' => '2026-03-13',
                'testart_time' => '09:00',
                'teend_time' => '12:00',
                'testatus' => 'terminée',
                'tepriority' => 'urgente',
                'teuser_created_by' => 1,
                'teuser_assigned_to' => 1,
            ],
            [
                'tetitle' => 'Optimiser les requêtes SQL',
                'tedescription' => 'Analyser les requêtes N+1 dans le module de reporting et ajouter le eager loading approprié.',
                'testart_date' => '2026-03-14',
                'tedue_date' => '2026-03-18',
                'testart_time' => '09:00',
                'teend_time' => '17:00',
                'testatus' => 'à faire',
                'tepriority' => 'moyenne',
                'teuser_created_by' => 2,
                'teuser_assigned_to' => 1,
            ],
            [
                'tetitle' => 'Mettre à jour les dépendances npm',
                'tedescription' => 'Passer à Vite 5 et mettre à jour toutes les dépendances front-end. Tester la compatibilité.',
                'testart_date' => '2026-03-15',
                'tedue_date' => '2026-03-22',
                'testart_time' => '14:00',
                'teend_time' => '18:00',
                'testatus' => 'à faire',
                'tepriority' => 'basse',
                'teuser_created_by' => 1,
                'teuser_assigned_to' => 3,
            ],
            [
                'tetitle' => 'Ajouter les notifications par email',
                'tedescription' => 'Implémenter l\'envoi d\'emails automatiques quand une tâche est assignée ou quand la deadline approche.',
                'testart_date' => '2026-03-18',
                'tedue_date' => '2026-03-25',
                'testart_time' => '09:00',
                'teend_time' => '17:00',
                'testatus' => 'à faire',
                'tepriority' => 'haute',
                'teuser_created_by' => 2,
                'teuser_assigned_to' => 2,
            ],
            [
                'tetitle' => 'Tests unitaires module utilisateurs',
                'tedescription' => 'Écrire les tests PHPUnit pour les contrôleurs UserController et AuthController. Couvrir les cas limites.',
                'testart_date' => '2026-03-08',
                'tedue_date' => '2026-03-12',
                'testart_time' => '10:00',
                'teend_time' => '16:00',
                'testatus' => 'terminée',
                'tepriority' => 'moyenne',
                'teuser_created_by' => 1,
                'teuser_assigned_to' => 3,
            ],
            [
                'tetitle' => 'Intégration Stripe pour les paiements',
                'tedescription' => 'Intégrer l\'API Stripe pour permettre les abonnements premium. Configurer les webhooks de confirmation.',
                'testart_date' => '2026-03-20',
                'tedue_date' => '2026-04-05',
                'testart_time' => '09:00',
                'teend_time' => '18:00',
                'testatus' => 'à faire',
                'tepriority' => 'haute',
                'teuser_created_by' => 1,
                'teuser_assigned_to' => 2,
            ],
            [
                'tetitle' => 'Revue de code sprint 3',
                'tedescription' => 'Passer en revue toutes les pull requests du sprint 3 et valider avant le merge dans main.',
                'testart_date' => '2026-03-19',
                'tedue_date' => '2026-03-19',
                'testart_time' => '14:00',
                'teend_time' => '17:00',
                'testatus' => 'en cours',
                'tepriority' => 'moyenne',
                'teuser_created_by' => 2,
                'teuser_assigned_to' => 1,
            ],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
