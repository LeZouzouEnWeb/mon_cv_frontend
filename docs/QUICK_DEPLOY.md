# Déploiement Rapide - CV Frontend

## 🎯 Résumé : Node.js requis ou pas ?

### ❌ Sur le serveur de production : **NON**
Votre serveur PHP n'a **PAS** besoin de Node.js !

### ✅ Sur votre machine locale : **OUI** (seulement pour compiler)
Node.js sert uniquement à compiler les assets **avant** de les envoyer sur le serveur.

---

## 🚀 Procédure de Déploiement Complète

### Étape 1 : Sur votre PC (Windows)

```powershell
# 1. Compiler les assets (nécessite Node.js EN LOCAL uniquement)
npm run build

# OU utiliser le script automatique
.\build.ps1

# 2. Vérifier que les fichiers ont été créés
dir public\assets\css\app.css
dir public\assets\js\app.js
```

### Étape 2 : Transférer les fichiers sur le serveur

**Via FTP/SFTP** (FileZilla, WinSCP, etc.) :
```
Transférer :
✅ public/             (tout le dossier)
✅ src/                (tout le dossier)
✅ cache/              (dossier vide)
✅ logs/               (dossier vide)
✅ composer.json
✅ .env                (à créer/modifier sur le serveur)

NE PAS transférer :
❌ node_modules/
❌ resources/          (sources non compilées)
❌ package.json
❌ tailwind.config.js
❌ docs/
```

**Via Git** :
```bash
# Sur votre PC
git add .
git commit -m "Build assets for production"
git push origin main

# Sur le serveur
git pull origin main
```

### Étape 3 : Sur le serveur (SSH)

```bash
# 1. Installer les dépendances PHP (pas Node.js !)
composer install --no-dev --optimize-autoloader

# 2. Créer/éditer le .env pour la production
nano .env
# Copier le contenu ci-dessous ↓

# 3. Vérifier les permissions
chmod -R 755 public/
chmod -R 775 cache/ logs/

# 4. Tester
php -v  # Doit afficher PHP 8.0+
ls -la public/assets/css/app.css  # Doit exister
ls -la public/assets/js/app.js    # Doit exister
```

### Étape 4 : Configuration .env sur le serveur

```env
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
```

---

## 📋 Checklist Rapide

### Avant chaque déploiement
- [ ] Compiler les assets : `npm run build` (sur PC)
- [ ] Tester en local : `php -S localhost:8000 -t public`
- [ ] Vérifier que `public/assets/css/app.css` existe
- [ ] Vérifier que `public/assets/js/app.js` existe

### Premier déploiement
- [ ] Transférer tous les fichiers sauf `node_modules/` et `resources/`
- [ ] Configurer le `.env` sur le serveur
- [ ] Lancer `composer install --no-dev` sur le serveur
- [ ] Vérifier les permissions des dossiers `cache/` et `logs/`
- [ ] Tester le site

### Déploiements suivants
- [ ] Compiler les assets : `npm run build`
- [ ] Transférer uniquement les fichiers modifiés
- [ ] Vider le cache si nécessaire : `rm -rf cache/*`

---

## 🔧 Configuration Serveur

### Apache
Le fichier `.htaccess` est déjà dans `public/` ✅

Vérifier que le DocumentRoot pointe vers `public/` :
```apache
DocumentRoot /var/www/cv/public
<Directory /var/www/cv/public>
    AllowOverride All
    Require all granted
</Directory>
```

### Nginx
```nginx
server {
    root /var/www/cv/public;
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

---

## 🐛 Problèmes Courants

### Les styles ne s'appliquent pas
**Cause** : Fichier CSS non compilé ou non transféré
**Solution** :
```bash
# Sur PC
npm run build
# Puis retransférer public/assets/css/app.css
```

### Erreur "Class not found"
**Cause** : Autoloader non optimisé
**Solution** :
```bash
composer dump-autoload --optimize
```

### Cache ne fonctionne pas
**Cause** : Permissions incorrectes
**Solution** :
```bash
chmod -R 775 cache/
chown -R www-data:www-data cache/  # ou votre utilisateur web
```

---

## 📞 Questions Fréquentes

### Q: Dois-je installer Node.js sur mon serveur ?
**R:** Non ! Node.js ne sert qu'à compiler les assets sur votre PC. Le serveur n'a besoin que de PHP.

### Q: Comment mettre à jour le CSS ?
**R:** 
1. Modifier `resources/css/app.css` sur votre PC
2. Lancer `npm run build`
3. Transférer le fichier compilé `public/assets/css/app.css` sur le serveur

### Q: Et si je n'ai pas Node.js du tout ?
**R:** Vous pouvez utiliser Tailwind CSS via CDN (voir docs/DEPLOYMENT.md, Méthode 3)

### Q: Le cache des données API fonctionne comment ?
**R:** Les données sont cachées dans `cache/` pour 1 heure par défaut (configurable dans `.env`)

---

## 📖 Documentation Complète

Pour plus de détails, voir :
- [DEPLOYMENT.md](DEPLOYMENT.md) - Guide de déploiement complet
- [GETTING_STARTED.md](GETTING_STARTED.md) - Installation et configuration
- [RAG_KNOWLEDGE_BASE.md](RAG_KNOWLEDGE_BASE.md) - Base de connaissances

---

*Dernière mise à jour : 17 décembre 2024*
