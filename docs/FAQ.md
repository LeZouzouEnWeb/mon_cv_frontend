# 💡 Réponses aux Questions Importantes

## 1️⃣ Le domaine pointe vers ./public ?

### ✅ OUI, c'est pris en compte !

Le projet est conçu pour que le DocumentRoot de votre serveur web pointe vers le dossier `public/`.

**Configuration Apache** (dans votre VirtualHost) :

```apache
DocumentRoot /var/www/cv/public

<Directory /var/www/cv/public>
    AllowOverride All
    Require all granted
</Directory>
```

**Configuration Nginx** :

```nginx
server {
    root /var/www/cv/public;  # ← Pointe vers public/
    index index.php;
    # ...
}
```

**Structure des chemins** :

```
Racine du projet : /var/www/cv/
DocumentRoot web : /var/www/cv/public/  ← Le domaine pointe ici

Accès web :
https://votre-domaine.fr/           → public/index.php
https://votre-domaine.fr/assets/    → public/assets/
https://votre-domaine.fr/test.php   → public/test.php

Fichiers protégés (hors DocumentRoot) :
/var/www/cv/src/        ← Inaccessible via web ✅
/var/www/cv/cache/      ← Inaccessible via web ✅
/var/www/cv/.env        ← Inaccessible via web ✅
```

---

## 2️⃣ Serveur PHP compatible avec Node.js ?

### ✅ OUI, mais Node.js N'EST PAS nécessaire sur le serveur !

### Comprendre le rôle de chaque technologie

```
┌─────────────────────────────────────────────────────────────┐
│  SUR VOTRE PC (Développement)                               │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│  1. Vous éditez le code source :                            │
│     - resources/css/app.css  (Tailwind CSS source)          │
│     - resources/js/app.js    (JavaScript source)            │
│                                                             │
│  2. Node.js compile les assets :                            │
│     npm run build                                           │
│     ├─> Tailwind CSS compile → public/assets/css/app.css   │
│     └─> esbuild compile      → public/assets/js/app.js     │
│                                                             │
│  3. Vous testez avec PHP :                                  │
│     php -S localhost:8000 -t public                         │
│                                                             │
└─────────────────────────────────────────────────────────────┘

                            ⬇️  Transfert FTP/Git

┌─────────────────────────────────────────────────────────────┐
│  SUR LE SERVEUR (Production)                                │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│  Fichiers transférés :                                      │
│  ✅ public/assets/css/app.css  (DÉJÀ compilé)               │
│  ✅ public/assets/js/app.js    (DÉJÀ compilé)               │
│  ✅ src/                       (Code PHP)                   │
│  ✅ composer.json              (Dépendances PHP)            │
│                                                             │
│  Fichiers NON transférés :                                  │
│  ❌ node_modules/              (Pas besoin !)               │
│  ❌ resources/                 (Sources non compilées)      │
│  ❌ package.json               (Pas besoin !)               │
│                                                             │
│  Le serveur exécute :                                       │
│  ✅ PHP uniquement                                          │
│  ✅ Composer (dépendances PHP)                              │
│  ❌ Node.js (PAS nécessaire)                                │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

### En résumé

| Technologie | Sur PC | Sur Serveur | Pourquoi ?                                   |
| ----------- | ------ | ----------- | -------------------------------------------- |
| PHP         | ✅ Oui | ✅ Oui      | Exécute l'application                        |
| Composer    | ✅ Oui | ✅ Oui      | Gère les dépendances PHP (Guzzle, phpdotenv) |
| Node.js     | ✅ Oui | ❌ Non      | Compile CSS/JS **avant** transfert           |
| npm         | ✅ Oui | ❌ Non      | Installe Tailwind, esbuild **en local**      |

---

## 🎯 Workflow Complet

### Première fois

```bash
# 1. Sur votre PC Windows
git clone https://github.com/LeZouzouEnWeb/mon_cv_frontend.git
cd mon_cv_frontend

# 2. Installer les dépendances de DÉVELOPPEMENT
composer install
npm install

# 3. Compiler les assets
npm run build
# OU utiliser le script
.\build.ps1

# 4. Tester en local
php -S localhost:8000 -t public

# 5. Transférer sur le serveur (via FTP ou Git)
# Transférer : public/, src/, cache/, logs/, composer.json, .env
# NE PAS transférer : node_modules/, resources/, package.json

# 6. Sur le serveur (via SSH)
composer install --no-dev --optimize-autoloader
chmod -R 775 cache/ logs/
```

### Modifications futures (exemple : changer une couleur)

```bash
# 1. Sur PC : Modifier resources/css/app.css
# Exemple : changer la couleur primaire

# 2. Recompiler
npm run build

# 3. Transférer UNIQUEMENT le fichier modifié
# Via FTP : public/assets/css/app.css
# Via Git :
git add public/assets/css/app.css
git commit -m "Update primary color"
git push

# 4. Sur serveur : Si Git
git pull

# 5. Vider le cache navigateur
# Ctrl + F5 ou Ctrl + Shift + R
```

---

## 🆘 Que faire si je n'ai pas Node.js ?

### Option A : Utiliser Tailwind CSS via CDN (simple mais moins optimal)

Dans `src/Views/layouts/base.php`, remplacer :

```php
<!-- Supprimer -->
<link rel="stylesheet" href="<?= Helpers::asset('css/app.css') ?>">

<!-- Par -->
<script src="https://cdn.tailwindcss.com"></script>
<style>
  /* Styles personnalisés ici */
</style>
```

**⚠️ Inconvénients** :

- Fichier plus lourd (~350 KB vs ~10 KB compilé)
- Moins de contrôle sur la configuration
- Non recommandé pour la production

### Option B : Installer Node.js (recommandé)

1. Télécharger : https://nodejs.org/
2. Installer (suivre l'assistant)
3. Vérifier : `node -v` et `npm -v`
4. Lancer `npm install` puis `npm run build`

### Option C : Utiliser un service de build en ligne

Utiliser un service comme **CodeSandbox** ou **StackBlitz** pour compiler, puis télécharger les assets.

---

## 📝 Fichiers Essentiels à Comprendre

### Sur le serveur (production)

```
public/
├── index.php              ← Point d'entrée (reçoit toutes les requêtes)
├── .htaccess             ← Règles Apache (redirection vers index.php)
└── assets/
    ├── css/
    │   └── app.css       ← CSS compilé (DOIT exister)
    └── js/
        └── app.js        ← JS compilé (DOIT exister)

src/
├── Controllers/
│   └── CvController.php  ← Logique métier
├── Services/
│   ├── ApiService.php    ← Appels API WordPress
│   └── CacheService.php  ← Gestion du cache
└── Views/
    └── pages/
        └── cv.php        ← Template HTML

.env                      ← Configuration (API, cache, etc.)
composer.json             ← Dépendances PHP
```

### Sur votre PC (développement)

```
resources/
├── css/
│   └── app.css           ← Source Tailwind (vous éditez ici)
└── js/
    └── app.js            ← Source JS (vous éditez ici)

package.json              ← Dépendances Node.js (Tailwind, esbuild)
tailwind.config.js        ← Configuration Tailwind
```

---

## ✅ Vérifications Rapides

### Le site fonctionne ?

```bash
# Vérifier que PHP fonctionne
php -v
# Doit afficher : PHP 8.0.x ou supérieur

# Vérifier que les assets existent
ls -la public/assets/css/app.css
ls -la public/assets/js/app.js
# Doivent exister et avoir une taille > 0

# Vérifier les permissions
ls -la cache/ logs/
# Doivent être en lecture/écriture (775)

# Tester la connexion à l'API
curl https://api-cv.corbisier.fr/wp-json
# Doit retourner du JSON
```

### Le cache fonctionne ?

```bash
# Le dossier cache/ doit contenir des fichiers après la première visite
ls -la cache/
# Exemple : abc123def456.cache

# Pour vider le cache
rm -rf cache/*
```

---

## 📞 Besoin d'Aide ?

1. Lire [QUICK_DEPLOY.md](QUICK_DEPLOY.md) - Guide de déploiement
2. Lire [DEPLOYMENT.md](DEPLOYMENT.md) - Documentation complète
3. Ouvrir une issue GitHub
4. Envoyer un email à emploi@corbisier.fr

---

_Ces réponses clarifient les deux questions principales sur Node.js et DocumentRoot_
