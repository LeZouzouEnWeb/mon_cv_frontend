# Script de build pour la production (Windows)

Write-Host "🚀 Build pour la production..." -ForegroundColor Green

# 1. Vérifier que Node.js est installé
if (!(Get-Command npm -ErrorAction SilentlyContinue)) {
    Write-Host "❌ npm n'est pas installé. Installez Node.js d'abord." -ForegroundColor Red
    exit 1
}

# 2. Installer les dépendances si nécessaire
if (!(Test-Path "node_modules")) {
    Write-Host "📦 Installation des dépendances Node.js..." -ForegroundColor Yellow
    npm install
}

# 3. Build des assets
Write-Host "🎨 Compilation des assets CSS et JS..." -ForegroundColor Yellow
npm run build

# 4. Vérifier que les fichiers ont été créés
if ((Test-Path "public/assets/css/app.css") -and (Test-Path "public/assets/js/app.js")) {
    Write-Host "✅ Assets compilés avec succès !" -ForegroundColor Green
    Write-Host ""
    Write-Host "Fichiers générés :"
    Get-Item public/assets/css/app.css | Format-Table Name, Length, LastWriteTime
    Get-Item public/assets/js/app.js | Format-Table Name, Length, LastWriteTime
} else {
    Write-Host "❌ Erreur lors de la compilation des assets" -ForegroundColor Red
    exit 1
}

# 5. Optimiser l'autoload Composer si disponible
if (Get-Command composer -ErrorAction SilentlyContinue) {
    Write-Host ""
    Write-Host "📦 Optimisation de l'autoloader Composer..." -ForegroundColor Yellow
    composer dump-autoload --optimize
}

Write-Host ""
Write-Host "✅ Build terminé ! Vous pouvez maintenant déployer les fichiers sur votre serveur." -ForegroundColor Green
Write-Host ""
Write-Host "Fichiers à transférer :"
Write-Host "  - public/"
Write-Host "  - src/"
Write-Host "  - cache/ (vide)"
Write-Host "  - logs/ (vide)"
Write-Host "  - composer.json"
Write-Host "  - .env (à configurer sur le serveur)"
