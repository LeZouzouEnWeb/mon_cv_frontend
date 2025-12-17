# 🚀 Guide de Démarrage - CV Moderne

## Prérequis

- PHP 8.0 ou supérieur
- Composer
- Serveur web (Apache/Nginx) ou PHP built-in server
- Node.js et npm (pour Tailwind CSS)

---

## Installation

### 1. Cloner le projet

```bash
git clone https://github.com/LeZouzouEnWeb/mon_cv_frontend.git
cd mon_cv_frontend
```

### 2. Installer les dépendances PHP

```bash
composer install
```

### 3. Installer les dépendances Node.js

```bash
npm install
```

### 4. Configurer l'environnement

Créer un fichier `.env` à la racine :

```env
# API Configuration
API_BASE_URL=https://api-cv.corbisier.fr/wp-json
API_TIMEOUT=10

# Cache Configuration
CACHE_ENABLED=true
CACHE_DURATION=3600

# Environment
APP_ENV=development
APP_DEBUG=true

# Security
SESSION_NAME=cv_session
SESSION_LIFETIME=7200
```

### 5. Compiler les assets

```bash
# Mode développement avec watch
npm run dev

# Mode production
npm run build
```

### 6. Lancer le serveur de développement

```bash
# Option 1: Serveur PHP built-in
php -S localhost:8000 -t public

# Option 2: Avec Docker
docker-compose up -d
```

### 7. Accéder au site

Ouvrir le navigateur : `http://localhost:8000`

---

## Structure du Projet

```
mon_cv_frontend/
├── public/                      # Dossier public (DocumentRoot)
│   ├── index.php               # Point d'entrée
│   ├── assets/                 # Assets compilés
│   │   ├── css/
│   │   │   └── app.css         # CSS compilé
│   │   └── js/
│   │       └── app.js          # JS compilé
│   └── images/                 # Images publiques
├── src/                        # Code source
│   ├── Controllers/            # Contrôleurs
│   │   ├── CvController.php
│   │   └── HomeController.php
│   ├── Services/               # Services (API, Cache)
│   │   ├── ApiService.php
│   │   └── CacheService.php
│   ├── Views/                  # Templates PHP
│   │   ├── layouts/
│   │   │   ├── base.php
│   │   │   └── header.php
│   │   └── pages/
│   │       └── cv.php
│   └── Utils/                  # Utilitaires
│       └── Helpers.php
├── resources/                  # Ressources non compilées
│   ├── css/
│   │   └── app.css            # Tailwind source
│   └── js/
│       └── app.js             # JavaScript source
├── cache/                      # Fichiers de cache
├── logs/                       # Logs
├── config/                     # Configuration
│   └── api.php
├── docs/                       # Documentation
│   ├── RAG_KNOWLEDGE_BASE.md
│   ├── API_REFERENCE.md
│   ├── COMPONENTS.md
│   └── GETTING_STARTED.md
├── composer.json               # Dépendances PHP
├── package.json                # Dépendances Node.js
├── tailwind.config.js          # Configuration Tailwind
├── postcss.config.js           # Configuration PostCSS
├── .env                        # Variables d'environnement
├── .env.example                # Exemple de configuration
├── .gitignore
└── README.md
```

---

## Configuration de Composer

Fichier `composer.json` :

```json
{
    "name": "lezouzouenweb/mon_cv_frontend",
    "description": "CV moderne avec WordPress API",
    "type": "project",
    "require": {
        "php": "^8.0",
        "guzzlehttp/guzzle": "^7.8",
        "vlucas/phpdotenv": "^5.6"
    },
    "require-dev": {
        "phpstan/phpstan": "^1.10"
    },
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
}
```

---

## Configuration de NPM

Fichier `package.json` :

```json
{
  "name": "mon-cv-frontend",
  "version": "1.0.0",
  "description": "CV moderne avec Tailwind CSS",
  "scripts": {
    "dev": "concurrently \"npm run watch:css\" \"npm run watch:js\"",
    "build": "npm run build:css && npm run build:js",
    "watch:css": "tailwindcss -i ./resources/css/app.css -o ./public/assets/css/app.css --watch",
    "build:css": "tailwindcss -i ./resources/css/app.css -o ./public/assets/css/app.css --minify",
    "watch:js": "esbuild resources/js/app.js --bundle --outfile=public/assets/js/app.js --watch",
    "build:js": "esbuild resources/js/app.js --bundle --minify --outfile=public/assets/js/app.js"
  },
  "devDependencies": {
    "tailwindcss": "^3.4.0",
    "autoprefixer": "^10.4.16",
    "postcss": "^8.4.32",
    "esbuild": "^0.19.11",
    "concurrently": "^8.2.2"
  }
}
```

---

## Configuration de Tailwind CSS

Fichier `tailwind.config.js` :

```javascript
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./public/**/*.php",
    "./src/Views/**/*.php",
    "./resources/js/**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#f0f9ff',
          100: '#e0f2fe',
          200: '#bae6fd',
          300: '#7dd3fc',
          400: '#38bdf8',
          500: '#0ea5e9',
          600: '#0284c7',
          700: '#0369a1',
          800: '#075985',
          900: '#0c4a6e',
        },
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', 'sans-serif'],
        heading: ['Poppins', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
```

---

## Configuration PostCSS

Fichier `postcss.config.js` :

```javascript
module.exports = {
  plugins: {
    tailwindcss: {},
    autoprefixer: {},
  }
}
```

---

## Fichier .gitignore

```gitignore
# Dependencies
/vendor/
/node_modules/

# Cache & Logs
/cache/*
!/cache/.gitkeep
/logs/*
!/logs/.gitkeep

# Environment
.env
.env.local

# Compiled assets
/public/assets/css/*.css
/public/assets/js/*.js
!/public/assets/.gitkeep

# IDE
.idea/
.vscode/
*.swp
*.swo
*~

# OS
.DS_Store
Thumbs.db

# Composer
composer.lock
```

---

## Premier Test

### 1. Vérifier l'API

```bash
curl https://api-cv.corbisier.fr/wp-json
```

### 2. Créer un test simple

Créer `public/test-api.php` :

```php
<?php
require_once __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'https://api-cv.corbisier.fr/wp-json/',
    'timeout' => 10,
]);

try {
    $response = $client->get('wp/v2/posts/128');
    $data = json_decode($response->getBody(), true);
    
    echo "<h1>Test API - Post #128</h1>";
    echo "<h2>" . htmlspecialchars($data['title']['rendered']) . "</h2>";
    echo "<div>" . $data['content']['rendered'] . "</div>";
} catch (\Exception $e) {
    echo "Erreur: " . $e->getMessage();
}
```

Accéder à : `http://localhost:8000/test-api.php`

---

## Commandes Utiles

### Développement

```bash
# Lancer le serveur PHP
php -S localhost:8000 -t public

# Compiler en mode watch
npm run dev

# Vider le cache
rm -rf cache/*

# Vérifier le code PHP
vendor/bin/phpstan analyse src
```

### Production

```bash
# Build des assets
npm run build

# Optimiser l'autoload
composer dump-autoload --optimize

# Désactiver le debug
# Dans .env : APP_DEBUG=false
```

---

## Résolution de Problèmes

### L'API ne répond pas

1. Vérifier la connexion Internet
2. Tester avec curl : `curl https://api-cv.corbisier.fr/wp-json`
3. Vérifier les logs : `tail -f logs/app.log`

### Les styles ne s'appliquent pas

1. Vérifier que Tailwind compile : `npm run dev`
2. Vérifier le chemin dans le HTML : `/assets/css/app.css`
3. Vider le cache du navigateur

### Erreur 500

1. Activer l'affichage des erreurs dans `.env`
2. Vérifier les logs PHP
3. Vérifier les permissions des dossiers `cache/` et `logs/`

---

## Prochaines Étapes

1. ✅ Lire la documentation dans [RAG_KNOWLEDGE_BASE.md](RAG_KNOWLEDGE_BASE.md)
2. ✅ Consulter la référence API dans [API_REFERENCE.md](API_REFERENCE.md)
3. ✅ Découvrir les composants dans [COMPONENTS.md](COMPONENTS.md)
4. 🚀 Commencer le développement !

---

## Support

- **Documentation** : Dossier `docs/`
- **Issues** : [GitHub Issues](https://github.com/LeZouzouEnWeb/mon_cv_frontend/issues)
- **Email** : emploi@corbisier.fr

---

*Bonne chance avec votre projet ! 🎉*
