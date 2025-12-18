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
            <div class="flex items-center justify-center p-6 bg-gradient-to-br from-gray-100 to-gray-200">
                <div class="photo-cv rounded-lg overflow-hidden shadow-xl ring-4 ring-white">
                    <img src="https://api-cv.corbisier.fr/wp-content/uploads/2025/12/photo_identite_tr-e1766007892344.png"
                        alt="Eric Corbisier" class="w-full h-full object-contain object-center" loading="eager">
                </div>
            </div>

            <!-- Informations -->
            <div class="flex-1 p-6 lg:p-8">
                <h1 class="font-heading font-bold text-4xl mb-2">Eric Corbisier</h1>
                <p class="text-xl text-primary-600 mb-4">Développeur Web Full Stack</p>

                <?php if (!empty($homeData['excerpt'])): ?>
                    <div class="text-gray-600 mb-6">
                        <?= $homeData['excerpt'] ?>
                    </div>
                <?php endif; ?>

                <!-- Contact & Liens -->
                <div class="space-y-4">
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
                                <span>+33 6 50 46 91 20</span>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="font-semibold text-sm text-gray-500 mb-2">Sites Web</h3>
                        <div class="flex flex-wrap gap-2">
                            <a href="https://github.com/LeZouzouEnWeb" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center gap-2 text-gray-700 hover:text-primary-600 transition-colors">
                                <i class="fab fa-github text-primary-600"></i>
                                <span class="text-sm">GitHub</span>
                            </a>
                            <a href="https://corbisier.fr" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center gap-2 text-gray-700 hover:text-primary-600 transition-colors">
                                <i class="fas fa-globe text-primary-600"></i>
                                <span class="text-sm">corbisier.fr</span>
                            </a>
                            <a href="https://lescorbycats.fr" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center gap-2 text-gray-700 hover:text-primary-600 transition-colors">
                                <i class="fas fa-globe text-primary-600"></i>
                                <span class="text-sm">lescorbycats.fr</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tabs -->
    <div data-tabs-container
        class="bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-2xl border-2 border-primary-200 overflow-hidden animate-slide-up">
        <!-- En-tête de section -->
        <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-6 py-4">
            <h2 class="text-2xl font-heading font-bold text-white flex items-center gap-3">
                <i class="fas fa-chart-line"></i>
                Mon Parcours Professionnel
            </h2>
            <p class="text-primary-100 mt-1 text-sm">Découvrez mes compétences et mon expérience</p>
        </div>

        <!-- Tab Headers -->
        <div class="border-b-2 border-primary-200 overflow-x-auto bg-gradient-to-b from-gray-50 to-white">
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

        <!-- Indicateurs de position (mobile/tablette uniquement) -->
        <div class="tab-indicators lg:hidden flex justify-center gap-2 py-3 bg-white border-b border-gray-200">
            <span data-indicator="experience" class="tab-indicator active"></span>
            <span data-indicator="formations" class="tab-indicator"></span>
            <span data-indicator="expertise" class="tab-indicator"></span>
            <span data-indicator="polyvalence" class="tab-indicator"></span>
            <span data-indicator="soft_skills" class="tab-indicator"></span>
        </div>

        <!-- Tab Panels -->
        <div class="p-6 lg:p-8 bg-white">
            <!-- Experience -->
            <div data-panel="experience" class="tab-panel">
                <?php if (!empty($cvData['experience'])): ?>
                    <div class="flex items-center gap-3 mb-6 pb-3 border-b-2 border-primary-200">
                        <i class="fas fa-briefcase text-xl text-primary-600"></i>
                        <h2 class="text-xl font-heading font-bold text-gray-800">
                            <?= Helpers::e($cvData['experience']['title']) ?>
                        </h2>
                    </div>
                    <div
                        class="prose max-w-none prose-headings:text-primary-700 prose-a:text-primary-600 hover:prose-a:text-primary-800">
                        <?= $cvData['experience']['content'] ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">Aucune donnée disponible.</p>
                <?php endif; ?>
            </div>

            <!-- Formations -->
            <div data-panel="formations" class="hidden tab-panel">
                <?php if (!empty($cvData['formations'])): ?>
                    <div class="flex items-center gap-3 mb-6 pb-3 border-b-2 border-primary-200">
                        <i class="fas fa-graduation-cap text-xl text-primary-600"></i>
                        <h2 class="text-xl font-heading font-bold text-gray-800">
                            <?= Helpers::e($cvData['formations']['title']) ?>
                        </h2>
                    </div>
                    <div
                        class="prose max-w-none prose-headings:text-primary-700 prose-a:text-primary-600 hover:prose-a:text-primary-800">
                        <?= $cvData['formations']['content'] ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">Aucune donnée disponible.</p>
                <?php endif; ?>
            </div>

            <!-- Expertise -->
            <div data-panel="expertise" class="hidden tab-panel">
                <?php if (!empty($cvData['expertise'])): ?>
                    <div class="flex items-center gap-3 mb-6 pb-3 border-b-2 border-primary-200">
                        <i class="fas fa-code text-xl text-primary-600"></i>
                        <h2 class="text-xl font-heading font-bold text-gray-800">
                            <?= Helpers::e($cvData['expertise']['title']) ?>
                        </h2>
                    </div>
                    <div
                        class="prose max-w-none prose-headings:text-primary-700 prose-a:text-primary-600 hover:prose-a:text-primary-800">
                        <?= $cvData['expertise']['content'] ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">Aucune donnée disponible.</p>
                <?php endif; ?>
            </div>

            <!-- Polyvalence -->
            <div data-panel="polyvalence" class="hidden tab-panel">
                <?php if (!empty($cvData['polyvalence'])): ?>
                    <div class="flex items-center gap-3 mb-6 pb-3 border-b-2 border-primary-200">
                        <i class="fas fa-puzzle-piece text-xl text-primary-600"></i>
                        <h2 class="text-xl font-heading font-bold text-gray-800">
                            <?= Helpers::e($cvData['polyvalence']['title']) ?>
                        </h2>
                    </div>
                    <div
                        class="prose max-w-none prose-headings:text-primary-700 prose-a:text-primary-600 hover:prose-a:text-primary-800">
                        <?= $cvData['polyvalence']['content'] ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">Aucune donnée disponible.</p>
                <?php endif; ?>
            </div>

            <!-- Soft Skills -->
            <div data-panel="soft_skills" class="hidden tab-panel">
                <?php if (!empty($cvData['soft_skills'])): ?>
                    <div class="flex items-center gap-3 mb-6 pb-3 border-b-2 border-primary-200">
                        <i class="fas fa-users text-xl text-primary-600"></i>
                        <h2 class="text-xl font-heading font-bold text-gray-800">
                            <?= Helpers::e($cvData['soft_skills']['title']) ?>
                        </h2>
                    </div>
                    <div
                        class="prose max-w-none prose-headings:text-primary-700 prose-a:text-primary-600 hover:prose-a:text-primary-800">
                        <?= $cvData['soft_skills']['content'] ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">Aucune donnée disponible.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Section CV Documents - Onglets séparés avec meilleur contraste -->
    <div
        class="mt-8 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg shadow-xl border-2 border-blue-200 overflow-hidden animate-slide-up">
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
                <div data-panel="cv_pdf">
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
