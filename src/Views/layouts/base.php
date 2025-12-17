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

    <!-- Modal Contact -->
    <div id="contact-modal" class="modal hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Overlay -->
            <div class="modal-overlay fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- Modal Content -->
            <div class="modal-content inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-primary-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-envelope text-primary-600 text-xl"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left flex-1">
                            <h3 class="text-lg leading-6 font-heading font-bold text-gray-900" id="modal-title">
                                Me Contacter
                            </h3>
                            <div class="mt-4">
                                <form id="contact-form" class="space-y-4">
                                    <div>
                                        <label for="contact-name" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                                        <input type="text" id="contact-name" name="name" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500">
                                    </div>
                                    <div>
                                        <label for="contact-email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                        <input type="email" id="contact-email" name="email" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500">
                                    </div>
                                    <div>
                                        <label for="contact-message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                                        <textarea id="contact-message" name="message" rows="4" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"></textarea>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-3 -mx-4 -mb-4">
                                        <button type="submit" class="btn btn-primary w-full sm:w-auto">
                                            <i class="fas fa-paper-plane"></i>
                                            Envoyer
                                        </button>
                                        <button type="button" id="contact-modal-close" class="btn btn-outline w-full sm:w-auto mt-3 sm:mt-0">
                                            Annuler
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?= Helpers::asset('js/app.js') ?>" type="module"></script>
</body>

</html>