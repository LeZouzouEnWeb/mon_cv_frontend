<?php

/**
 * Page CV
 *
 * Variables disponibles:
 * - $cvData: Données du CV (experience, formations, expertise, etc.)
 * - $homeData: Données de la page d'accueil
 */

use App\Utils\Helpers;

ob_start();
?>

<div class="max-w-7xl mx-auto">
    <!-- Hero Section / Profil -->
    <section id="cv" class="bg-white rounded-lg shadow-lg overflow-hidden mb-8 animate-slide-up">
        <div class="md:flex">
            <!-- Photo -->
            <div class="md:w-1/3 lg:w-1/4 bg-gradient-to-br from-gray-100 to-gray-200">
                <img src="<?= Helpers::asset('images/photo/photo-cv.jpg') ?>" alt="Eric Corbisier"
                    class="w-full h-full object-cover" loading="eager">
            </div>

            <!-- Informations -->
            <div class="md:w-2/3 lg:w-3/4 p-6 lg:p-8">
                <h1 class="font-heading font-bold text-4xl mb-2">Eric Corbisier</h1>
                <p class="text-xl text-primary-600 mb-4">Développeur Web Full Stack</p>

                <?php if (!empty($homeData['excerpt'])): ?>
                    <div class="text-gray-600 mb-6">
                        <?= $homeData['excerpt'] ?>
                    </div>
                <?php endif; ?>

                <!-- Contact & Liens -->
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <h3 class="font-semibold text-sm text-gray-500 mb-2">Contact</h3>
                        <ul class="space-y-2">
                            <li class="flex items-center gap-2 text-gray-700">
                                <i class="fas fa-envelope text-primary-600"></i>
                                <a href="mailto:emploi@corbisier.fr" class="hover:text-primary-600">
                                    emploi@corbisier.fr
                                </a>
                            </li>
                            <li class="flex items-center gap-2 text-gray-700">
                                <i class="fas fa-phone text-primary-600"></i>
                                <span>+33 X XX XX XX XX</span>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="font-semibold text-sm text-gray-500 mb-2">Sites Web</h3>
                        <ul class="space-y-2">
                            <li class="flex items-center gap-2">
                                <i class="fab fa-github text-primary-600"></i>
                                <a href="https://github.com/LeZouzouEnWeb" target="_blank" rel="noopener noreferrer"
                                    class="text-gray-700 hover:text-primary-600">
                                    GitHub
                                </a>
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="fas fa-globe text-primary-600"></i>
                                <a href="https://api-cv.corbisier.fr" target="_blank" rel="noopener noreferrer"
                                    class="text-gray-700 hover:text-primary-600">
                                    Site Web
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tabs -->
    <div data-tabs-container class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Tab Headers -->
        <div class="border-b border-gray-200 overflow-x-auto">
            <nav class="flex -mb-px">
                <button data-tab="experience" class="tab tab-active whitespace-nowrap">
                    <i class="fas fa-briefcase"></i>
                    Expérience
                </button>
                <button data-tab="formations" class="tab whitespace-nowrap">
                    <i class="fas fa-graduation-cap"></i>
                    Formations
                </button>
                <button data-tab="expertise" class="tab whitespace-nowrap">
                    <i class="fas fa-code"></i>
                    Expertise
                </button>
                <button data-tab="polyvalence" class="tab whitespace-nowrap">
                    <i class="fas fa-puzzle-piece"></i>
                    Polyvalence
                </button>
                <button data-tab="soft_skills" class="tab whitespace-nowrap">
                    <i class="fas fa-users"></i>
                    Soft Skills
                </button>
            </nav>
        </div>

        <!-- Tab Panels -->
        <div class="p-6 lg:p-8">
            <!-- Experience -->
            <div data-panel="experience" class="hidden">
                <?php if (!empty($cvData['experience'])): ?>
                    <h2 class="text-2xl font-heading font-semibold mb-4">
                        <?= Helpers::e($cvData['experience']['title']) ?>
                    </h2>
                    <div class="prose max-w-none">
                        <?= $cvData['experience']['content'] ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">Aucune donnée disponible.</p>
                <?php endif; ?>
            </div>

            <!-- Formations -->
            <div data-panel="formations" class="hidden">
                <?php if (!empty($cvData['formations'])): ?>
                    <h2 class="text-2xl font-heading font-semibold mb-4">
                        <?= Helpers::e($cvData['formations']['title']) ?>
                    </h2>
                    <div class="prose max-w-none">
                        <?= $cvData['formations']['content'] ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">Aucune donnée disponible.</p>
                <?php endif; ?>
            </div>

            <!-- Expertise -->
            <div data-panel="expertise" class="hidden">
                <?php if (!empty($cvData['expertise'])): ?>
                    <h2 class="text-2xl font-heading font-semibold mb-4">
                        <?= Helpers::e($cvData['expertise']['title']) ?>
                    </h2>
                    <div class="prose max-w-none">
                        <?= $cvData['expertise']['content'] ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">Aucune donnée disponible.</p>
                <?php endif; ?>
            </div>

            <!-- Polyvalence -->
            <div data-panel="polyvalence" class="hidden">
                <?php if (!empty($cvData['polyvalence'])): ?>
                    <h2 class="text-2xl font-heading font-semibold mb-4">
                        <?= Helpers::e($cvData['polyvalence']['title']) ?>
                    </h2>
                    <div class="prose max-w-none">
                        <?= $cvData['polyvalence']['content'] ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">Aucune donnée disponible.</p>
                <?php endif; ?>
            </div>

            <!-- Soft Skills -->
            <div data-panel="soft_skills" class="hidden">
                <?php if (!empty($cvData['soft_skills'])): ?>
                    <h2 class="text-2xl font-heading font-semibold mb-4">
                        <?= Helpers::e($cvData['soft_skills']['title']) ?>
                    </h2>
                    <div class="prose max-w-none">
                        <?= $cvData['soft_skills']['content'] ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">Aucune donnée disponible.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Section CV Documents - Onglets séparés avec meilleur contraste -->
    <div class="mt-8 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg shadow-xl border-2 border-blue-200 overflow-hidden animate-slide-up">
        <!-- En-tête de la section -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
            <h2 class="text-2xl font-heading font-bold text-white flex items-center gap-3">
                <i class="fas fa-folder-open"></i>
                Mon CV en Formats Multiples
            </h2>
            <p class="text-blue-100 mt-1">Découvrez mon parcours en PDF ou en vidéo</p>
        </div>

        <!-- Onglets CV -->
        <div data-tabs-container="cv-documents" class="bg-white">
            <!-- Tab Headers -->
            <div class="border-b-2 border-blue-200">
                <nav class="flex">
                    <button data-tab="cv_pdf" class="cv-tab cv-tab-active">
                        <i class="fas fa-file-pdf text-red-500"></i>
                        <span>CV PDF</span>
                    </button>
                    <button data-tab="cv_video" class="cv-tab">
                        <i class="fas fa-video text-blue-500"></i>
                        <span>Présentation Vidéo</span>
                    </button>
                </nav>
            </div>

            <!-- Tab Panels -->
            <div class="p-6 lg:p-8">
                <!-- CV PDF -->
                <div data-panel="cv_pdf" class="hidden">
                    <?php if (!empty($cvData['cv_pdf'])): ?>
                        <div class="cv-document-content">
                            <?= $cvData['cv_pdf']['content'] ?>
                        </div>
                    <?php else: ?>
                        <p class="text-gray-500">Aucune donnée disponible.</p>
                    <?php endif; ?>
                </div>

                <!-- CV Vidéo -->
                <div data-panel="cv_video" class="hidden">
                    <?php if (!empty($cvData['cv_video'])): ?>
                        <div class="cv-document-content video-container">
                            <?= $cvData['cv_video']['content'] ?>
                        </div>
                    <?php else: ?>
                        <p class="text-gray-500">Aucune donnée disponible.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- PDF Section (optionnel) -->
    <?php if (file_exists(__DIR__ . '/../../../public/assets/cv.pdf')): ?>
        <section class="bg-white rounded-lg shadow-lg p-6 lg:p-8 mt-8 no-print">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-heading font-semibold">CV PDF</h2>
                <div class="flex gap-2">
                    <a href="<?= Helpers::asset('cv.pdf') ?>" target="_blank" class="btn btn-outline">
                        <i class="fas fa-external-link-alt"></i>
                        Ouvrir
                    </a>
                    <a href="<?= Helpers::asset('cv.pdf') ?>" download class="btn btn-primary">
                        <i class="fas fa-download"></i>
                        Télécharger
                    </a>
                </div>
            </div>
            <div class="border rounded-lg overflow-hidden">
                <iframe src="<?= Helpers::asset('cv.pdf') ?>" class="w-full h-[600px]" title="CV PDF"></iframe>
            </div>
        </section>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
$title = 'CV - Eric Corbisier';

require_once __DIR__ . '/../layouts/base.php';
