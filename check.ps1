# Script de vérification avant déploiement

Write-Host "═══════════════════════════════════════════════════════" -ForegroundColor Cyan
Write-Host "  VÉRIFICATION AVANT DÉPLOIEMENT" -ForegroundColor Cyan
Write-Host "═══════════════════════════════════════════════════════" -ForegroundColor Cyan
Write-Host ""

$errors = 0
$warnings = 0

# Vérifier Node.js
Write-Host "1. Vérification de Node.js..." -ForegroundColor Yellow
if (Get-Command npm -ErrorAction SilentlyContinue) {
    $npmVersion = npm -v
    Write-Host "   ✅ npm version $npmVersion" -ForegroundColor Green
} else {
    Write-Host "   ⚠️  npm n'est pas installé (nécessaire pour compiler)" -ForegroundColor Yellow
    $warnings++
}

# Vérifier PHP
Write-Host "`n2. Vérification de PHP..." -ForegroundColor Yellow
if (Get-Command php -ErrorAction SilentlyContinue) {
    $phpVersion = php -v | Select-String "PHP (\d+\.\d+\.\d+)" | ForEach-Object { $_.Matches.Groups[1].Value }
    if ($phpVersion) {
        Write-Host "   ✅ PHP version $phpVersion" -ForegroundColor Green
    } else {
        Write-Host "   ✅ PHP installé" -ForegroundColor Green
    }
} else {
    Write-Host "   ❌ PHP n'est pas installé" -ForegroundColor Red
    $errors++
}

# Vérifier Composer
Write-Host "`n3. Vérification de Composer..." -ForegroundColor Yellow
if (Get-Command composer -ErrorAction SilentlyContinue) {
    Write-Host "   ✅ Composer installé" -ForegroundColor Green
} else {
    Write-Host "   ❌ Composer n'est pas installé" -ForegroundColor Red
    $errors++
}

# Vérifier les dépendances Node.js
Write-Host "`n4. Vérification des dépendances Node.js..." -ForegroundColor Yellow
if (Test-Path "node_modules") {
    Write-Host "   ✅ node_modules/ présent" -ForegroundColor Green
} else {
    Write-Host "   ⚠️  node_modules/ absent - Exécutez: npm install" -ForegroundColor Yellow
    $warnings++
}

# Vérifier les dépendances PHP
Write-Host "`n5. Vérification des dépendances PHP..." -ForegroundColor Yellow
if (Test-Path "vendor") {
    Write-Host "   ✅ vendor/ présent" -ForegroundColor Green
} else {
    Write-Host "   ⚠️  vendor/ absent - Exécutez: composer install" -ForegroundColor Yellow
    $warnings++
}

# Vérifier les assets compilés
Write-Host "`n6. Vérification des assets compilés..." -ForegroundColor Yellow
$cssExists = Test-Path "public/assets/css/app.css"
$jsExists = Test-Path "public/assets/js/app.js"

if ($cssExists) {
    $cssSize = (Get-Item "public/assets/css/app.css").Length
    if ($cssSize -gt 0) {
        Write-Host "   ✅ public/assets/css/app.css ($([math]::Round($cssSize/1KB, 2)) KB)" -ForegroundColor Green
    } else {
        Write-Host "   ❌ public/assets/css/app.css est vide" -ForegroundColor Red
        $errors++
    }
} else {
    Write-Host "   ❌ public/assets/css/app.css absent - Exécutez: npm run build" -ForegroundColor Red
    $errors++
}

if ($jsExists) {
    $jsSize = (Get-Item "public/assets/js/app.js").Length
    if ($jsSize -gt 0) {
        Write-Host "   ✅ public/assets/js/app.js ($([math]::Round($jsSize/1KB, 2)) KB)" -ForegroundColor Green
    } else {
        Write-Host "   ❌ public/assets/js/app.js est vide" -ForegroundColor Red
        $errors++
    }
} else {
    Write-Host "   ❌ public/assets/js/app.js absent - Exécutez: npm run build" -ForegroundColor Red
    $errors++
}

# Vérifier le fichier .env
Write-Host "`n7. Vérification de la configuration..." -ForegroundColor Yellow
if (Test-Path ".env") {
    Write-Host "   ✅ .env présent" -ForegroundColor Green
} else {
    if (Test-Path ".env.example") {
        Write-Host "   ⚠️  .env absent - Copiez .env.example vers .env" -ForegroundColor Yellow
        $warnings++
    } else {
        Write-Host "   ❌ .env et .env.example absents" -ForegroundColor Red
        $errors++
    }
}

# Vérifier les dossiers essentiels
Write-Host "`n8. Vérification de la structure..." -ForegroundColor Yellow
$folders = @("public", "src", "cache", "logs")
foreach ($folder in $folders) {
    if (Test-Path $folder) {
        Write-Host "   ✅ $folder/" -ForegroundColor Green
    } else {
        Write-Host "   ❌ $folder/ manquant" -ForegroundColor Red
        $errors++
    }
}

# Vérifier les permissions (approximatif sur Windows)
Write-Host "`n9. Vérification des dossiers cache et logs..." -ForegroundColor Yellow
if (Test-Path "cache") {
    try {
        $testFile = "cache\.test"
        "" | Out-File $testFile -ErrorAction Stop
        Remove-Item $testFile
        Write-Host "   ✅ cache/ accessible en écriture" -ForegroundColor Green
    } catch {
        Write-Host "   ⚠️  cache/ pourrait ne pas être accessible en écriture" -ForegroundColor Yellow
        $warnings++
    }
}

if (Test-Path "logs") {
    try {
        $testFile = "logs\.test"
        "" | Out-File $testFile -ErrorAction Stop
        Remove-Item $testFile
        Write-Host "   ✅ logs/ accessible en écriture" -ForegroundColor Green
    } catch {
        Write-Host "   ⚠️  logs/ pourrait ne pas être accessible en écriture" -ForegroundColor Yellow
        $warnings++
    }
}

# Résumé
Write-Host ""
Write-Host "═══════════════════════════════════════════════════════" -ForegroundColor Cyan
Write-Host "  RÉSUMÉ" -ForegroundColor Cyan
Write-Host "═══════════════════════════════════════════════════════" -ForegroundColor Cyan

if ($errors -eq 0 -and $warnings -eq 0) {
    Write-Host ""
    Write-Host "✅ TOUT EST PRÊT POUR LE DÉPLOIEMENT !" -ForegroundColor Green
    Write-Host ""
    Write-Host "Prochaines étapes :" -ForegroundColor White
    Write-Host "1. Transférer les fichiers sur le serveur (via FTP ou Git)" -ForegroundColor White
    Write-Host "2. Sur le serveur, exécuter: composer install --no-dev" -ForegroundColor White
    Write-Host "3. Configurer le .env sur le serveur" -ForegroundColor White
    Write-Host "4. Vérifier les permissions: chmod -R 775 cache/ logs/" -ForegroundColor White
} elseif ($errors -eq 0) {
    Write-Host ""
    Write-Host "⚠️  $warnings avertissement(s) détecté(s)" -ForegroundColor Yellow
    Write-Host "Le déploiement est possible mais corrigez les avertissements pour un résultat optimal." -ForegroundColor Yellow
} else {
    Write-Host ""
    Write-Host "❌ $errors erreur(s) et $warnings avertissement(s) détecté(s)" -ForegroundColor Red
    Write-Host "Corrigez les erreurs avant de déployer !" -ForegroundColor Red
    Write-Host ""
    if (-not $cssExists -or -not $jsExists) {
        Write-Host "💡 Conseil : Exécutez 'npm run build' pour compiler les assets" -ForegroundColor Cyan
    }
}

Write-Host ""
Write-Host "═══════════════════════════════════════════════════════" -ForegroundColor Cyan
