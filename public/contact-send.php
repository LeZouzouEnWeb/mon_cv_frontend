<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\ContactController;
use Dotenv\Dotenv;

// Charger les variables d'environnement
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Gérer la requête de contact
$controller = new ContactController();
$controller->send();
