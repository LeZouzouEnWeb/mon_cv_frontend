<?php

use App\Utils\Helpers;
?>
<header class="bg-white shadow-md sticky top-0 z-40 no-print border-b-2 border-primary-100">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <div class="flex items-center py-2">
                <a href="/" class="flex items-center">
                    <img src="https://api-cv.corbisier.fr/wp-content/uploads/2025/12/logo_corbidev_large-e1766005728496.png"
                        alt="CorbiDev Logo"
                        class="h-16 w-auto max-w-[200px] object-contain">
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-8">
                <a href="#cv" class="text-gray-700 hover:text-primary-600 transition-colors font-medium">CV</a>
                <a href="#contact" class="text-gray-700 hover:text-primary-600 transition-colors font-medium">Contact</a>
                <button id="print-btn" class="btn btn-primary shadow-md">
                    <i class="fas fa-print"></i>
                    Imprimer
                </button>
            </nav>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-toggle" class="md:hidden text-gray-600 hover:text-gray-900">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>

        <!-- Mobile Navigation -->
        <nav id="mobile-menu" class="md:hidden hidden pb-4">
            <div class="flex flex-col space-y-3">
                <a href="#cv" class="text-gray-600 hover:text-primary-600 transition-colors">CV</a>
                <a href="#contact" class="text-gray-600 hover:text-primary-600 transition-colors">Contact</a>
                <button id="print-btn-mobile" class="btn btn-outline">
                    <i class="fas fa-print"></i>
                    Imprimer
                </button>
            </div>
        </nav>
    </div>
</header>