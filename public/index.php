<?php
/**
 * Point d'entrée principal de l'application
 */

// Chargement de l'autoloader Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Chargement des variables d'environnement
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Démarrage de la session
session_name($_ENV['SESSION_NAME'] ?? 'cv_session');
session_start();

// Gestion des erreurs en mode debug
if (filter_var($_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOLEAN)) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
}

// Routing simple
$action = $_GET['action'] ?? 'index';

use App\Controllers\CvController;

$controller = new CvController();

switch ($action) {
    case 'load-tab':
        // Endpoint AJAX pour charger un onglet
        $controller->loadTab();
        break;

    case 'index':
    default:
        // Page principale
        $controller->index();
        break;
}
