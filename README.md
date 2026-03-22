# Gestionnaire de réservation de salles

Petit projet Laravel pour gérer les réservations de salles.

## Fonctionnalités

Cette application permet de :

* Voir les salles disponibles
* Réserver une salle pour une date et un créneau horaire
* Vérifier que la salle n'est pas déjà réservée

---

## Prérequis

* PHP >= 8.0
* Composer
* MySQL (doit être lancé)
* XAMPP ou autre serveur local

---

## Installation

1. **Récupérer le code**

```bash
git clone https://github.com/HamzaNasr1/reservation_salles_laravel.git
cd meetup-manager
```

2. **Installer les dépendances**

```bash
composer install
```

3. **Configurer la base de données**

Le fichier `.env` contient déjà une configuration de base. Modifiez ces lignes si nécessaire :

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=reservations_salles
DB_USERNAME=root
DB_PASSWORD=
```

Créez la base de données via phpMyAdmin ou MySQL :

```sql
CREATE DATABASE meetup_manager;
```

4. **Créer les tables et données de test**

```bash
php artisan migrate
php artisan db:seed
```

5. **Lancer le serveur**

```bash
php artisan serve
```

L’application est accessible à l’adresse : [http://localhost:8000](http://localhost:8000)

---


## Auteur

Projet réalisé par Hamza Nasr.
