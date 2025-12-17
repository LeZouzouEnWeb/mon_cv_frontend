<?php

namespace App\Controllers;

use App\Services\ApiService;
use App\Services\CacheService;

/**
 * Contrôleur pour la page CV
 */
class CvController
{
    private ApiService $apiService;
    private CacheService $cacheService;

    // IDs des posts WordPress
    private const POST_IDS = [
        'experience' => 128,
        'formations' => 153,
        'expertise' => 126,
        'polyvalence' => 121,
        'soft_skills' => 130,
    ];

    private const PAGE_HOME_ID = 181;

    public function __construct()
    {
        $this->apiService = new ApiService();
        $this->cacheService = new CacheService();
    }

    /**
     * Affiche la page CV
     */
    public function index(): void
    {
        // Récupérer les données
        $cvData = $this->getCvData();
        $homeData = $this->getHomeData();

        // Passer les données à la vue
        require_once __DIR__ . '/../Views/pages/cv.php';
    }

    /**
     * Récupère les données du CV depuis l'API ou le cache
     *
     * @return array
     */
    private function getCvData(): array
    {
        return $this->cacheService->remember('cv_data', function () {
            $data = [];

            foreach (self::POST_IDS as $key => $postId) {
                $post = $this->apiService->getPost($postId);
                if ($post) {
                    $data[$key] = $post;
                }
            }

            return $data;
        }, 3600); // Cache pendant 1 heure
    }

    /**
     * Récupère les données de la page d'accueil
     *
     * @return array|null
     */
    private function getHomeData(): ?array
    {
        return $this->cacheService->remember('home_data', function () {
            return $this->apiService->getPage(self::PAGE_HOME_ID);
        }, 3600);
    }

    /**
     * Endpoint AJAX pour charger un onglet spécifique
     */
    public function loadTab(): void
    {
        header('Content-Type: application/json');

        $tabId = $_GET['tab'] ?? '';

        if (!array_key_exists($tabId, self::POST_IDS)) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid tab ID']);
            return;
        }

        $postId = self::POST_IDS[$tabId];

        $data = $this->cacheService->remember("tab_{$tabId}", function () use ($postId) {
            return $this->apiService->getPost($postId);
        }, 3600);

        if ($data) {
            echo json_encode([
                'success' => true,
                'data' => $data
            ]);
        } else {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'error' => 'Failed to load data'
            ]);
        }
    }
}
