<?php
use App\Utils\Helpers;
?>
<header class="bg-white shadow-sm sticky top-0 z-40 no-print">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" class="flex items-center space-x-3">
                    <img src="<?= Helpers::asset('images/logo/logo.png') ?>" alt="Logo" class="h-10 w-10">
                    <span class="font-heading font-bold text-xl text-gray-900">Eric Corbisier</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-6">
                <a href="#cv" class="text-gray-600 hover:text-primary-600 transition-colors">CV</a>
                <a href="#contact" class="text-gray-600 hover:text-primary-600 transition-colors">Contact</a>
                <button id="print-btn" class="btn btn-outline">
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
