<?php

use App\Utils\Helpers;
?>
<header class="bg-gradient-to-r from-white via-primary-50 to-white shadow-lg sticky top-0 z-40 no-print border-b-2 border-primary-200">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <div class="flex items-center py-2">
                <a href="/" class="flex items-center transform hover:scale-105 transition-transform">
                    <img src="https://api-cv.corbisier.fr/wp-content/uploads/2025/12/logo_corbidev_large-e1766005728496.png"
                        alt="CorbiDev Logo" class="h-16 w-auto max-w-[200px] object-contain">
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-6">
                <a href="#cv" class="px-4 py-2 text-gray-700 hover:text-primary-600 hover:bg-primary-100 rounded-lg transition-all font-medium flex items-center gap-2">
                    <i class="fas fa-file-alt text-primary-600"></i>
                    CV
                </a>
                <button id="contact-modal-btn"
                    class="px-4 py-2 text-gray-700 hover:text-primary-600 hover:bg-primary-100 rounded-lg transition-all font-medium flex items-center gap-2">
                    <i class="fas fa-envelope text-primary-600"></i>
                    Contact
                </button>
                <button id="print-btn" class="btn btn-primary shadow-lg hover:shadow-xl hidden lg:flex">
                    <i class="fas fa-print"></i>
                    Imprimer
                </button>
            </nav>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-toggle" class="md:hidden text-gray-600 hover:text-primary-600 hover:bg-primary-100 p-2 rounded-lg transition-all">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Mobile Navigation -->
        <nav id="mobile-menu" class="md:hidden hidden pb-4 border-t border-primary-100 mt-2 pt-4">
            <div class="flex flex-col space-y-2">
                <a href="#cv" class="px-4 py-3 text-gray-700 hover:text-primary-600 hover:bg-primary-100 rounded-lg transition-all flex items-center gap-2">
                    <i class="fas fa-file-alt text-primary-600"></i>
                    CV
                </a>
                <button id="contact-modal-btn-mobile"
                    class="text-left px-4 py-3 text-gray-700 hover:text-primary-600 hover:bg-primary-100 rounded-lg transition-all flex items-center gap-2">
                    <i class="fas fa-envelope text-primary-600"></i>
                    Contact
                </button>
            </div>
        </nav>
    </div>
</header>