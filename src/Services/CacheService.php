<?php

namespace App\Services;

/**
 * Service de gestion du cache
 */
class CacheService
{
    private string $cacheDir;
    private bool $enabled;
    private int $duration;

    public function __construct()
    {
        $this->cacheDir = __DIR__ . '/../../cache';
        $this->enabled = filter_var($_ENV['CACHE_ENABLED'] ?? true, FILTER_VALIDATE_BOOLEAN);
        $this->duration = (int)($_ENV['CACHE_DURATION'] ?? 3600);

        // Créer le dossier cache s'il n'existe pas
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0755, true);
        }
    }

    /**
     * Récupère une valeur du cache
     *
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key)
    {
        if (!$this->enabled) {
            return null;
        }

        $filename = $this->getCacheFilename($key);

        if (!file_exists($filename)) {
            return null;
        }

        $data = unserialize(file_get_contents($filename));

        // Vérifier l'expiration
        if ($data['expires'] < time()) {
            unlink($filename);
            return null;
        }

        return $data['value'];
    }

    /**
     * Stocke une valeur dans le cache
     *
     * @param string $key
     * @param mixed $value
     * @param int|null $duration Durée en secondes (null = utiliser la durée par défaut)
     * @return bool
     */
    public function set(string $key, $value, ?int $duration = null): bool
    {
        if (!$this->enabled) {
            return false;
        }

        $duration = $duration ?? $this->duration;
        $filename = $this->getCacheFilename($key);

        $data = [
            'value' => $value,
            'expires' => time() + $duration,
            'created' => time()
        ];

        return file_put_contents($filename, serialize($data)) !== false;
    }

    /**
     * Supprime une valeur du cache
     *
     * @param string $key
     * @return bool
     */
    public function delete(string $key): bool
    {
        $filename = $this->getCacheFilename($key);

        if (file_exists($filename)) {
            return unlink($filename);
        }

        return false;
    }

    /**
     * Vide tout le cache
     *
     * @return bool
     */
    public function clear(): bool
    {
        $files = glob($this->cacheDir . '/*.cache');

        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }

        return true;
    }

    /**
     * Récupère une valeur avec callback si elle n'existe pas
     *
     * @param string $key
     * @param callable $callback
     * @param int|null $duration
     * @return mixed
     */
    public function remember(string $key, callable $callback, ?int $duration = null)
    {
        $value = $this->get($key);

        if ($value !== null) {
            return $value;
        }

        $value = $callback();
        $this->set($key, $value, $duration);

        return $value;
    }

    /**
     * Génère le nom de fichier pour une clé
     *
     * @param string $key
     * @return string
     */
    private function getCacheFilename(string $key): string
    {
        $hash = md5($key);
        return $this->cacheDir . '/' . $hash . '.cache';
    }
}
