# Guide des Composants UI - CV Moderne

## 📦 Technologies Utilisées

- **Tailwind CSS**: Framework CSS utility-first
- **shadcn/ui**: Composants UI réutilisables (adapté pour PHP)
- **Font Awesome**: Icônes
- **JavaScript ES6+**: Interactivité

---

## 🎨 Composants Disponibles

### 1. Hero / Section Profil

Affiche les informations principales du CV avec photo.

#### Aperçu
```
┌─────────────────────────────────────────────────┐
│  ┌───────┐  Eric Corbisier                      │
│  │ Photo │  Développeur Web                     │
│  │       │                                       │
│  └───────┘  Description...                      │
│             Contact | Sites | Divers             │
└─────────────────────────────────────────────────┘
```

#### Code PHP

```php
<!-- src/Views/partials/hero.php -->
<section class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
    <div class="md:flex">
        <!-- Photo de profil -->
        <div class="md:w-1/3 lg:w-1/4 bg-gradient-to-br from-gray-100 to-gray-200">
            <img 
                src="<?= htmlspecialchars($photo_url) ?>" 
                alt="<?= htmlspecialchars($profile['name']) ?>"
                class="w-full h-full object-cover"
                loading="lazy"
                width="796"
                height="1024"
            >
        </div>

        <!-- Informations -->
        <div class="md:w-2/3 lg:w-3/4 p-6 lg:p-8">
            <div class="grid md:grid-cols-2 gap-6">
                
                <!-- Colonne gauche -->
                <div class="space-y-4">
                    <!-- Nom -->
                    <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        <?= htmlspecialchars($profile['name']) ?>
                    </h1>
                    
                    <!-- Métier -->
                    <div class="group p-4 bg-gray-50 rounded-lg hover:bg-blue-50 transition-colors duration-200 cursor-pointer border-l-4 border-blue-500">
                        <h2 class="font-bold text-sm uppercase text-gray-600 mb-2 flex items-center">
                            <i class="fas fa-briefcase mr-2 text-blue-500"></i>
                            Métier, poste
                        </h2>
                        <p class="text-gray-900 font-medium"><?= htmlspecialchars($profile['job']) ?></p>
                    </div>
                    
                    <!-- Description -->
                    <div class="group p-4 bg-gray-50 rounded-lg hover:bg-blue-50 transition-colors duration-200 cursor-pointer border-l-4 border-purple-500">
                        <h2 class="font-bold text-sm uppercase text-gray-600 mb-2 flex items-center">
                            <i class="fas fa-user mr-2 text-purple-500"></i>
                            Description
                        </h2>
                        <p class="text-gray-900 whitespace-pre-line leading-relaxed">
                            <?= htmlspecialchars($profile['description']) ?>
                        </p>
                    </div>
                </div>

                <!-- Colonne droite -->
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        
                        <!-- Sites Web -->
                        <div class="group p-4 bg-gray-50 rounded-lg hover:bg-green-50 transition-colors duration-200 border-l-4 border-green-500">
                            <h2 class="font-bold text-sm uppercase text-gray-600 mb-2 flex items-center">
                                <i class="fas fa-globe mr-2 text-green-500"></i>
                                Mes Sites Web
                            </h2>
                            <div class="space-y-1">
                                <?php foreach ($profile['websites'] as $website): ?>
                                    <a 
                                        href="<?= htmlspecialchars($website) ?>" 
                                        class="block text-blue-600 hover:text-blue-800 hover:underline transition-colors"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >
                                        <i class="fas fa-external-link-alt text-xs mr-1"></i>
                                        <?= htmlspecialchars(parse_url($website, PHP_URL_HOST)) ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Divers -->
                        <div class="group p-4 bg-gray-50 rounded-lg hover:bg-yellow-50 transition-colors duration-200 border-l-4 border-yellow-500">
                            <h2 class="font-bold text-sm uppercase text-gray-600 mb-2 flex items-center">
                                <i class="fas fa-info-circle mr-2 text-yellow-500"></i>
                                Divers
                            </h2>
                            <p class="text-gray-900">
                                <i class="fas fa-car mr-2 text-yellow-600"></i>
                                <?= htmlspecialchars($profile['misc']) ?>
                            </p>
                        </div>

                        <!-- Contact -->
                        <div class="col-span-2 group p-4 bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg hover:from-blue-100 hover:to-purple-100 transition-colors duration-200 border-l-4 border-blue-600">
                            <h2 class="font-bold text-sm uppercase text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-address-card mr-2 text-blue-600"></i>
                                Contact
                            </h2>
                            <div class="grid md:grid-cols-2 gap-2">
                                <a 
                                    href="mailto:<?= htmlspecialchars($profile['email']) ?>" 
                                    class="flex items-center text-blue-600 hover:text-blue-800 transition-colors"
                                >
                                    <i class="fas fa-envelope w-5 mr-2"></i>
                                    <span class="hover:underline"><?= htmlspecialchars($profile['email']) ?></span>
                                </a>
                                <a 
                                    href="tel:<?= htmlspecialchars($profile['phone']) ?>" 
                                    class="flex items-center text-blue-600 hover:text-blue-800 transition-colors"
                                >
                                    <i class="fas fa-phone w-5 mr-2"></i>
                                    <span class="hover:underline"><?= htmlspecialchars($profile['phone']) ?></span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
```

#### Classes Tailwind Utilisées
- **Layout**: `md:flex`, `grid`, `md:grid-cols-2`, `gap-4`
- **Spacing**: `p-4`, `p-6`, `lg:p-8`, `space-y-4`
- **Colors**: `bg-gray-50`, `text-blue-600`, `border-blue-500`
- **Typography**: `text-4xl`, `font-bold`, `uppercase`
- **Effects**: `hover:bg-blue-50`, `transition-colors`, `shadow-lg`

---

### 2. Système d'Onglets

Onglets interactifs avec navigation et gestion de l'historique.

#### Aperçu
```
┌─────────────────────────────────────────────────┐
│ [Expérience] [Formations] [Expertise] ...       │
├─────────────────────────────────────────────────┤
│                                                  │
│  Contenu de l'onglet actif                      │
│                                                  │
└─────────────────────────────────────────────────┘
```

#### Code PHP

```php
<!-- src/Views/partials/tabs.php -->
<div id="cv-tabs" class="bg-white rounded-lg shadow-lg overflow-hidden">
    
    <!-- Navigation des onglets -->
    <div class="border-b border-gray-200 bg-gray-50">
        <nav class="flex flex-wrap -mb-px" role="tablist" aria-label="CV Sections">
            <?php
            $tabs = [
                'experience' => ['label' => 'Expérience', 'icon' => 'fa-briefcase'],
                'formations' => ['label' => 'Formations', 'icon' => 'fa-graduation-cap'],
                'expertise' => ['label' => 'Expertise', 'icon' => 'fa-code'],
                'polyvalence' => ['label' => 'Polyvalence', 'icon' => 'fa-puzzle-piece'],
                'softskills' => ['label' => 'Soft Skills', 'icon' => 'fa-heart'],
            ];
            
            foreach ($tabs as $key => $tab):
                $isActive = $activeTab === $key;
                $activeClasses = $isActive 
                    ? 'border-blue-500 text-blue-600 bg-white' 
                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300';
            ?>
                <button
                    type="button"
                    role="tab"
                    id="tab-<?= $key ?>"
                    data-tab="<?= $key ?>"
                    aria-selected="<?= $isActive ? 'true' : 'false' ?>"
                    aria-controls="tab-content-<?= $key ?>"
                    class="tab-button flex items-center px-4 sm:px-6 py-3 sm:py-4 text-sm font-medium border-b-2 transition-all duration-200 <?= $activeClasses ?>"
                    onclick="switchTab('<?= $key ?>')"
                >
                    <i class="fas <?= $tab['icon'] ?> mr-2 hidden sm:inline"></i>
                    <span><?= htmlspecialchars($tab['label']) ?></span>
                </button>
            <?php endforeach; ?>
        </nav>
    </div>

    <!-- Contenu des onglets -->
    <div class="p-6 lg:p-8">
        <?php foreach ($tabs as $key => $tab): 
            $isActive = $activeTab === $key;
        ?>
            <div 
                id="tab-content-<?= $key ?>" 
                role="tabpanel"
                aria-labelledby="tab-<?= $key ?>"
                class="tab-content <?= !$isActive ? 'hidden' : '' ?>"
            >
                <!-- En-tête -->
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                    <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 flex items-center">
                        <i class="fas <?= $tab['icon'] ?> mr-3 text-blue-600"></i>
                        <?= htmlspecialchars($sections[$key]['title'] ?? $tab['label']) ?>
                    </h2>
                    <button 
                        class="text-gray-400 hover:text-gray-600 transition-colors"
                        title="Imprimer cette section"
                        onclick="printSection('<?= $key ?>')"
                    >
                        <i class="fas fa-print text-xl"></i>
                    </button>
                </div>
                
                <!-- Loader -->
                <div class="content-loader">
                    <div class="animate-pulse space-y-4">
                        <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                        <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                        <div class="h-4 bg-gray-200 rounded w-2/3"></div>
                    </div>
                </div>
                
                <!-- Contenu -->
                <div class="content-data hidden prose prose-blue max-w-none">
                    <?= $sections[$key]['content'] ?? '' ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
```

#### JavaScript Associé

```javascript
// public/assets/js/components/tabs.js

/**
 * Gestion des onglets
 */
class TabsManager {
    constructor(containerId = 'cv-tabs') {
        this.container = document.getElementById(containerId);
        this.activeTab = this.getActiveTabFromURL() || 'experience';
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.handleBrowserNavigation();
    }

    /**
     * Change d'onglet
     */
    switchTab(tabKey) {
        // Masquer tous les contenus
        this.container.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
            content.setAttribute('aria-hidden', 'true');
        });

        // Désactiver tous les boutons
        this.container.querySelectorAll('.tab-button').forEach(button => {
            button.classList.remove('border-blue-500', 'text-blue-600', 'bg-white');
            button.classList.add('border-transparent', 'text-gray-500');
            button.setAttribute('aria-selected', 'false');
        });

        // Afficher le contenu sélectionné
        const selectedContent = document.getElementById(`tab-content-${tabKey}`);
        if (selectedContent) {
            selectedContent.classList.remove('hidden');
            selectedContent.setAttribute('aria-hidden', 'false');
        }

        // Activer le bouton sélectionné
        const selectedButton = this.container.querySelector(`[data-tab="${tabKey}"]`);
        if (selectedButton) {
            selectedButton.classList.add('border-blue-500', 'text-blue-600', 'bg-white');
            selectedButton.classList.remove('border-transparent', 'text-gray-500');
            selectedButton.setAttribute('aria-selected', 'true');
        }

        // Mettre à jour l'URL
        this.updateURL(tabKey);

        // Scroller vers les onglets (mobile)
        if (window.innerWidth < 768) {
            this.container.scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
        }

        this.activeTab = tabKey;
    }

    /**
     * Met à jour l'URL sans recharger
     */
    updateURL(tabKey) {
        const url = new URL(window.location);
        url.searchParams.set('section', tabKey);
        window.history.pushState({ tab: tabKey }, '', url);
    }

    /**
     * Récupère l'onglet depuis l'URL
     */
    getActiveTabFromURL() {
        const params = new URLSearchParams(window.location.search);
        return params.get('section');
    }

    /**
     * Gestion de la navigation navigateur
     */
    handleBrowserNavigation() {
        window.addEventListener('popstate', (event) => {
            const tab = this.getActiveTabFromURL() || 'experience';
            this.switchTab(tab);
        });
    }

    /**
     * Événements
     */
    setupEventListeners() {
        // Aucun listener direct car on utilise onclick dans le HTML
        // Mais on pourrait améliorer avec :
        /*
        this.container.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', (e) => {
                const tab = e.currentTarget.dataset.tab;
                this.switchTab(tab);
            });
        });
        */
    }
}

// Export pour utilisation globale
export default TabsManager;
```

---

### 3. Visionneuse PDF

Affiche un PDF embarqué avec contrôles.

#### Code PHP

```php
<!-- src/Views/partials/pdf-viewer.php -->
<section class="bg-white rounded-lg shadow-lg overflow-hidden">
    
    <!-- En-tête -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold flex items-center">
                    <i class="fas fa-file-pdf mr-3"></i>
                    Mon CV (PDF)
                </h2>
                <p class="text-blue-100 mt-1">Dernière mise à jour : 24/02/2025</p>
            </div>
            <div class="flex gap-3">
                <a 
                    href="<?= htmlspecialchars($pdf_url) ?>" 
                    class="inline-flex items-center px-6 py-3 bg-white text-blue-600 font-medium rounded-lg hover:bg-blue-50 transition-colors shadow-md hover:shadow-lg"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <i class="fas fa-external-link-alt mr-2"></i>
                    Ouvrir
                </a>
                <a 
                    href="<?= htmlspecialchars($pdf_url) ?>" 
                    class="inline-flex items-center px-6 py-3 bg-purple-700 text-white font-medium rounded-lg hover:bg-purple-800 transition-colors shadow-md hover:shadow-lg"
                    download
                >
                    <i class="fas fa-download mr-2"></i>
                    Télécharger
                </a>
            </div>
        </div>
    </div>

    <!-- Visionneuse -->
    <div class="p-6 bg-gray-50">
        <div class="bg-white rounded-lg shadow-inner overflow-hidden">
            <iframe 
                src="<?= htmlspecialchars($pdf_url) ?>#toolbar=1&navpanes=0&scrollbar=1" 
                class="w-full h-[600px] lg:h-[800px]"
                title="Curriculum Vitae PDF"
                loading="lazy"
            >
                <p class="p-8 text-center text-gray-600">
                    Votre navigateur ne prend pas en charge les PDFs embarqués.
                    <a href="<?= htmlspecialchars($pdf_url) ?>" class="text-blue-600 hover:underline">
                        Téléchargez le PDF
                    </a>
                    pour le consulter.
                </p>
            </iframe>
        </div>
        
        <!-- Boutons mobiles -->
        <div class="flex gap-3 mt-4 md:hidden">
            <a 
                href="<?= htmlspecialchars($pdf_url) ?>" 
                class="flex-1 text-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors"
                target="_blank"
            >
                <i class="fas fa-external-link-alt mr-2"></i>
                Ouvrir
            </a>
            <a 
                href="<?= htmlspecialchars($pdf_url) ?>" 
                class="flex-1 text-center px-6 py-3 bg-purple-600 text-white font-medium rounded-lg hover:bg-purple-700 transition-colors"
                download
            >
                <i class="fas fa-download mr-2"></i>
                Télécharger
            </a>
        </div>
    </div>

</section>
```

---

### 4. Loader / Spinner

Indicateur de chargement.

#### Code HTML/PHP

```php
<!-- Loader plein écran -->
<div id="loader" class="fixed inset-0 bg-white z-50 flex items-center justify-center transition-opacity duration-300">
    <div class="text-center">
        <!-- Spinner -->
        <div class="relative">
            <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-blue-500 mx-auto"></div>
            <div class="animate-ping absolute inset-0 rounded-full h-16 w-16 border-4 border-blue-300 opacity-75"></div>
        </div>
        
        <!-- Texte -->
        <p class="mt-4 text-gray-600 font-medium">Chargement en cours...</p>
    </div>
</div>

<!-- Loader inline (pour contenu) -->
<div class="content-loader">
    <div class="animate-pulse space-y-4">
        <div class="h-4 bg-gray-200 rounded w-3/4"></div>
        <div class="h-4 bg-gray-200 rounded w-5/6"></div>
        <div class="h-4 bg-gray-200 rounded w-2/3"></div>
        <div class="h-4 bg-gray-200 rounded w-4/5"></div>
    </div>
</div>
```

#### CSS Personnalisé (optionnel)

```css
/* public/assets/css/components/loader.css */

.loader-dots {
    display: inline-flex;
    gap: 0.5rem;
}

.loader-dots span {
    width: 0.75rem;
    height: 0.75rem;
    border-radius: 50%;
    background-color: #3b82f6;
    animation: loader-bounce 1.4s infinite ease-in-out both;
}

.loader-dots span:nth-child(1) {
    animation-delay: -0.32s;
}

.loader-dots span:nth-child(2) {
    animation-delay: -0.16s;
}

@keyframes loader-bounce {
    0%, 80%, 100% {
        transform: scale(0);
        opacity: 0.5;
    }
    40% {
        transform: scale(1);
        opacity: 1;
    }
}
```

---

### 5. Card / Carte d'Information

Composant réutilisable pour afficher des informations.

#### Code PHP

```php
<?php
/**
 * Composant Card
 * 
 * @param string $title Titre de la carte
 * @param string $content Contenu de la carte
 * @param string $icon Classe d'icône Font Awesome
 * @param string $color Couleur (blue, green, purple, yellow, red)
 */
function renderCard($title, $content, $icon = null, $color = 'blue') {
    $colors = [
        'blue' => 'border-blue-500 hover:bg-blue-50',
        'green' => 'border-green-500 hover:bg-green-50',
        'purple' => 'border-purple-500 hover:bg-purple-50',
        'yellow' => 'border-yellow-500 hover:bg-yellow-50',
        'red' => 'border-red-500 hover:bg-red-50',
    ];
    
    $colorClass = $colors[$color] ?? $colors['blue'];
    $iconColor = "text-{$color}-500";
    
    ?>
    <div class="group p-4 bg-gray-50 rounded-lg transition-all duration-200 border-l-4 <?= $colorClass ?>">
        <?php if ($title): ?>
            <h2 class="font-bold text-sm uppercase text-gray-600 mb-2 flex items-center">
                <?php if ($icon): ?>
                    <i class="fas <?= htmlspecialchars($icon) ?> mr-2 <?= $iconColor ?>"></i>
                <?php endif; ?>
                <?= htmlspecialchars($title) ?>
            </h2>
        <?php endif; ?>
        
        <div class="text-gray-900">
            <?= $content ?>
        </div>
    </div>
    <?php
}

// Utilisation
renderCard(
    'Métier, poste',
    htmlspecialchars($profile['job']),
    'fa-briefcase',
    'blue'
);
?>
```

---

### 6. Button / Bouton

Boutons stylisés avec variantes.

#### Code HTML

```html
<!-- Bouton principal -->
<button class="btn btn-primary">
    <i class="fas fa-check mr-2"></i>
    Valider
</button>

<!-- Bouton secondaire -->
<button class="btn btn-secondary">
    Annuler
</button>

<!-- Bouton succès -->
<button class="btn btn-success">
    <i class="fas fa-download mr-2"></i>
    Télécharger
</button>

<!-- Bouton danger -->
<button class="btn btn-danger">
    <i class="fas fa-trash mr-2"></i>
    Supprimer
</button>

<!-- Bouton outline -->
<button class="btn btn-outline">
    En savoir plus
</button>

<!-- Bouton avec icône seulement -->
<button class="btn-icon">
    <i class="fas fa-print"></i>
</button>
```

#### CSS Tailwind

```css
/* public/assets/css/components/buttons.css */

@layer components {
    /* Bouton de base */
    .btn {
        @apply inline-flex items-center justify-center px-6 py-3 font-medium rounded-lg transition-all duration-200 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2;
    }

    /* Variantes */
    .btn-primary {
        @apply btn bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500;
    }

    .btn-secondary {
        @apply btn bg-gray-600 text-white hover:bg-gray-700 focus:ring-gray-500;
    }

    .btn-success {
        @apply btn bg-green-600 text-white hover:bg-green-700 focus:ring-green-500;
    }

    .btn-danger {
        @apply btn bg-red-600 text-white hover:bg-red-700 focus:ring-red-500;
    }

    .btn-outline {
        @apply btn bg-transparent border-2 border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-gray-500;
    }

    /* Bouton icône seule */
    .btn-icon {
        @apply inline-flex items-center justify-center w-10 h-10 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500;
    }
}
```

---

## 🎨 Palette de Couleurs

### Couleurs Principales

```css
/* Configuration dans tailwind.config.js */
colors: {
    primary: {
        50: '#eff6ff',
        100: '#dbeafe',
        500: '#3b82f6',  // Bleu principal
        600: '#2563eb',
        700: '#1d4ed8',
    },
    secondary: {
        500: '#8b5cf6',  // Violet
    },
    success: {
        500: '#10b981',  // Vert
    },
    warning: {
        500: '#f59e0b',  // Orange/Jaune
    },
    danger: {
        500: '#ef4444',  // Rouge
    }
}
```

---

## 📱 Responsive Design

### Breakpoints Tailwind

| Breakpoint | Min Width | CSS |
|------------|-----------|-----|
| `sm` | 640px | `@media (min-width: 640px)` |
| `md` | 768px | `@media (min-width: 768px)` |
| `lg` | 1024px | `@media (min-width: 1024px)` |
| `xl` | 1280px | `@media (min-width: 1280px)` |
| `2xl` | 1536px | `@media (min-width: 1536px)` |

### Exemples d'Utilisation

```html
<!-- Colonne mobile, 2 colonnes tablette, 3 colonnes desktop -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    ...
</div>

<!-- Texte responsive -->
<h1 class="text-2xl md:text-4xl lg:text-5xl">
    Titre
</h1>

<!-- Padding responsive -->
<div class="p-4 md:p-6 lg:p-8">
    ...
</div>

<!-- Masquer sur mobile -->
<div class="hidden md:block">
    Visible uniquement sur tablette et desktop
</div>

<!-- Afficher uniquement sur mobile -->
<div class="block md:hidden">
    Visible uniquement sur mobile
</div>
```

---

## ♿ Accessibilité

### Attributs ARIA

```html
<!-- Onglets -->
<button 
    role="tab"
    aria-selected="true"
    aria-controls="tab-content-experience"
    id="tab-experience"
>
    Expérience
</button>

<div 
    role="tabpanel"
    aria-labelledby="tab-experience"
    id="tab-content-experience"
>
    ...
</div>

<!-- Navigation -->
<nav aria-label="CV Sections">
    ...
</nav>

<!-- Icônes décoratives -->
<i class="fas fa-check" aria-hidden="true"></i>

<!-- Liens externes -->
<a 
    href="https://example.com" 
    target="_blank"
    rel="noopener noreferrer"
    aria-label="Ouvre dans un nouvel onglet"
>
    Mon site
</a>
```

---

## 🚀 Animations

### Animations Tailwind Intégrées

```html
<!-- Spin -->
<div class="animate-spin">...</div>

<!-- Ping -->
<div class="animate-ping">...</div>

<!-- Pulse -->
<div class="animate-pulse">...</div>

<!-- Bounce -->
<div class="animate-bounce">...</div>
```

### Animations Personnalisées

```javascript
// tailwind.config.js
module.exports = {
    theme: {
        extend: {
            animation: {
                'fade-in': 'fadeIn 0.5s ease-in',
                'slide-up': 'slideUp 0.3s ease-out',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%': { transform: 'translateY(10px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
            }
        }
    }
}
```

---

*Dernière mise à jour : 17 décembre 2024*
