# Le Pacte de Gray
Site littéraire dédié à l'univers du roman "Le Portrait de Dorian Gray" d'Oscar Wilde (1890, domaine public). Développé en PHP, MySQL et MongoDB.

## Environnement de travail
- XAMPP (Apache + MySQL)
- PHP 8.2
- Composer
- Git
- Extension PHP MongoDB
- Un compte MongoDB Atlas

## Installation

1. Cloner le projet :
git clone https://github.com/Rika600/le-pacte-de-gray.git

2. Placer le dossier dans `C:\xampp\htdocs\le-pacte-de-gray`

3. Installer les dépendances PHP :
cd C:\xampp\htdocs\le-pacte-de-gray
composer install

## Base de données

1. Lancer XAMPP (Apache + MySQL)
2. Ouvrir phpMyAdmin : `http://localhost:8080/phpmyadmin`
3. Créer une base de données `pacte_de_gray`
4. Importer le fichier `database/database.sql` (onglet Importer)

## Configuration

Créer un fichier `config.php` à la racine du projet avec :

```php
<?php
define('BASE_URL', '/le-pacte-de-gray/');
define('DB_HOST', '127.0.0.1');
define('DB_PORT', '3306');
define('DB_NAME', 'pacte_de_gray');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

define('MONGODB_URI', 'votre_lien_mongodb_atlas');
define('MAIL_USERNAME', 'votre_email@gmail.com');
define('MAIL_PASSWORD', 'votre_mot_de_passe_application');
```

Ce fichier est dans le `.gitignore` et ne doit jamais être commité.

## Lancer le projet

1. Démarrer Apache et MySQL dans XAMPP
2. Ouvrir le navigateur : `http://localhost:8080/le-pacte-de-gray/`

## Synchronisation MongoDB

Pour synchroniser les statistiques vers MongoDB Atlas :
`http://localhost:8080/le-pacte-de-gray/api/sync-mongodb.php`

## Identifiants de test

|        Rôle    |          Email         | Mot de passe |
|----------------|------------------------|--------------|
| Administrateur | admin@pacte-de-gray.fr | password     |

## Technologies

- **Front-end** : HTML5, CSS3, Bootstrap 5, JavaScript (AJAX/fetch)
- **Back-end** : PHP 8.2 (POO), PDO, PHPMailer
- **Base de données** : MySQL (relationnelle), MongoDB Atlas (non relationnelle)
- **Outils** : Git/GitHub, Figma, Composer

## Lancer avec Docker
1. Installer Docker Desktop
2. Lancer : `docker-compose up --build`
3. Ouvrir le navigateur : `http://localhost:8081/` (Horizons Lointains) ou `http://localhost:8082/` (Le Pacte de Gray)

- **Déploiement** : Local (XAMPP)
