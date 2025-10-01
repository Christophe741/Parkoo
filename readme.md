# Parkoo

**Parkoo** est une application web permettant aux particuliers de proposer ou réserver une place de parking, de manière simple, rapide et sécurisée.

## Objectif

Créer un site web permettant aux utilisateurs de :

- Rechercher des places disponibles.
- Consulter le détail d'une annonce.
- Proposer sa propre place de stationnement.
- Gérer son profil (en cours de développement).
- Superviser l'activité de la plateforme (en cours de développement).

## Technologies utilisées

- **HTML / CSS / JavaScript**
- **PHP**
- **MySQL**
- **MongoDB**
- **Notion**
- **Figma**

## Lancer le projet en local

1. Cloner le projet où vous le souhaitez.
2. Copier le fichier `.env.example` en `.env`.
3. Lancer l'application avec Docker :

```sh
docker-compose up --build
```

4. Installer les dépendances PHP avec Composer :

```sh
docker-compose exec web composer install
```

5. Le site est alors accessible sur [http://localhost:8080](http://localhost:8080) et l'interface PhpMyAdmin sur [http://localhost:8081](http://localhost:8081).

## Auteur

Ce projet a été réalisé par Christophe dans le cadre d’un examen de formation DWWM chez Studi.
