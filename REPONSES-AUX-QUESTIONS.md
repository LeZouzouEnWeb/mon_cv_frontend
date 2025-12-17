# 📋 RÉPONSES COMPLÈTES AUX 2 QUESTIONS

Date : 17 décembre 2024
Projet : CV Moderne - Frontend

---

## ❓ Question 1 : As-tu pris en compte que le domaine pointe vers ./public ?

### ✅ Réponse : OUI, ABSOLUMENT !

Le projet est **entièrement conçu** pour que le DocumentRoot de votre serveur web pointe vers le dossier `public/`.

### Preuves dans le code

1. **Structure du projet** :
   ```
   mon_cv_frontend/
   ├── public/              ← DocumentRoot (racine web)
   │   ├── index.php       ← Point d'entrée unique
   │   ├── .htaccess       ← Règles Apache (redirection)
   │   └── assets/         ← Assets accessibles (CSS, JS, images)
   └── [autres dossiers]   ← Inaccessibles depuis le web (sécurisé)
   ```

2. **Fichier `.htaccess` créé** : `public/.htaccess`
   - Redirige toutes les requêtes vers `index.php`
   - Protège les fichiers sensibles (`.env`, etc.)

3. **Helpers pour les chemins** : `src/Utils/Helpers.php`
   ```php
   public static function asset(string $path): string
   {
       return '/assets/' . ltrim($path, '/');
   }
   ```
   - Génère `/assets/css/app.css` (relatif à `public/`)
   - Pas besoin de `/public/` dans l'URL

4. **Point d'entrée** : `public/index.php`
   ```php
   require_once __DIR__ . '/../vendor/autoload.php';
   ```
   - Charge les dépendances depuis la racine du projet
   - Tout est relatif à `public/`

### Configuration serveur recommandée

**Apache** :
```apache
<VirtualHost *:80>
    ServerName cv.votredomaine.fr
    DocumentRoot /var/www/cv/public  ← Pointe vers public/
    
    <Directory /var/www/cv/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

**Nginx** :
```nginx
server {
    listen 80;
    server_name cv.votredomaine.fr;
    root /var/www/cv/public;  ← Pointe vers public/
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
}
```

### Sécurité

Les dossiers suivants sont **inaccessibles** depuis le web :
- ✅ `src/` - Code source PHP
- ✅ `cache/` - Fichiers de cache
- ✅ `logs/` - Fichiers de logs
- ✅ `.env` - Configuration sensible
- ✅ `vendor/` - Dépendances Composer

Seul `public/` est accessible :
- `public/index.php` - Application
- `public/assets/` - Ressources statiques (CSS, JS, images)

---

## ❓ Question 2 : Je suis sur un serveur PHP, est-ce compatible avec Node.js ?

### ✅ Réponse : OUI, mais Node.js n'est PAS nécessaire sur le serveur !

### Explication détaillée

Node.js est **uniquement** utilisé pour **compiler** les assets **avant** le déploiement.

```
┌─────────────────────────────────────────────────────────────┐
│  ÉTAPE 1 : SUR VOTRE PC (Développement)                    │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│  Outils nécessaires :                                       │
│  • PHP 8.0+                                                 │
│  • Composer                                                 │
│  • Node.js + npm   ← Nécessaire ICI                        │
│                                                             │
│  Actions :                                                  │
│  1. Éditer resources/css/app.css (source Tailwind)         │
│  2. Éditer resources/js/app.js (source JavaScript)         │
│  3. Compiler : npm run build                                │
│     ├─> Tailwind compile → public/assets/css/app.css       │
│     └─> esbuild compile  → public/assets/js/app.js         │
│  4. Tester : php -S localhost:8000 -t public               │
│                                                             │
└─────────────────────────────────────────────────────────────┘
                              ⬇
                    Transfert (FTP/Git)
                              ⬇
┌─────────────────────────────────────────────────────────────┐
│  ÉTAPE 2 : SUR LE SERVEUR (Production)                     │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│  Outils nécessaires :                                       │
│  • PHP 8.0+                                                 │
│  • Composer                                                 │
│  • Node.js + npm   ← PAS NÉCESSAIRE !                      │
│                                                             │
│  Fichiers reçus :                                           │
│  ✅ public/assets/css/app.css (DÉJÀ compilé)                │
│  ✅ public/assets/js/app.js (DÉJÀ compilé)                  │
│  ✅ src/ (code PHP)                                         │
│  ✅ composer.json                                           │
│  ❌ resources/ (non transféré, inutile)                     │
│  ❌ node_modules/ (non transféré, inutile)                  │
│                                                             │
│  Actions :                                                  │
│  1. composer install --no-dev                               │
│  2. Configurer .env                                         │
│  3. chmod -R 775 cache/ logs/                               │
│  4. ✅ Site fonctionnel !                                   │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

### Pourquoi cette architecture ?

1. **Séparation des responsabilités** :
   - Node.js : Compile/optimise les assets (CSS/JS)
   - PHP : Exécute l'application web

2. **Performance** :
   - Les assets sont pré-compilés et minifiés
   - Le serveur ne fait qu'envoyer les fichiers statiques
   - Pas de compilation à chaque requête

3. **Simplicité** :
   - Le serveur de production n'a besoin que de PHP
   - Pas de dépendances Node.js à gérer en production
   - Moins de risques de problèmes de compatibilité

### Technologies par environnement

| Technologie | PC (Dev)    | Serveur (Prod) | Rôle                                      |
|-------------|-------------|----------------|-------------------------------------------|
| PHP         | ✅ Requis   | ✅ Requis      | Exécute l'application                     |
| Composer    | ✅ Requis   | ✅ Requis      | Gère les dépendances PHP (Guzzle, etc.)   |
| Node.js     | ✅ Requis   | ❌ Inutile     | Compile CSS/JS (uniquement en dev)        |
| npm         | ✅ Requis   | ❌ Inutile     | Installe Tailwind, esbuild (uniquement en dev) |

### Que se passe-t-il si je n'ai pas Node.js ?

#### Option A : Utiliser un autre PC
Compilez sur un PC avec Node.js, puis transférez les fichiers compilés.

#### Option B : Tailwind CSS via CDN (non recommandé)
```html
<script src="https://cdn.tailwindcss.com"></script>
```
- ⚠️ Fichier plus lourd (~350 KB vs ~10 KB compilé)
- ⚠️ Moins performant
- ✅ Fonctionne sans Node.js

#### Option C : Installer Node.js (recommandé)
- Télécharger : https://nodejs.org/
- Installer (simple, assistant graphique)
- Utiliser ensuite normalement

---

## 🎯 Workflow de Déploiement Complet

### Première fois

#### Sur votre PC Windows

```powershell
# 1. Cloner le projet
git clone https://github.com/LeZouzouEnWeb/mon_cv_frontend.git
cd mon_cv_frontend

# 2. Installer les dépendances
composer install
npm install

# 3. Compiler les assets
npm run build
# OU
.\build.ps1

# 4. Vérifier avant déploiement
.\check.ps1

# 5. Tester en local
php -S localhost:8000 -t public
# Ouvrir http://localhost:8000
```

#### Sur le serveur

```bash
# 1. Transférer les fichiers (FTP, Git, etc.)
# Transférer : public/, src/, cache/, logs/, composer.json, .env

# 2. Installer les dépendances PHP
composer install --no-dev --optimize-autoloader

# 3. Créer/éditer .env
nano .env
# Configurer pour production (voir ci-dessous)

# 4. Permissions
chmod -R 755 public/
chmod -R 775 cache/ logs/
chown -R www-data:www-data cache/ logs/

# 5. Tester
php -v  # Vérifier PHP 8.0+
ls -la public/assets/css/app.css  # Doit exister
```

### Mises à jour futures

#### Sur votre PC

```powershell
# 1. Modifier le code
# Exemple : modifier resources/css/app.css

# 2. Recompiler
npm run build

# 3. Vérifier
.\check.ps1

# 4. Transférer uniquement les fichiers modifiés
# Via FTP : public/assets/css/app.css
# Via Git : git commit + git push
```

#### Sur le serveur

```bash
# Si Git
git pull

# Vider le cache si nécessaire
rm -rf cache/*
```

---

## 📁 Fichiers à Transférer

### ✅ À transférer sur le serveur

```
public/                         (tout le dossier)
├── index.php                   ← Point d'entrée
├── .htaccess                   ← Configuration Apache
└── assets/
    ├── css/
    │   └── app.css             ← DÉJÀ compilé
    └── js/
        └── app.js              ← DÉJÀ compilé

src/                            (tout le dossier)
├── Controllers/
├── Services/
├── Utils/
└── Views/

cache/                          (dossier vide)
logs/                           (dossier vide)
composer.json                   ← Pour installer dépendances PHP
.env                            ← Configuration production
```

### ❌ NE PAS transférer

```
node_modules/       ← Dépendances Node.js (inutiles sur serveur)
resources/          ← Sources CSS/JS non compilées (inutiles)
package.json        ← Configuration npm (inutile)
tailwind.config.js  ← Configuration Tailwind (inutile)
postcss.config.js   ← Configuration PostCSS (inutile)
.env.example        ← Juste un exemple (optionnel)
docs/               ← Documentation (optionnel)
```

---

## 🔧 Configuration .env pour Production

Sur le serveur, créer/éditer `.env` :

```env
# API Configuration
API_BASE_URL=https://api-cv.corbisier.fr/wp-json
API_TIMEOUT=10

# Cache Configuration
CACHE_ENABLED=true
CACHE_DURATION=3600

# Environment
APP_ENV=production
APP_DEBUG=false              ← IMPORTANT : false en production
APP_NAME="CV Eric Corbisier"

# Security
SESSION_NAME=cv_session
SESSION_LIFETIME=7200

# Logs
LOG_ENABLED=true
LOG_LEVEL=error             ← Seulement les erreurs en production
```

---

## ✅ Checklist Finale

### Avant le déploiement (sur PC)

- [ ] `npm install` exécuté
- [ ] `composer install` exécuté
- [ ] `npm run build` exécuté
- [ ] `public/assets/css/app.css` existe et > 0 KB
- [ ] `public/assets/js/app.js` existe et > 0 KB
- [ ] `.\check.ps1` ne montre aucune erreur
- [ ] Test local OK : `http://localhost:8000`

### Sur le serveur

- [ ] Tous les fichiers transférés
- [ ] `composer install --no-dev` exécuté
- [ ] `.env` créé et configuré (APP_DEBUG=false)
- [ ] `chmod -R 775 cache/ logs/` exécuté
- [ ] Apache/Nginx DocumentRoot pointe vers `public/`
- [ ] Test : `curl http://votre-domaine.fr` retourne du HTML

---

## 📖 Documentation Complète

Pour plus de détails, consultez :

1. **[AIDE-MEMOIRE.txt](AIDE-MEMOIRE.txt)** - Aide-mémoire visuel
2. **[docs/FAQ.md](docs/FAQ.md)** - FAQ détaillée
3. **[docs/QUICK_DEPLOY.md](docs/QUICK_DEPLOY.md)** - Déploiement rapide
4. **[docs/DEPLOYMENT.md](docs/DEPLOYMENT.md)** - Guide complet
5. **[docs/GETTING_STARTED.md](docs/GETTING_STARTED.md)** - Installation

---

## 📞 Support

Questions ? Problèmes ?
- Email : emploi@corbisier.fr
- GitHub : https://github.com/LeZouzouEnWeb/mon_cv_frontend/issues

---

**Réponse finale** :

1. ✅ Oui, le domaine pointant vers `./public` est **complètement pris en compte**
2. ✅ Oui, compatible serveur PHP, **Node.js n'est pas nécessaire sur le serveur**

**Node.js sert uniquement à compiler les assets sur votre PC avant le déploiement.**

---

*Document créé le 17 décembre 2024*
