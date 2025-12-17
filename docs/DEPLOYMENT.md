# Guide de Déploiement sur Serveur PHP

## 📋 Prérequis Serveur de Production

- ✅ PHP 8.0 ou supérieur
- ✅ Composer
- ✅ Serveur web (Apache/Nginx) configuré avec DocumentRoot sur `public/`
- ❌ **Node.js NON requis** (assets déjà compilés)

---

## 🚀 Méthode 1 : Déploiement avec Assets Pré-compilés (Recommandé)

### Sur votre machine locale (avec Node.js)

```bash
# 1. Installer les dépendances
npm install

# 2. Compiler les assets pour la production
npm run build

# Cela génère :
# - public/assets/css/app.css (minifié)
# - public/assets/js/app.js (minifié)
```

### Sur le serveur (sans Node.js)

```bash
# 1. Transférer les fichiers (FTP, Git, etc.)
# Fichiers essentiels à transférer :
# - public/
# - src/
# - cache/
# - logs/
# - composer.json
# - .env (configuré pour production)

# 2. Installer les dépendances PHP uniquement
composer install --no-dev --optimize-autoloader

# 3. Créer le fichier .env pour la production
cat > .env << 'EOF'
# API Configuration
API_BASE_URL=https://api-cv.corbisier.fr/wp-json
API_TIMEOUT=10

# Cache Configuration
CACHE_ENABLED=true
CACHE_DURATION=3600

# Environment
APP_ENV=production
APP_DEBUG=false
APP_NAME="CV Eric Corbisier"

# Security
SESSION_NAME=cv_session
SESSION_LIFETIME=7200

# Logs
LOG_ENABLED=true
LOG_LEVEL=error
EOF

# 4. Vérifier les permissions
chmod -R 755 public/
chmod -R 775 cache/ logs/

# 5. Tester
php -v  # Vérifier la version PHP
```

---

## 🚀 Méthode 2 : Déploiement via Git (avec build automatique)

### Configuration du dépôt

Créer un fichier `.gitattributes` à la racine :

```gitattributes
# Inclure les assets compilés dans Git
public/assets/css/app.css -diff
public/assets/js/app.js -diff
```

Modifier `.gitignore` pour inclure les assets compilés :

```gitignore
# Ne PAS ignorer les assets compilés pour la production
!/public/assets/css/app.css
!/public/assets/js/app.js
```

### Sur votre machine locale

```bash
# 1. Compiler les assets
npm run build

# 2. Committer les assets compilés
git add public/assets/css/app.css public/assets/js/app.js
git commit -m "Build assets for production"

# 3. Pousser sur le dépôt
git push origin main
```

### Sur le serveur

```bash
# 1. Cloner ou mettre à jour le dépôt
git clone https://github.com/LeZouzouEnWeb/mon_cv_frontend.git
# ou
git pull origin main

# 2. Installer les dépendances PHP
composer install --no-dev --optimize-autoloader

# 3. Configurer .env
cp .env.example .env
nano .env  # Éditer pour la production

# 4. Permissions
chmod -R 775 cache/ logs/
```

---

## 🚀 Méthode 3 : Sans Node.js du tout (CDN Tailwind)

Si vous ne voulez pas utiliser Node.js même en développement, vous pouvez utiliser Tailwind via CDN.

**⚠️ Non recommandé pour la production** (fichier plus lourd, moins de personnalisation)

Modifier `src/Views/layouts/base.php` :

```php
<!-- Remplacer -->
<link rel="stylesheet" href="<?= Helpers::asset('css/app.css') ?>">

<!-- Par -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          primary: {
            600: '#0284c7',
            700: '#0369a1',
          }
        }
      }
    }
  }
</script>
```

---

## 📁 Fichiers à Transférer sur le Serveur

### Obligatoires
```
public/
├── index.php                 ✅
├── assets/
│   ├── css/
│   │   └── app.css          ✅ (compilé en local)
│   └── js/
│       └── app.js           ✅ (compilé en local)
├── .htaccess                 ✅ (si Apache)

src/                          ✅
cache/                        ✅ (vide, juste le dossier)
logs/                         ✅ (vide, juste le dossier)
composer.json                 ✅
.env                          ✅ (configuré pour production)
```

### NON nécessaires sur le serveur
```
node_modules/                 ❌
resources/                    ❌
package.json                  ❌
tailwind.config.js           ❌
postcss.config.js            ❌
.env.example                  ❌
docs/                         ❌ (optionnel)
```

---

## 🔧 Configuration Apache (.htaccess)

Créer `public/.htaccess` :

```apache
# Redirection vers index.php
<IfModule mod_rewrite.c>
    RewriteEngine On
    
    # Rediriger vers index.php si le fichier n'existe pas
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php [QSA,L]
</IfModule>

# Désactiver le listing des répertoires
Options -Indexes

# Sécurité
<FilesMatch "^\.">
    Require all denied
</FilesMatch>
```

---

## 🔧 Configuration Nginx

```nginx
server {
    listen 80;
    server_name cv.corbisier.fr;
    
    root /var/www/cv/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\. {
        deny all;
    }
}
```

---

## ✅ Checklist de Déploiement

### Avant le déploiement (local)
- [ ] Compiler les assets : `npm run build`
- [ ] Tester en local : `php -S localhost:8000 -t public`
- [ ] Vérifier que tout fonctionne

### Sur le serveur
- [ ] Transférer les fichiers
- [ ] Installer les dépendances PHP : `composer install --no-dev`
- [ ] Configurer le `.env` pour la production
- [ ] Vérifier les permissions : `chmod -R 775 cache/ logs/`
- [ ] Configurer le DocumentRoot sur `public/`
- [ ] Tester l'accès au site

### Post-déploiement
- [ ] Vérifier les logs : `tail -f logs/app.log`
- [ ] Tester toutes les fonctionnalités
- [ ] Vérifier la performance (cache activé)

---

## 🐛 Résolution de Problèmes

### Erreur "Class not found"
```bash
composer dump-autoload --optimize
```

### Cache non fonctionnel
```bash
chmod -R 775 cache/
```

### Assets CSS/JS non chargés
Vérifier que :
1. Les fichiers existent dans `public/assets/`
2. Les permissions sont correctes : `chmod 644 public/assets/css/app.css`
3. Le chemin dans `.htaccess` ou nginx est bon

---

## 📞 Support

Pour toute question sur le déploiement :
- Email: emploi@corbisier.fr
- GitHub Issues: [mon_cv_frontend/issues](https://github.com/LeZouzouEnWeb/mon_cv_frontend/issues)

---

*Dernière mise à jour : 17 décembre 2024*
