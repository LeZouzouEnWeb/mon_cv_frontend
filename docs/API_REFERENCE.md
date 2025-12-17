# Référence API WordPress REST - CV

## URL de base
```
https://api-cv.corbisier.fr/wp-json
```

## Authentification
Aucune authentification requise pour les endpoints publics utilisés.

---

## Endpoints Utilisés

### 1. GET /wp/v2/posts/{id}

Récupère un post individuel par son ID.

#### Request
```http
GET /wp/v2/posts/128 HTTP/1.1
Host: api-cv.corbisier.fr
Accept: application/json
```

#### Response (200 OK)
```json
{
  "id": 128,
  "date": "2023-07-15T10:30:00",
  "date_gmt": "2023-07-15T08:30:00",
  "modified": "2024-02-24T14:20:00",
  "modified_gmt": "2024-02-24T13:20:00",
  "slug": "experience-professionnelle",
  "status": "publish",
  "type": "post",
  "link": "https://api-cv.corbisier.fr/experience-professionnelle/",
  "title": {
    "rendered": "Expérience professionnelle"
  },
  "content": {
    "rendered": "<ul>\n<li>2020-2024 : Poste 1...</li>\n<li>2015-2020 : Poste 2...</li>\n</ul>",
    "protected": false
  },
  "excerpt": {
    "rendered": "<p>Mon parcours professionnel...</p>",
    "protected": false
  },
  "author": 1,
  "featured_media": 0,
  "comment_status": "closed",
  "ping_status": "closed",
  "sticky": false,
  "template": "",
  "format": "standard",
  "meta": [],
  "categories": [1],
  "tags": [],
  "_links": {
    "self": [
      {
        "href": "https://api-cv.corbisier.fr/wp-json/wp/v2/posts/128"
      }
    ],
    "collection": [
      {
        "href": "https://api-cv.corbisier.fr/wp-json/wp/v2/posts"
      }
    ],
    "about": [
      {
        "href": "https://api-cv.corbisier.fr/wp-json/wp/v2/types/post"
      }
    ],
    "author": [
      {
        "embeddable": true,
        "href": "https://api-cv.corbisier.fr/wp-json/wp/v2/users/1"
      }
    ]
  }
}
```

#### Champs Importants
| Champ | Type | Description |
|-------|------|-------------|
| `id` | integer | Identifiant unique du post |
| `title.rendered` | string | Titre du post en HTML |
| `content.rendered` | string | Contenu complet en HTML |
| `excerpt.rendered` | string | Extrait/résumé en HTML |
| `modified` | string | Date de dernière modification (ISO 8601) |
| `slug` | string | Identifiant URL-friendly |

---

### 2. GET /wp/v2/posts

Récupère une liste de posts avec filtres.

#### Request
```http
GET /wp/v2/posts?include=128,153,126&per_page=100 HTTP/1.1
Host: api-cv.corbisier.fr
Accept: application/json
```

#### Query Parameters
| Paramètre | Type | Valeur par défaut | Description |
|-----------|------|-------------------|-------------|
| `context` | string | view | Contexte de la requête (view, embed, edit) |
| `page` | integer | 1 | Page de pagination |
| `per_page` | integer | 10 | Nombre d'éléments par page (max: 100) |
| `search` | string | - | Recherche textuelle |
| `after` | string | - | Posts après cette date (ISO 8601) |
| `before` | string | - | Posts avant cette date (ISO 8601) |
| `exclude` | array | [] | IDs à exclure |
| `include` | array | [] | IDs à inclure uniquement |
| `offset` | integer | - | Nombre d'éléments à ignorer |
| `order` | string | desc | Ordre (asc, desc) |
| `orderby` | string | date | Tri (date, relevance, id, title, slug) |
| `slug` | array | - | Filtrer par slug |
| `status` | array | publish | États (publish, future, draft, pending, private) |
| `categories` | array | [] | IDs de catégories |
| `tags` | array | [] | IDs de tags |
| `author` | array | [] | IDs d'auteurs |

#### Response Headers
```
X-WP-Total: 7
X-WP-TotalPages: 1
```

#### Response (200 OK)
```json
[
  {
    "id": 128,
    "title": {"rendered": "Expérience professionnelle"},
    "content": {"rendered": "<ul>...</ul>"},
    ...
  },
  {
    "id": 153,
    "title": {"rendered": "Formations et Diplômes"},
    "content": {"rendered": "<ul>...</ul>"},
    ...
  }
]
```

---

### 3. GET /wp/v2/pages/{id}

Récupère une page individuelle.

#### Request
```http
GET /wp/v2/pages/181 HTTP/1.1
Host: api-cv.corbisier.fr
Accept: application/json
```

#### Response
Structure similaire aux posts, avec des champs spécifiques aux pages:
- `parent`: ID de la page parente
- `menu_order`: Ordre dans le menu
- `template`: Template WordPress utilisé

---

## IDs des Posts CV

### Posts Actuels
```php
[
    'experience' => 128,    // Expérience professionnelle
    'formations' => 153,    // Formations et Diplômes
    'expertise' => 126,     // Compétences techniques
    'polyvalence' => 121,   // Compétences transversales
    'softskills' => 130,    // Compétences comportementales
    'autre1' => 74,         // Contenu supplémentaire 1
    'autre2' => 134,        // Contenu supplémentaire 2
]
```

### Page d'Accueil
```
ID: 181 (page_on_front)
```

---

## Exemples de Requêtes

### PHP (cURL)

```php
<?php
function getPost($id) {
    $url = "https://api-cv.corbisier.fr/wp-json/wp/v2/posts/{$id}";
    
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTPHEADER => [
            'Accept: application/json',
        ],
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode === 200) {
        return json_decode($response, true);
    }
    
    return null;
}

// Utilisation
$post = getPost(128);
echo $post['content']['rendered'];
```

### PHP (file_get_contents)

```php
<?php
function getPost($id) {
    $url = "https://api-cv.corbisier.fr/wp-json/wp/v2/posts/{$id}";
    
    $opts = [
        'http' => [
            'method' => 'GET',
            'header' => 'Accept: application/json',
            'timeout' => 30,
        ]
    ];
    
    $context = stream_context_create($opts);
    $response = @file_get_contents($url, false, $context);
    
    if ($response !== false) {
        return json_decode($response, true);
    }
    
    return null;
}
```

### JavaScript (Fetch API)

```javascript
async function getPost(id) {
    try {
        const response = await fetch(
            `https://api-cv.corbisier.fr/wp-json/wp/v2/posts/${id}`,
            {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                }
            }
        );
        
        if (!response.ok) {
            throw new Error(`HTTP ${response.status}`);
        }
        
        return await response.json();
    } catch (error) {
        console.error('Erreur API:', error);
        return null;
    }
}

// Utilisation
getPost(128).then(post => {
    if (post) {
        console.log(post.content.rendered);
    }
});
```

### JavaScript (Axios)

```javascript
import axios from 'axios';

async function getPost(id) {
    try {
        const response = await axios.get(
            `https://api-cv.corbisier.fr/wp-json/wp/v2/posts/${id}`,
            {
                headers: {
                    'Accept': 'application/json',
                },
                timeout: 30000,
            }
        );
        
        return response.data;
    } catch (error) {
        console.error('Erreur API:', error);
        return null;
    }
}
```

---

## Gestion des Erreurs

### Codes HTTP Courants

| Code | Signification | Action |
|------|---------------|--------|
| 200 | OK | Succès |
| 304 | Not Modified | Utiliser le cache |
| 400 | Bad Request | Vérifier les paramètres |
| 401 | Unauthorized | Authentification requise |
| 403 | Forbidden | Accès interdit |
| 404 | Not Found | Ressource introuvable |
| 500 | Server Error | Réessayer plus tard |
| 503 | Service Unavailable | Serveur indisponible |

### Exemple de Gestion d'Erreurs

```php
<?php
function getPostSafe($id) {
    $maxRetries = 3;
    $retryDelay = 1; // secondes
    
    for ($i = 0; $i < $maxRetries; $i++) {
        $url = "https://api-cv.corbisier.fr/wp-json/wp/v2/posts/{$id}";
        
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => ['Accept: application/json'],
        ]);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        
        // Succès
        if ($httpCode === 200) {
            return json_decode($response, true);
        }
        
        // Erreur permanente (ne pas réessayer)
        if (in_array($httpCode, [400, 401, 403, 404])) {
            error_log("Erreur API permanente: {$httpCode}");
            return null;
        }
        
        // Erreur temporaire (réessayer)
        if ($i < $maxRetries - 1) {
            error_log("Tentative " . ($i + 1) . " échouée, nouvelle tentative dans {$retryDelay}s");
            sleep($retryDelay);
            $retryDelay *= 2; // Backoff exponentiel
        }
    }
    
    error_log("Échec après {$maxRetries} tentatives");
    return null;
}
```

---

## Optimisations

### 1. Utiliser le paramètre `_embed`

Récupère les ressources liées (auteur, média) en une seule requête:

```http
GET /wp/v2/posts/128?_embed HTTP/1.1
```

### 2. Limiter les champs retournés

Utiliser `_fields` pour ne récupérer que les champs nécessaires:

```http
GET /wp/v2/posts/128?_fields=id,title,content,modified HTTP/1.1
```

### 3. Headers de Cache

Utiliser les headers de cache pour éviter les requêtes inutiles:

```php
if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
    // Vérifier si le contenu a changé
    if ($lastModified <= strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
        header('HTTP/1.1 304 Not Modified');
        exit;
    }
}

header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $lastModified) . ' GMT');
header('Cache-Control: public, max-age=3600');
```

---

## Sécurité

### 1. Validation des Données

Toujours valider et échapper les données de l'API:

```php
<?php
// Échapper pour l'affichage HTML
echo htmlspecialchars($post['title']['rendered'], ENT_QUOTES, 'UTF-8');

// Ou utiliser une fonction dédiée
function escapeHtml($text) {
    return htmlspecialchars($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}
```

### 2. Filtrer le HTML

Si vous affichez du contenu HTML de l'API, filtrez-le:

```php
<?php
// Utiliser strip_tags pour retirer le HTML
$clean = strip_tags($post['content']['rendered']);

// Ou utiliser HTMLPurifier pour un filtrage avancé
require_once 'HTMLPurifier.auto.php';
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);
$clean = $purifier->purify($post['content']['rendered']);
```

### 3. Timeout et Limites

Toujours définir des timeouts pour éviter les blocages:

```php
// cURL
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

// file_get_contents
ini_set('default_socket_timeout', 30);
```

---

## Tests avec cURL (ligne de commande)

```bash
# Récupérer un post
curl -X GET "https://api-cv.corbisier.fr/wp-json/wp/v2/posts/128" \
     -H "Accept: application/json"

# Récupérer plusieurs posts
curl -X GET "https://api-cv.corbisier.fr/wp-json/wp/v2/posts?include[]=128&include[]=153&include[]=126" \
     -H "Accept: application/json"

# Avec champs limités
curl -X GET "https://api-cv.corbisier.fr/wp-json/wp/v2/posts/128?_fields=id,title,content" \
     -H "Accept: application/json"

# Afficher les headers
curl -I "https://api-cv.corbisier.fr/wp-json/wp/v2/posts/128"
```

---

## Ressources Supplémentaires

- [Documentation officielle WordPress REST API](https://developer.wordpress.org/rest-api/)
- [WordPress REST API Handbook](https://developer.wordpress.org/rest-api/reference/)
- [Postman Collection pour WordPress](https://www.postman.com/wordpress-api/)

---

*Dernière mise à jour : 17 décembre 2024*
