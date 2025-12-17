# RAG - Base de Connaissances pour le CV Moderne

## 📋 Vue d'ensemble du projet

Ce document sert de base de connaissances (RAG - Retrieval-Augmented Generation) pour la création d'une page web moderne affichant un CV professionnel.

### Objectifs
- Créer une version moderne du site CV existant
- Utiliser PHP, HTML, Tailwind CSS, shadcn/ui et JavaScript
- Consommer l'API WordPress REST depuis `https://api-cv.corbisier.fr/wp-json`
- Structure avec dossier `public/` pour la partie publique

---

## 🏗️ Architecture du Site Existant

### Structure actuelle (dossier `old/`)
```
old/
├── index.php                    # Point d'entrée principal
├── assets/                      # Ressources backend
│   ├── _php_controler/         # Contrôleurs (session, variables)
│   ├── _php_functions/         # Fonctions utilitaires
│   └── _php_pages/             # Pages (cv.php)
├── layouts/                     # Ressources frontend
│   ├── _ajax_php/              # Scripts AJAX (cv.ajax.php, commun.php)
│   ├── _css/                   # Feuilles de style
│   ├── _img/                   # Images (photo, logo, favicon)
│   └── _js/                    # Scripts JavaScript
└── template/                    # Templates PHP
    ├── page.php                # Template principal
    ├── head/                   # En-têtes HTML
    ├── header/                 # En-tête du site
    └── footer/                 # Pied de page
```

### Fonctionnalités clés identifiées

1. **Système de sécurité**
   - Vérification anti-robot via session
   - Constante `CORBTECH_SECUR_ROOT_PATH` pour éviter les accès directs
   - Gestion des sessions

2. **Affichage du CV**
   - Photo de profil
   - Informations personnelles (nom, métier, description)
   - Contact (email, téléphone)
   - Liens vers sites web
   - Onglets dynamiques :
     - Expérience professionnelle
     - Formations
     - Expertise (compétences techniques)
     - Polyvalence (compétences transversales)
     - Soft Skills (compétences comportementales)
   - PDF embarqué du CV avec boutons Ouvrir/Télécharger

3. **Chargement AJAX**
   - Les contenus sont chargés dynamiquement via `cv.ajax.php`
   - Indicateur de chargement pendant la récupération des données

4. **Navigation par onglets**
   - Système d'onglets avec gestion de l'historique du navigateur
   - URL dynamique avec paramètre `?index=cv&options=[onglet]`

---

## 🔌 API WordPress REST

### URL de base
```
https://api-cv.corbisier.fr/wp-json
```

### Endpoints utilisés actuellement

#### Posts individuels
```php
// Format: /wp/v2/posts/{id}
/wp/v2/posts/128  // Expérience
/wp/v2/posts/153  // Formations
/wp/v2/posts/126  // Expertise
/wp/v2/posts/121  // Polyvalence
/wp/v2/posts/130  // Soft Skills
/wp/v2/posts/74   // (Autre contenu)
/wp/v2/posts/134  // (Autre contenu)
```

#### Pages
```php
// Format: /wp/v2/pages/{id}
/wp/v2/pages/181  // Page d'accueil (page_on_front)
```

### Structure de réponse API

```json
{
  "id": 128,
  "date": "2023-07-15T10:30:00",
  "modified": "2024-02-24T14:20:00",
  "slug": "experience-professionnelle",
  "status": "publish",
  "title": {
    "rendered": "Expérience professionnelle"
  },
  "content": {
    "rendered": "<ul><li>Contenu HTML...</li></ul>",
    "protected": false
  },
  "excerpt": {
    "rendered": "<p>Résumé...</p>",
    "protected": false
  },
  "author": 1,
  "featured_media": 0,
  "_links": {
    "self": [{"href": "https://api-cv.corbisier.fr/wp-json/wp/v2/posts/128"}],
    "author": [{"href": "https://api-cv.corbisier.fr/wp-json/wp/v2/users/1"}]
  }
}
```

### Paramètres de requête disponibles
- `context`: view, embed, edit
- `page`: Pagination
- `per_page`: Nombre d'éléments (max: 100)
- `search`: Recherche textuelle
- `after`, `before`: Filtres de date
- `author`, `author_exclude`: Filtres d'auteur
- `categories`: Filtrer par catégorie
- `orderby`: date, relevance, id, include, title, slug
- `order`: asc, desc

---

## 🎨 Stack Technique Moderne

### Frontend
- **HTML5** : Structure sémantique
- **Tailwind CSS** : Framework CSS utility-first
- **shadcn/ui** : Composants UI réutilisables
- **JavaScript moderne (ES6+)** : 
  - Fetch API pour les requêtes
  - Async/await
  - Modules ES6
  - Web Components (optionnel)

### Backend
- **PHP 8.x** : Logique serveur
- **Composer** : Gestion des dépendances
- **PSR-4** : Autoloading
- **dotenv** : Gestion de la configuration

### Outils de développement
- **Vite** : Build tool moderne (optionnel)
- **PostCSS** : Traitement CSS
- **ESLint/Prettier** : Qualité du code

---

## 📦 Architecture Proposée pour le Nouveau Site

```
CV/
├── public/                      # Dossier public (accessible web)
│   ├── index.php               # Point d'entrée
│   ├── assets/                 # Ressources statiques
│   │   ├── css/
│   │   │   └── app.css         # CSS compilé avec Tailwind
│   │   ├── js/
│   │   │   ├── app.js          # JavaScript principal
│   │   │   ├── components/     # Composants JS
│   │   │   └── utils/          # Utilitaires JS
│   │   └── images/
│   │       ├── photo/
│   │       ├── logo/
│   │       └── favicon/
│   └── cv.pdf                  # PDF du CV
│
├── src/                        # Sources (hors public)
│   ├── Config/
│   │   └── Config.php          # Configuration
│   ├── Services/
│   │   ├── ApiService.php      # Service API WordPress
│   │   └── CacheService.php    # Service de cache
│   ├── Models/
│   │   └── CV.php              # Modèle de données CV
│   ├── Controllers/
│   │   └── CVController.php    # Contrôleur CV
│   └── Views/
│       ├── layouts/
│       │   ├── header.php
│       │   ├── footer.php
│       │   └── main.php
│       └── partials/
│           ├── hero.php        # Section profil
│           ├── tabs.php        # Système d'onglets
│           └── pdf-viewer.php  # Visionneuse PDF
│
├── docs/                        # Documentation
│   ├── RAG_KNOWLEDGE_BASE.md   # Ce fichier
│   ├── API_REFERENCE.md        # Référence API
│   └── COMPONENTS.md           # Documentation composants
│
├── vendor/                      # Dépendances Composer
├── node_modules/                # Dépendances npm (si utilisé)
│
├── .env                         # Variables d'environnement
├── .env.example                 # Exemple de configuration
├── composer.json                # Dépendances PHP
├── package.json                 # Dépendances npm (optionnel)
├── tailwind.config.js           # Configuration Tailwind
└── README.md                    # Documentation projet
```

---

## 💻 Exemples de Code

### 1. Configuration API (src/Config/Config.php)

```php
<?php

namespace App\Config;

class Config
{
    private static $instance = null;
    private $config = [];

    private function __construct()
    {
        // Charger les variables d'environnement
        if (file_exists(__DIR__ . '/../../.env')) {
            $dotenv = parse_ini_file(__DIR__ . '/../../.env');
            foreach ($dotenv as $key => $value) {
                $_ENV[$key] = $value;
            }
        }

        $this->config = [
            'api' => [
                'base_url' => $_ENV['API_BASE_URL'] ?? 'https://api-cv.corbisier.fr/wp-json',
                'timeout' => $_ENV['API_TIMEOUT'] ?? 30,
                'cache_ttl' => $_ENV['CACHE_TTL'] ?? 3600,
            ],
            'app' => [
                'name' => 'Curriculum Vitae - Eric Corbisier',
                'environment' => $_ENV['APP_ENV'] ?? 'production',
                'debug' => $_ENV['APP_DEBUG'] ?? false,
            ],
            'cv' => [
                'posts' => [
                    'experience' => 128,
                    'formations' => 153,
                    'expertise' => 126,
                    'polyvalence' => 121,
                    'softskills' => 130,
                    'autre1' => 74,
                    'autre2' => 134,
                ],
                'pdf_url' => 'https://api-cv.corbisier.fr/wp-content/uploads/2025/02/CV_DW_2024_02_24.pdf',
                'photo_url' => 'https://corbisier.fr/_fonc/_img/photo_cv.jpg',
            ],
        ];
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get(string $key, $default = null)
    {
        $keys = explode('.', $key);
        $value = $this->config;

        foreach ($keys as $k) {
            if (!isset($value[$k])) {
                return $default;
            }
            $value = $value[$k];
        }

        return $value;
    }
}
```

### 2. Service API (src/Services/ApiService.php)

```php
<?php

namespace App\Services;

use App\Config\Config;

class ApiService
{
    private $config;
    private $baseUrl;
    private $cacheService;

    public function __construct()
    {
        $this->config = Config::getInstance();
        $this->baseUrl = $this->config->get('api.base_url');
        $this->cacheService = new CacheService();
    }

    /**
     * Récupère un post WordPress par son ID
     */
    public function getPost(int $id): ?array
    {
        $cacheKey = "post_{$id}";
        
        // Vérifier le cache
        if ($cached = $this->cacheService->get($cacheKey)) {
            return $cached;
        }

        $url = "{$this->baseUrl}/wp/v2/posts/{$id}";
        $response = $this->makeRequest($url);

        if ($response) {
            // Mettre en cache
            $this->cacheService->set($cacheKey, $response);
        }

        return $response;
    }

    /**
     * Récupère plusieurs posts par leurs IDs
     */
    public function getPosts(array $ids): array
    {
        $posts = [];
        foreach ($ids as $key => $id) {
            $post = $this->getPost($id);
            if ($post) {
                $posts[$key] = $post;
            }
        }
        return $posts;
    }

    /**
     * Récupère tous les posts du CV
     */
    public function getCVPosts(): array
    {
        $postIds = $this->config->get('cv.posts', []);
        return $this->getPosts($postIds);
    }

    /**
     * Effectue une requête HTTP
     */
    private function makeRequest(string $url, array $params = []): ?array
    {
        $ch = curl_init();
        
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => $this->config->get('api.timeout', 30),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json',
            ],
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        
        curl_close($ch);

        if ($error) {
            error_log("API Error: {$error}");
            return null;
        }

        if ($httpCode !== 200) {
            error_log("API HTTP Error: {$httpCode}");
            return null;
        }

        return json_decode($response, true);
    }

    /**
     * Extrait le contenu rendu d'un post
     */
    public function getPostContent(int $id): ?string
    {
        $post = $this->getPost($id);
        return $post['content']['rendered'] ?? null;
    }

    /**
     * Ajoute des icônes Font Awesome aux listes
     */
    public function addIconsToList(string $html, string $iconClass = 'fa-check'): string
    {
        return str_replace(
            '<li>',
            "<li><i class='fas {$iconClass}' aria-hidden='true'></i>&nbsp;",
            $html
        );
    }
}
```

### 3. Service de Cache (src/Services/CacheService.php)

```php
<?php

namespace App\Services;

use App\Config\Config;

class CacheService
{
    private $cacheDir;
    private $ttl;

    public function __construct()
    {
        $this->cacheDir = __DIR__ . '/../../storage/cache';
        $this->ttl = Config::getInstance()->get('api.cache_ttl', 3600);
        
        // Créer le dossier cache s'il n'existe pas
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0755, true);
        }
    }

    /**
     * Récupère une valeur du cache
     */
    public function get(string $key)
    {
        $file = $this->getCacheFile($key);
        
        if (!file_exists($file)) {
            return null;
        }

        $data = json_decode(file_get_contents($file), true);
        
        // Vérifier l'expiration
        if ($data['expires_at'] < time()) {
            unlink($file);
            return null;
        }

        return $data['value'];
    }

    /**
     * Stocke une valeur dans le cache
     */
    public function set(string $key, $value, ?int $ttl = null): bool
    {
        $file = $this->getCacheFile($key);
        $ttl = $ttl ?? $this->ttl;

        $data = [
            'value' => $value,
            'expires_at' => time() + $ttl,
        ];

        return file_put_contents($file, json_encode($data)) !== false;
    }

    /**
     * Supprime une valeur du cache
     */
    public function delete(string $key): bool
    {
        $file = $this->getCacheFile($key);
        
        if (file_exists($file)) {
            return unlink($file);
        }

        return true;
    }

    /**
     * Vide tout le cache
     */
    public function clear(): bool
    {
        $files = glob($this->cacheDir . '/*');
        
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }

        return true;
    }

    /**
     * Obtient le chemin du fichier cache
     */
    private function getCacheFile(string $key): string
    {
        return $this->cacheDir . '/' . md5($key) . '.cache';
    }
}
```

### 4. Contrôleur CV (src/Controllers/CVController.php)

```php
<?php

namespace App\Controllers;

use App\Services\ApiService;
use App\Config\Config;

class CVController
{
    private $apiService;
    private $config;

    public function __construct()
    {
        $this->apiService = new ApiService();
        $this->config = Config::getInstance();
    }

    /**
     * Affiche la page principale du CV
     */
    public function index(): void
    {
        $data = [
            'title' => $this->config->get('app.name'),
            'sections' => $this->getSections(),
            'activeTab' => $_GET['section'] ?? 'experience',
            'photo_url' => $this->config->get('cv.photo_url'),
            'pdf_url' => $this->config->get('cv.pdf_url'),
            'profile' => $this->getProfile(),
        ];

        $this->render('main', $data);
    }

    /**
     * Retourne les données pour une requête AJAX
     */
    public function ajaxGetSections(): void
    {
        header('Content-Type: application/json');
        echo json_encode($this->getSections());
    }

    /**
     * Récupère toutes les sections du CV
     */
    private function getSections(): array
    {
        $posts = $this->apiService->getCVPosts();
        $sections = [];

        foreach ($posts as $key => $post) {
            if ($post) {
                $sections[$key] = [
                    'title' => $post['title']['rendered'] ?? '',
                    'content' => $this->apiService->addIconsToList(
                        $post['content']['rendered'] ?? '',
                        'fa-check'
                    ),
                ];
            }
        }

        return $sections;
    }

    /**
     * Récupère les informations de profil
     */
    private function getProfile(): array
    {
        return [
            'name' => 'Eric Corbisier',
            'job' => 'Développeur Web',
            'description' => 'Fort de 30 ans de passion dans le développement, je souhaite en faire mon métier',
            'email' => 'emploi@corbisier.fr',
            'phone' => '0650469120',
            'websites' => [
                'https://lescorbycats.fr',
                'https://corbisier.fr',
            ],
            'misc' => 'Permis B',
        ];
    }

    /**
     * Rendu d'une vue
     */
    private function render(string $view, array $data = []): void
    {
        extract($data);
        require __DIR__ . "/../Views/layouts/{$view}.php";
    }
}
```

### 5. Vue principale (src/Views/layouts/main.php)

```php
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($profile['description']) ?>">
    <title><?= htmlspecialchars($title) ?></title>
    
    <!-- Tailwind CSS -->
    <link href="/assets/css/app.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/assets/images/favicon/favicon.png">
</head>
<body class="bg-gray-50 font-sans antialiased">
    
    <!-- Loader -->
    <div id="loader" class="fixed inset-0 bg-white z-50 flex items-center justify-center">
        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-blue-500"></div>
    </div>

    <!-- Header -->
    <?php require __DIR__ . '/header.php'; ?>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        
        <!-- Section Profil -->
        <?php require __DIR__ . '/../partials/hero.php'; ?>

        <!-- Onglets -->
        <div class="mt-12">
            <?php require __DIR__ . '/../partials/tabs.php'; ?>
        </div>

        <!-- Visionneuse PDF -->
        <div class="mt-12">
            <?php require __DIR__ . '/../partials/pdf-viewer.php'; ?>
        </div>

    </main>

    <!-- Footer -->
    <?php require __DIR__ . '/footer.php'; ?>

    <!-- JavaScript -->
    <script src="/assets/js/app.js" type="module"></script>
</body>
</html>
```

### 6. Composant Hero (src/Views/partials/hero.php)

```php
<section class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="md:flex">
        <!-- Photo -->
        <div class="md:w-1/3 lg:w-1/4">
            <img 
                src="<?= htmlspecialchars($photo_url) ?>" 
                alt="<?= htmlspecialchars($profile['name']) ?>"
                class="w-full h-full object-cover"
                loading="lazy"
            >
        </div>

        <!-- Informations -->
        <div class="md:w-2/3 lg:w-3/4 p-6 lg:p-8">
            <div class="grid md:grid-cols-2 gap-6">
                
                <!-- Colonne gauche -->
                <div class="space-y-4">
                    <h1 class="text-4xl lg:text-5xl font-bold text-gray-900">
                        <?= htmlspecialchars($profile['name']) ?>
                    </h1>
                    
                    <div class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <h2 class="font-bold text-sm uppercase text-gray-600 mb-2">
                            Métier, poste
                        </h2>
                        <p class="text-gray-900"><?= htmlspecialchars($profile['job']) ?></p>
                    </div>
                    
                    <div class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <h2 class="font-bold text-sm uppercase text-gray-600 mb-2">
                            Description
                        </h2>
                        <p class="text-gray-900 whitespace-pre-line">
                            <?= htmlspecialchars($profile['description']) ?>
                        </p>
                    </div>
                </div>

                <!-- Colonne droite -->
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        
                        <!-- Sites Web -->
                        <div class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <h2 class="font-bold text-sm uppercase text-gray-600 mb-2">
                                Mes Sites Web
                            </h2>
                            <div class="space-y-1">
                                <?php foreach ($profile['websites'] as $website): ?>
                                    <a 
                                        href="<?= htmlspecialchars($website) ?>" 
                                        class="block text-blue-600 hover:underline"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >
                                        <?= htmlspecialchars(parse_url($website, PHP_URL_HOST)) ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Divers -->
                        <div class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <h2 class="font-bold text-sm uppercase text-gray-600 mb-2">
                                Divers
                            </h2>
                            <p class="text-gray-900"><?= htmlspecialchars($profile['misc']) ?></p>
                        </div>

                        <!-- Contact -->
                        <div class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition col-span-2">
                            <h2 class="font-bold text-sm uppercase text-gray-600 mb-2">
                                Contact
                            </h2>
                            <div class="space-y-1">
                                <a 
                                    href="mailto:<?= htmlspecialchars($profile['email']) ?>" 
                                    class="block text-blue-600 hover:underline"
                                >
                                    <i class="fas fa-envelope mr-2"></i>
                                    <?= htmlspecialchars($profile['email']) ?>
                                </a>
                                <a 
                                    href="tel:<?= htmlspecialchars($profile['phone']) ?>" 
                                    class="block text-blue-600 hover:underline"
                                >
                                    <i class="fas fa-phone mr-2"></i>
                                    <?= htmlspecialchars($profile['phone']) ?>
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

### 7. Composant Onglets (src/Views/partials/tabs.php)

```php
<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    
    <!-- Boutons d'onglets -->
    <div class="border-b border-gray-200">
        <nav class="flex flex-wrap -mb-px" aria-label="Tabs">
            <?php
            $tabs = [
                'experience' => 'Expérience',
                'formations' => 'Formations',
                'expertise' => 'Expertise',
                'polyvalence' => 'Polyvalence',
                'softskills' => 'Soft Skills',
            ];
            ?>
            <?php foreach ($tabs as $key => $label): ?>
                <button
                    type="button"
                    data-tab="<?= $key ?>"
                    class="tab-button px-6 py-4 text-sm font-medium border-b-2 transition-colors
                        <?= $activeTab === $key 
                            ? 'border-blue-500 text-blue-600' 
                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' 
                        ?>"
                    onclick="switchTab('<?= $key ?>')"
                >
                    <?= htmlspecialchars($label) ?>
                </button>
            <?php endforeach; ?>
        </nav>
    </div>

    <!-- Contenu des onglets -->
    <div class="p-6 lg:p-8">
        <?php foreach ($tabs as $key => $label): ?>
            <div 
                id="tab-content-<?= $key ?>" 
                class="tab-content <?= $activeTab !== $key ? 'hidden' : '' ?>"
            >
                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                    <?= htmlspecialchars($sections[$key]['title'] ?? $label) ?>
                </h2>
                <div class="prose max-w-none">
                    <div class="content-loader">
                        <div class="animate-pulse space-y-4">
                            <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                            <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                        </div>
                    </div>
                    <div class="content-data hidden">
                        <?= $sections[$key]['content'] ?? '' ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
```

### 8. JavaScript moderne (public/assets/js/app.js)

```javascript
/**
 * Application principale
 */
class CVApp {
    constructor() {
        this.currentTab = this.getTabFromURL() || 'experience';
        this.sections = {};
        this.init();
    }

    async init() {
        console.log('Initialisation de l\'application CV...');
        
        // Charger les données
        await this.loadSections();
        
        // Afficher le contenu
        this.displayContent();
        
        // Masquer le loader
        this.hideLoader();
        
        // Initialiser les événements
        this.initEvents();
    }

    /**
     * Charge toutes les sections depuis l'API
     */
    async loadSections() {
        try {
            // Simuler un appel API (remplacer par vraie requête)
            // const response = await fetch('/api/sections');
            // this.sections = await response.json();
            
            // Pour l'instant, récupérer depuis le DOM
            const contentDivs = document.querySelectorAll('[id^="tab-content-"]');
            contentDivs.forEach(div => {
                const key = div.id.replace('tab-content-', '');
                const contentData = div.querySelector('.content-data');
                if (contentData) {
                    this.sections[key] = contentData.innerHTML;
                }
            });
        } catch (error) {
            console.error('Erreur lors du chargement des sections:', error);
        }
    }

    /**
     * Affiche le contenu des sections
     */
    displayContent() {
        Object.keys(this.sections).forEach(key => {
            const contentDiv = document.querySelector(`#tab-content-${key} .content-data`);
            const loaderDiv = document.querySelector(`#tab-content-${key} .content-loader`);
            
            if (contentDiv && loaderDiv) {
                loaderDiv.classList.add('hidden');
                contentDiv.classList.remove('hidden');
            }
        });
    }

    /**
     * Masque le loader
     */
    hideLoader() {
        const loader = document.getElementById('loader');
        if (loader) {
            setTimeout(() => {
                loader.style.opacity = '0';
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 300);
            }, 500);
        }
    }

    /**
     * Récupère l'onglet actif depuis l'URL
     */
    getTabFromURL() {
        const params = new URLSearchParams(window.location.search);
        return params.get('section');
    }

    /**
     * Change d'onglet
     */
    switchTab(tabKey) {
        // Masquer tous les contenus
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });

        // Retirer la classe active de tous les boutons
        document.querySelectorAll('.tab-button').forEach(button => {
            button.classList.remove('border-blue-500', 'text-blue-600');
            button.classList.add('border-transparent', 'text-gray-500');
        });

        // Afficher le contenu sélectionné
        const selectedContent = document.getElementById(`tab-content-${tabKey}`);
        if (selectedContent) {
            selectedContent.classList.remove('hidden');
        }

        // Activer le bouton sélectionné
        const selectedButton = document.querySelector(`[data-tab="${tabKey}"]`);
        if (selectedButton) {
            selectedButton.classList.add('border-blue-500', 'text-blue-600');
            selectedButton.classList.remove('border-transparent', 'text-gray-500');
        }

        // Mettre à jour l'URL
        const url = new URL(window.location);
        url.searchParams.set('section', tabKey);
        window.history.pushState({}, '', url);

        // Scroller vers les onglets
        document.getElementById('cv-tabs')?.scrollIntoView({ 
            behavior: 'smooth',
            block: 'start'
        });
    }

    /**
     * Initialise les événements
     */
    initEvents() {
        // Gestion du bouton retour du navigateur
        window.addEventListener('popstate', () => {
            const tab = this.getTabFromURL() || 'experience';
            this.switchTab(tab);
        });
    }
}

/**
 * Fonction globale pour changer d'onglet (appelée depuis le HTML)
 */
window.switchTab = function(tabKey) {
    if (window.cvApp) {
        window.cvApp.switchTab(tabKey);
    }
};

/**
 * Initialisation au chargement de la page
 */
document.addEventListener('DOMContentLoaded', () => {
    window.cvApp = new CVApp();
});
```

### 9. Configuration Tailwind (tailwind.config.js)

```javascript
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./public/**/*.{html,js}",
    "./src/Views/**/*.php",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#eff6ff',
          100: '#dbeafe',
          200: '#bfdbfe',
          300: '#93c5fd',
          400: '#60a5fa',
          500: '#3b82f6',
          600: '#2563eb',
          700: '#1d4ed8',
          800: '#1e40af',
          900: '#1e3a8a',
        },
      },
      fontFamily: {
        sans: ['Quicksand', 'system-ui', 'sans-serif'],
        mono: ['Roboto Mono', 'monospace'],
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
  ],
}
```

### 10. Fichier .env.example

```env
# Application
APP_NAME="Curriculum Vitae - Eric Corbisier"
APP_ENV=production
APP_DEBUG=false

# API WordPress
API_BASE_URL=https://api-cv.corbisier.fr/wp-json
API_TIMEOUT=30

# Cache
CACHE_TTL=3600
CACHE_ENABLED=true

# CV Posts IDs
CV_POST_EXPERIENCE=128
CV_POST_FORMATIONS=153
CV_POST_EXPERTISE=126
CV_POST_POLYVALENCE=121
CV_POST_SOFTSKILLS=130
CV_POST_AUTRE1=74
CV_POST_AUTRE2=134

# Ressources
CV_PDF_URL=https://api-cv.corbisier.fr/wp-content/uploads/2025/02/CV_DW_2024_02_24.pdf
CV_PHOTO_URL=https://corbisier.fr/_fonc/_img/photo_cv.jpg
```

### 11. Composer.json

```json
{
    "name": "eric/cv-moderne",
    "description": "Site CV moderne avec PHP et Tailwind CSS",
    "type": "project",
    "require": {
        "php": ">=8.0",
        "ext-curl": "*",
        "ext-json": "*"
    },
    "require-dev": {
        "symfony/var-dumper": "^6.0"
    },
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    },
    "config": {
        "optimize-autoloader": true,
        "preferred-install": "dist",
        "sort-packages": true
    }
}
```

---

## 🎯 Fonctionnalités Modernes à Implémenter

### 1. Performances
- ✅ Cache des données API
- ✅ Lazy loading des images
- ✅ Minification CSS/JS
- 🔲 Service Worker pour le mode hors ligne
- 🔲 Préchargement des ressources critiques

### 2. UX/UI
- ✅ Design responsive (mobile-first)
- ✅ Animations fluides (Tailwind transitions)
- ✅ Loading states
- 🔲 Mode sombre
- 🔲 Accessibilité (ARIA labels, navigation clavier)

### 3. SEO
- 🔲 Métadonnées Open Graph
- 🔲 Schema.org markup (Person, Resume)
- 🔲 Sitemap.xml
- 🔲 robots.txt

### 4. Sécurité
- ✅ Protection CSRF
- ✅ Échappement des données
- ✅ Variables d'environnement
- 🔲 Headers de sécurité (CSP, HSTS)
- 🔲 Rate limiting sur l'API

---

## 📊 Diagramme de Flux de Données

```
Navigateur
    ↓
public/index.php
    ↓
CVController::index()
    ↓
ApiService::getCVPosts()
    ↓
CacheService::get() → [Cache existe?]
    ↓ Non                    ↓ Oui
API WordPress          Retour cache
    ↓
CacheService::set()
    ↓
Vue (main.php) ← Données formatées
    ↓
HTML + Tailwind CSS
    ↓
JavaScript (app.js)
    ↓
Interaction utilisateur
```

---

## 🚀 Instructions de Déploiement

### Prérequis
- PHP 8.0+
- Composer
- Node.js + npm (pour Tailwind)
- Serveur web (Apache/Nginx)

### Installation

```bash
# 1. Cloner le projet
cd /chemin/vers/CV

# 2. Installer les dépendances PHP
composer install

# 3. Installer les dépendances npm (si utilisé)
npm install

# 4. Copier et configurer l'environnement
cp .env.example .env
# Éditer .env avec vos paramètres

# 5. Compiler Tailwind CSS
npm run build

# 6. Créer les dossiers nécessaires
mkdir -p storage/cache
chmod -R 775 storage

# 7. Configurer le serveur web
# Pointer le document root vers /public
```

### Configuration Apache (.htaccess)

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    
    # Rediriger vers index.php si le fichier n'existe pas
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php [QSA,L]
</IfModule>

# Sécurité
<FilesMatch "\.(env|log|md)$">
    Order allow,deny
    Deny from all
</FilesMatch>
```

### Configuration Nginx

```nginx
server {
    listen 80;
    server_name cv.example.com;
    root /var/www/CV/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    location ~ /\.(env|git|htaccess) {
        deny all;
    }
}
```

---

## 📝 Checklist de Développement

### Phase 1: Configuration
- [ ] Initialiser Composer
- [ ] Configurer Tailwind CSS
- [ ] Créer structure de dossiers
- [ ] Configurer autoloading PSR-4
- [ ] Créer fichier .env

### Phase 2: Backend
- [ ] Config.php - Configuration centralisée
- [ ] ApiService.php - Service API WordPress
- [ ] CacheService.php - Système de cache
- [ ] CVController.php - Contrôleur principal

### Phase 3: Frontend
- [ ] Layout principal (main.php)
- [ ] Header et Footer
- [ ] Composant Hero (profil)
- [ ] Composant Tabs (onglets)
- [ ] Composant PDF Viewer
- [ ] Styles Tailwind personnalisés

### Phase 4: JavaScript
- [ ] app.js - Application principale
- [ ] Gestion des onglets
- [ ] Chargement AJAX
- [ ] Gestion de l'historique
- [ ] Animations

### Phase 5: Optimisation
- [ ] Minification CSS/JS
- [ ] Optimisation images
- [ ] Configuration du cache
- [ ] Tests de performance

### Phase 6: Tests & Déploiement
- [ ] Tests sur différents navigateurs
- [ ] Tests responsive
- [ ] Validation W3C
- [ ] Tests de sécurité
- [ ] Déploiement production

---

## 🔗 Ressources Utiles

### Documentation
- [WordPress REST API](https://developer.wordpress.org/rest-api/)
- [Tailwind CSS](https://tailwindcss.com/docs)
- [shadcn/ui](https://ui.shadcn.com/)
- [PHP PSR-4](https://www.php-fig.org/psr/psr-4/)

### Outils
- [Postman](https://www.postman.com/) - Test API
- [TailwindUI](https://tailwindui.com/) - Composants Tailwind
- [Font Awesome](https://fontawesome.com/) - Icônes
- [Google Fonts](https://fonts.google.com/) - Polices

---

## 💡 Points d'Attention

### API WordPress
- Toujours gérer les erreurs API (timeout, 404, 500)
- Implémenter un système de cache robuste
- Prévoir un fallback si l'API est indisponible

### Performance
- Le cache est crucial pour éviter trop de requêtes API
- Optimiser les images (WebP, tailles adaptées)
- Utiliser le lazy loading

### Sécurité
- Ne jamais exposer les clés API dans le frontend
- Valider et échapper toutes les données
- Utiliser HTTPS en production

### Maintenance
- Logger les erreurs dans un fichier
- Versionner le code avec Git
- Documenter les changements importants

---

## 📞 Support

Pour toute question sur cette base de connaissances :
- Email: emploi@corbisier.fr
- GitHub: [Créer une issue](https://github.com/LeZouzouEnWeb/mon_cv_frontend/issues)

---

*Dernière mise à jour : 17 décembre 2024*
