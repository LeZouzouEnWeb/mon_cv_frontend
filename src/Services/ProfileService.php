<?php

namespace App\Services;

/**
 * Service pour récupérer les informations de profil
 * Peut être étendu pour récupérer depuis l'API ACF ou autre
 */
class ProfileService
{
    private ApiService $apiService;
    private CacheService $cacheService;

    public function __construct(ApiService $apiService, CacheService $cacheService)
    {
        $this->apiService = $apiService;
        $this->cacheService = $cacheService;
    }

    /**
     * Récupère les informations de profil
     *
     * @return array
     */
    public function getProfile(): array
    {
        return $this->cacheService->remember('profile_data', function () {
            // Récupérer depuis la page d'accueil (ID 181)
            $homePage = $this->apiService->getPage(181);

            // Pour l'instant, retourner des données par défaut
            // TODO: Utiliser ACF (Advanced Custom Fields) si disponible
            return [
                'name' => 'Eric Corbisier',
                'job_title' => 'Développeur Web Full Stack',
                'description' => "Fort de 30 ans de passion dans le développement, je souhaite en faire mon métier",
                'photo_url' => 'https://corbisier.fr/_fonc/_img/photo_cv.jpg',
                'email' => 'emploi@corbisier.fr',
                'phone' => '0650469120',
                'websites' => [
                    ['url' => 'https://lescorbycats.fr', 'name' => 'lescorbycats.fr'],
                    ['url' => 'https://corbisier.fr', 'name' => 'corbisier.fr'],
                ],
                'misc' => 'Permis B',
                'formation' => 'Bac Pro Équipement Installation Électrique, 1997, Aubergenville',

                // Données de la page d'accueil si disponibles
                'home_title' => $homePage['title'] ?? '',
                'home_content' => $homePage['content'] ?? '',
                'home_excerpt' => $homePage['excerpt'] ?? '',
            ];
        }, 3600);
    }

    /**
     * Récupère l'URL de la photo de profil
     *
     * @return string
     */
    public function getPhotoUrl(): string
    {
        $profile = $this->getProfile();
        return $profile['photo_url'] ?? '/assets/images/photo/default.jpg';
    }

    /**
     * Récupère le nom complet
     *
     * @return string
     */
    public function getName(): string
    {
        $profile = $this->getProfile();
        return $profile['name'] ?? 'Eric Corbisier';
    }

    /**
     * Récupère le titre du poste
     *
     * @return string
     */
    public function getJobTitle(): string
    {
        $profile = $this->getProfile();
        return $profile['job_title'] ?? 'Développeur Web';
    }
}
