<?php
use App\Utils\Helpers;
?>
<footer class="bg-gray-900 text-white py-8 mt-16 no-print">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-8">
            <!-- About -->
            <div>
                <h3 class="font-heading font-semibold text-lg mb-4">Eric Corbisier</h3>
                <p class="text-gray-400 text-sm">
                    Développeur Web passionné par la création d'expériences web modernes et performantes.
                </p>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="font-heading font-semibold text-lg mb-4">Contact</h3>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="mailto:emploi@corbisier.fr" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2">
                            <i class="fas fa-envelope"></i>
                            emploi@corbisier.fr
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com/LeZouzouEnWeb" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2">
                            <i class="fab fa-github"></i>
                            GitHub
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Links -->
            <div>
                <h3 class="font-heading font-semibold text-lg mb-4">Liens</h3>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="https://api-cv.corbisier.fr" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white transition-colors">
                            API WordPress
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com/LeZouzouEnWeb/mon_cv_frontend" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white transition-colors">
                            Code Source
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
            <p>&copy; <?= date('Y') ?> Eric Corbisier. Tous droits réservés.</p>
        </div>
    </div>
</footer>
