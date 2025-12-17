#!/bin/bash

# Script de build pour la production

echo "🚀 Build pour la production..."

# 1. Vérifier que Node.js est installé
if ! command -v npm &> /dev/null; then
    echo "❌ npm n'est pas installé. Installez Node.js d'abord."
    exit 1
fi

# 2. Installer les dépendances si nécessaire
if [ ! -d "node_modules" ]; then
    echo "📦 Installation des dépendances Node.js..."
    npm install
fi

# 3. Build des assets
echo "🎨 Compilation des assets CSS et JS..."
npm run build

# 4. Vérifier que les fichiers ont été créés
if [ -f "public/assets/css/app.css" ] && [ -f "public/assets/js/app.js" ]; then
    echo "✅ Assets compilés avec succès !"
    echo ""
    echo "Fichiers générés :"
    ls -lh public/assets/css/app.css
    ls -lh public/assets/js/app.js
else
    echo "❌ Erreur lors de la compilation des assets"
    exit 1
fi

# 5. Optimiser l'autoload Composer si disponible
if command -v composer &> /dev/null; then
    echo ""
    echo "📦 Optimisation de l'autoloader Composer..."
    composer dump-autoload --optimize
fi

echo ""
echo "✅ Build terminé ! Vous pouvez maintenant déployer les fichiers sur votre serveur."
echo ""
echo "Fichiers à transférer :"
echo "  - public/"
echo "  - src/"
echo "  - cache/ (vide)"
echo "  - logs/ (vide)"
echo "  - composer.json"
echo "  - .env (à configurer sur le serveur)"
