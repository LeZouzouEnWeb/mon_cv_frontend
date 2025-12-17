<?php

namespace App\Utils;

/**
 * Fonctions utilitaires
 */
class Helpers
{
    /**
     * Échappe et affiche du texte HTML
     *
     * @param string $text
     * @return string
     */
    public static function e(string $text): string
    {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Génère une URL
     *
     * @param string $path
     * @param array $params
     * @return string
     */
    public static function url(string $path = '', array $params = []): string
    {
        $url = rtrim($_ENV['APP_URL'] ?? '', '/') . '/' . ltrim($path, '/');

        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }

        return $url;
    }

    /**
     * Génère une URL d'asset
     *
     * @param string $path
     * @return string
     */
    public static function asset(string $path): string
    {
        return '/assets/' . ltrim($path, '/');
    }

    /**
     * Vérifie si on est en mode debug
     *
     * @return bool
     */
    public static function isDebug(): bool
    {
        return filter_var($_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Formatte une date
     *
     * @param string $date
     * @param string $format
     * @return string
     */
    public static function formatDate(string $date, string $format = 'd/m/Y'): string
    {
        $timestamp = strtotime($date);
        return $timestamp ? date($format, $timestamp) : $date;
    }

    /**
     * Tronque un texte
     *
     * @param string $text
     * @param int $length
     * @param string $suffix
     * @return string
     */
    public static function truncate(string $text, int $length = 100, string $suffix = '...'): string
    {
        $text = strip_tags($text);

        if (mb_strlen($text) <= $length) {
            return $text;
        }

        return mb_substr($text, 0, $length) . $suffix;
    }

    /**
     * Dump et die (pour debug)
     *
     * @param mixed ...$vars
     */
    public static function dd(...$vars): void
    {
        echo '<pre>';
        foreach ($vars as $var) {
            var_dump($var);
        }
        echo '</pre>';
        die();
    }

    /**
     * Log un message
     *
     * @param string $message
     * @param string $level
     */
    public static function log(string $message, string $level = 'info'): void
    {
        if (!($_ENV['LOG_ENABLED'] ?? true)) {
            return;
        }

        $logFile = __DIR__ . '/../../logs/app.log';
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "[{$timestamp}] [{$level}] {$message}\n";

        error_log($logMessage, 3, $logFile);
    }
}