<?php
/**
 * Layout de base
 *
 * Variables disponibles:
 * - $title: Titre de la page
 * - $content: Contenu de la page
 */

use App\Utils\Helpers;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="CV d'Eric Corbisier - Développeur Web">
    <meta name="author" content="Eric Corbisier">

    <title><?= Helpers::e($title ?? 'CV - Eric Corbisier') ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= Helpers::asset('images/favicon/favicon.png') ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="<?= Helpers::asset('css/app.css') ?>">
</head>
<body class="min-h-screen">
    <!-- Loader -->
    <div id="loader" class="fixed inset-0 bg-white bg-opacity-90 flex items-center justify-center z-50 hidden">
        <div class="loader"></div>
    </div>

    <!-- Header -->
    <?php require_once __DIR__ . '/header.php'; ?>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <?= $content ?? '' ?>
    </main>

    <!-- Footer -->
    <?php require_once __DIR__ . '/footer.php'; ?>

    <!-- Scripts -->
    <script src="<?= Helpers::asset('js/app.js') ?>" type="module"></script>
</body>
</html>
