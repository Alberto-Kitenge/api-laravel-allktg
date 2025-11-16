# Blog API - Laravel Learning Project

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-316192?style=for-the-badge&logo=postgresql&logoColor=white)
![Sanctum](https://img.shields.io/badge/Sanctum-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![REST API](https://img.shields.io/badge/REST-02569B?style=for-the-badge&logo=rest&logoColor=white)

</div>

## 📋 À propos du projet

Projet d'apprentissage personnel pour maîtriser la création d'APIs RESTful avec Laravel. Ce projet simule un système de blog avec authentification et gestion de contenu.

**Objectif** : S'exercer sur les concepts fondamentaux des APIs Laravel : authentification, CRUD, relations, validation, et bonnes pratiques.

### Fonctionnalités

- **Authentification API** : Inscription, connexion et gestion de tokens avec Laravel Sanctum
- **Gestion d'utilisateurs** : CRUD complet des utilisateurs
- **Articles de blog** : Création, lecture, modification et suppression d'articles
- **Relations de données** : Associations entre utilisateurs et contenus
- **Validation** : Validation robuste des entrées utilisateur

## 🛠️ Stack technique

- **Framework** : Laravel 12 (PHP 8.2+)
- **Authentification** : Laravel Sanctum 4.0
- **Base de données** : PostgreSQL (configuration par défaut)
- **Testing** : Pest PHP 4.1
- **Outils de développement** : Laravel Breeze, Pint, Pail

## 📎 Prérequis

- PHP 8.2 ou supérieur
- Composer
- PostgreSQL (ou MySQL/SQLite selon votre préférence)
- Un client API (Postman, Insomnia, Thunder Client, etc.)

## 🚀 Installation

1. **Cloner le projet**
```bash
git clone <repository-url>
cd api-laravel-allktg
```

2. **Installer les dépendances**
```bash
composer install
```

3. **Configurer l'environnement**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configurer la base de données**

Par défaut, le projet est configuré pour PostgreSQL. Modifiez le fichier `.env` selon votre configuration :

**Option A : PostgreSQL (par défaut)**
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=blog_api
DB_USERNAME=postgres
DB_PASSWORD=votre_mot_de_passe
```

**Option B : MySQL**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_api
DB_USERNAME=root
DB_PASSWORD=
```

**Option C : SQLite (développement)**
```bash
touch database/database.sqlite
```
```env
DB_CONNECTION=sqlite
```

5. **Exécuter les migrations**
```bash
php artisan migrate
```

6. **(Optionnel) Générer des données de test**
```bash
php artisan db:seed
```

## 🎯 Utilisation

### Démarrer le serveur de développement

```bash
php artisan serve
```

L'API sera accessible sur `http://localhost:8000`

### Endpoints de l'API

#### Authentification
```
POST   /api/register      # Inscription
POST   /api/login         # Connexion
POST   /api/logout        # Déconnexion (authentifié)
GET    /api/user          # Profil utilisateur (authentifié)
```

#### Utilisateurs
```
GET    /api/users         # Liste des utilisateurs
GET    /api/users/{id}    # Détails d'un utilisateur
PUT    /api/users/{id}    # Modifier un utilisateur
DELETE /api/users/{id}    # Supprimer un utilisateur
```

#### Articles (à venir)
```
GET    /api/posts         # Liste des articles
POST   /api/posts         # Créer un article
GET    /api/posts/{id}    # Détails d'un article
PUT    /api/posts/{id}    # Modifier un article
DELETE /api/posts/{id}    # Supprimer un article
```

### Tests

```bash
php artisan test
# ou
composer test
```

### Formatage du code

```bash
./vendor/bin/pint
```

## 📂 Structure du projet

```
.
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Auth/              # Contrôleurs d'authentification
│   │   └── Requests/              # Validation des requêtes
│   └── Models/
│       └── User.php               # Modèle utilisateur
├── database/
│   ├── factories/                 # Factories pour les tests
│   ├── migrations/                # Migrations de base de données
│   └── seeders/                   # Seeders pour données de test
├── routes/
│   ├── api.php                    # Routes de l'API
│   └── auth.php                   # Routes d'authentification
└── tests/                         # Tests unitaires et fonctionnels
```

## 🔐 Authentification

L'API utilise **Laravel Sanctum** pour l'authentification par tokens.

### Comment authentifier les requêtes

1. Inscrivez-vous ou connectez-vous pour obtenir un token
2. Incluez le token dans l'en-tête de vos requêtes :
```
Authorization: Bearer votre_token_ici
```

### Exemple avec cURL

```bash
# Inscription
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{"name":"John Doe","email":"john@example.com","password":"password"}'

# Connexion
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"john@example.com","password":"password"}'

# Requête authentifiée
curl -X GET http://localhost:8000/api/user \
  -H "Authorization: Bearer votre_token"
```

## 🎓 Concepts Laravel abordés

- ✅ Architecture MVC
- ✅ Eloquent ORM et relations
- ✅ Migrations et seeders
- ✅ API Resources et Collections
- ✅ Form Requests et validation
- ✅ Middleware et authentification
- ✅ Laravel Sanctum pour les tokens
- ✅ Tests avec Pest PHP
- 🔄 Pagination
- 🔄 Gestion des erreurs et exceptions
- 🔄 Queues et jobs
- 🔄 Rate limiting

## 📝 Licence

Ce projet est distribué sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus de détails.

---

**Note** : Ce projet est un exercice d'apprentissage personnel. Il peut évoluer au fil de mes progrès.
