# Configuration de l'envoi d'emails

## Installation

PHPMailer a été installé via Composer :
```bash
composer require phpmailer/phpmailer
```

## Configuration

### 1. Variables d'environnement

Ajoutez les variables suivantes dans votre fichier `.env` :

```env
# Email Configuration
SMTP_HOST=smtp.gmail.com
SMTP_PORT=587
SMTP_USERNAME=votre-email@gmail.com
SMTP_PASSWORD=votre-mot-de-passe-app
ADMIN_EMAIL=emploi@corbisier.fr
```

### 2. Configuration Gmail

Si vous utilisez Gmail, vous devez créer un "Mot de passe d'application" :

1. Allez dans votre compte Google : https://myaccount.google.com/
2. Sécurité > Validation en deux étapes (activez-la si ce n'est pas fait)
3. Sécurité > Mots de passe des applications
4. Sélectionnez "Autre" et donnez un nom (ex: "CV Website")
5. Copiez le mot de passe généré dans `SMTP_PASSWORD`

### 3. Autres fournisseurs SMTP

Pour d'autres fournisseurs, ajustez les paramètres :

**OVH / Kimsufi :**
```env
SMTP_HOST=ssl0.ovh.net
SMTP_PORT=587
```

**Office 365 / Outlook :**
```env
SMTP_HOST=smtp.office365.com
SMTP_PORT=587
```

**SendGrid :**
```env
SMTP_HOST=smtp.sendgrid.net
SMTP_PORT=587
SMTP_USERNAME=apikey
SMTP_PASSWORD=votre-clé-api-sendgrid
```

## Utilisation

### Endpoint API

Le formulaire de contact envoie une requête POST à `/contact-send.php` avec le format JSON :

```json
{
  "name": "Nom de l'utilisateur",
  "email": "email@example.com",
  "message": "Le message de l'utilisateur"
}
```

### Réponse

**Succès (200) :**
```json
{
  "success": true,
  "message": "Votre message a été envoyé avec succès. Je vous répondrai dans les plus brefs délais."
}
```

**Erreur de validation (400) :**
```json
{
  "success": false,
  "message": "Données invalides",
  "errors": {
    "name": "Le nom est requis",
    "email": "L'email n'est pas valide",
    "message": "Le message doit contenir au moins 10 caractères"
  }
}
```

**Erreur serveur (500) :**
```json
{
  "success": false,
  "message": "Une erreur est survenue lors de l'envoi du message. Veuillez réessayer."
}
```

## Architecture

### Fichiers créés

1. **src/Services/EmailService.php** - Service d'envoi d'emails
   - Configuration SMTP
   - Template HTML pour les emails
   - Gestion des erreurs

2. **src/Controllers/ContactController.php** - Contrôleur pour le formulaire
   - Validation des données
   - Sanitization
   - Gestion des réponses JSON

3. **public/contact-send.php** - Point d'entrée API
   - Charge l'autoloader Composer
   - Charge les variables d'environnement
   - Instancie le contrôleur

### Validation

Les règles de validation appliquées :

- **Name** : 2-100 caractères requis
- **Email** : Format email valide requis
- **Message** : 10-2000 caractères requis

### Sécurité

- Validation stricte des entrées
- Sanitization avec `htmlspecialchars()`
- Headers CORS appropriés
- Logs des erreurs (sans exposer les détails sensibles)

## Test

Pour tester l'envoi d'emails :

1. Configurez vos variables d'environnement dans `.env`
2. Accédez à votre CV
3. Cliquez sur "Contact"
4. Remplissez le formulaire
5. Vérifiez la réception de l'email à l'adresse configurée dans `ADMIN_EMAIL`

## Dépannage

### L'email n'est pas envoyé

1. Vérifiez les logs PHP : `logs/app.log` ou les logs du serveur
2. Vérifiez que les paramètres SMTP sont corrects
3. Pour Gmail, assurez-vous d'utiliser un mot de passe d'application
4. Testez la connexion SMTP manuellement

### Erreur "Authentication failed"

- Vérifiez `SMTP_USERNAME` et `SMTP_PASSWORD`
- Pour Gmail, vérifiez que la validation en 2 étapes est activée
- Vérifiez que le port (587) n'est pas bloqué par votre pare-feu

### Template HTML ne s'affiche pas

Le service envoie aussi une version texte brut (`AltBody`) pour les clients email qui ne supportent pas HTML.

## Personnalisation

### Modifier le template d'email

Éditez la méthode `getContactEmailTemplate()` dans [src/Services/EmailService.php](src/Services/EmailService.php).

### Ajouter des destinataires

Dans [src/Services/EmailService.php](src/Services/EmailService.php), méthode `sendContactEmail()` :

```php
$this->mailer->addAddress($this->adminEmail);
$this->mailer->addCC('autre@example.com'); // Copie
$this->mailer->addBCC('secret@example.com'); // Copie cachée
```

### Ajouter des pièces jointes

Dans le formulaire, ajoutez un champ file, puis dans le contrôleur :

```php
if (isset($_FILES['attachment'])) {
    $this->mailer->addAttachment($_FILES['attachment']['tmp_name'], $_FILES['attachment']['name']);
}
```
