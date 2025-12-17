# Configuration de Cloudflare Turnstile

Cloudflare Turnstile a été intégré au formulaire de contact pour protéger contre les bots et le spam.

## Obtenir vos clés Turnstile

1. Connectez-vous à votre compte Cloudflare : https://dash.cloudflare.com/
2. Accédez à **Turnstile** dans le menu latéral
3. Cliquez sur **Add Site**
4. Configurez votre site :
   - **Site name** : CV Eric Corbisier (ou le nom de votre choix)
   - **Domain** : votre-domaine.fr (ou localhost pour les tests)
   - **Widget Mode** : Managed (recommandé)
5. Cliquez sur **Create**
6. Copiez les deux clés générées

## Configuration

Ajoutez les clés dans votre fichier `.env` :

```env
TURNSTILE_SITE_KEY=0x4AAAAAAxxxxxxxxxxxxxxxxxxxxx
TURNSTILE_SECRET_KEY=0x4AAAAAAyyyyyyyyyyyyyyyyyyyyyyyy
```

### Clés de test

Pour le développement local, vous pouvez utiliser les clés de test Cloudflare :

```env
# TOUJOURS SUCCÈS
TURNSTILE_SITE_KEY=1x00000000000000000000AA
TURNSTILE_SECRET_KEY=1x0000000000000000000000000000000AA

# TOUJOURS ÉCHEC
TURNSTILE_SITE_KEY=2x00000000000000000000AB
TURNSTILE_SECRET_KEY=2x0000000000000000000000000000000AA

# FORCE UN DÉFI INTERACTIF
TURNSTILE_SITE_KEY=3x00000000000000000000FF
TURNSTILE_SECRET_KEY=3x0000000000000000000000000000000AA
```

## Fonctionnement

### Côté client (JavaScript)

1. Le widget Turnstile se charge automatiquement dans le formulaire
2. L'utilisateur remplit le formulaire
3. Turnstile vérifie en arrière-plan si c'est un humain
4. Un token est généré et envoyé avec le formulaire

### Côté serveur (PHP)

1. Le token est récupéré depuis les données du formulaire
2. `TurnstileService` envoie le token à l'API Cloudflare
3. Cloudflare valide le token et répond avec `success: true/false`
4. Si la validation échoue, le formulaire est rejeté

## Fichiers modifiés

- **src/Services/TurnstileService.php** - Service de validation
- **src/Controllers/ContactController.php** - Vérification avant envoi
- **src/Views/layouts/base.php** - Widget Turnstile dans le formulaire
- **resources/js/app.js** - Envoi du token et reset du widget
- **.env** - Configuration des clés

## Personnalisation

### Thème

Dans `base.php`, modifiez l'attribut `data-theme` :

```html
<div class="cf-turnstile" 
     data-sitekey="..." 
     data-theme="light">  <!-- "light" ou "dark" -->
</div>
```

### Taille

Ajoutez l'attribut `data-size` :

```html
<div class="cf-turnstile" 
     data-sitekey="..." 
     data-size="compact">  <!-- "normal" ou "compact" -->
</div>
```

### Language

Ajoutez l'attribut `data-language` :

```html
<div class="cf-turnstile" 
     data-sitekey="..." 
     data-language="fr">  <!-- Code langue ISO -->
</div>
```

## Dépannage

### Le widget ne s'affiche pas

1. Vérifiez que le script Cloudflare est chargé dans le `<head>`
2. Vérifiez la console du navigateur pour les erreurs
3. Assurez-vous que `TURNSTILE_SITE_KEY` est défini dans `.env`

### Validation échoue toujours

1. Vérifiez que `TURNSTILE_SECRET_KEY` est correcte
2. Vérifiez les logs PHP pour voir les erreurs Turnstile
3. Assurez-vous que le domaine correspond à celui configuré dans Cloudflare
4. Utilisez les clés de test pour vérifier que l'intégration fonctionne

### Erreurs courantes

- `missing-input-secret` : Secret key manquante ou invalide
- `invalid-input-secret` : Secret key incorrecte
- `missing-input-response` : Token non fourni
- `invalid-input-response` : Token invalide ou expiré
- `timeout-or-duplicate` : Token déjà utilisé ou expiré

## Sécurité

- Les clés sont stockées dans `.env` (non versionné)
- La validation se fait côté serveur (impossible de bypasser)
- Le token Turnstile expire après quelques minutes
- Un token ne peut être utilisé qu'une seule fois
- L'IP du client est envoyée pour détection avancée

## Documentation officielle

https://developers.cloudflare.com/turnstile/
