<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Service pour interagir avec l'API WordPress REST
 */
class ApiService
{
    private Client $client;
    private string $baseUrl;
    private int $timeout;

    public function __construct()
    {
        $this->baseUrl = $_ENV['API_BASE_URL'] ?? 'https://api-cv.corbisier.fr/wp-json';
        $this->timeout = (int)($_ENV['API_TIMEOUT'] ?? 10);

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => $this->timeout,
            'headers' => [
                'Accept' => 'application/json',
            ]
        ]);
    }

    /**
     * Récupère un post par son ID
     *
     * @param int $postId
     * @return array|null
     */
    public function getPost(int $postId): ?array
    {
        try {
            $response = $this->client->get("wp/v2/posts/{$postId}");
            $data = json_decode($response->getBody()->getContents(), true);

            return $this->formatPost($data);
        } catch (GuzzleException $e) {
            $this->logError("Error fetching post {$postId}: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Récupère une page par son ID
     *
     * @param int $pageId
     * @return array|null
     */
    public function getPage(int $pageId): ?array
    {
        try {
            $response = $this->client->get("wp/v2/pages/{$pageId}");
            $data = json_decode($response->getBody()->getContents(), true);

            return $this->formatPost($data);
        } catch (GuzzleException $e) {
            $this->logError("Error fetching page {$pageId}: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Récupère plusieurs posts en une seule requête
     *
     * @param array $postIds
     * @return array
     */
    public function getPosts(array $postIds): array
    {
        $posts = [];

        foreach ($postIds as $postId) {
            $post = $this->getPost($postId);
            if ($post) {
                $posts[$postId] = $post;
            }
        }

        return $posts;
    }

    /**
     * Formate un post/page pour un usage plus simple
     *
     * @param array $data
     * @return array
     */
    private function formatPost(array $data): array
    {
        return [
            'id' => $data['id'] ?? 0,
            'title' => $data['title']['rendered'] ?? '',
            'content' => $data['content']['rendered'] ?? '',
            'excerpt' => $data['excerpt']['rendered'] ?? '',
            'date' => $data['date'] ?? '',
            'modified' => $data['modified'] ?? '',
            'slug' => $data['slug'] ?? '',
            'featured_media' => $data['featured_media'] ?? 0,
            'raw' => $data // Garde les données brutes si besoin
        ];
    }

    /**
     * Log une erreur
     *
     * @param string $message
     */
    private function logError(string $message): void
    {
        if (($_ENV['LOG_ENABLED'] ?? true)) {
            $logFile = __DIR__ . '/../../logs/api.log';
            $timestamp = date('Y-m-d H:i:s');
            error_log("[{$timestamp}] {$message}\n", 3, $logFile);
        }
    }
}
