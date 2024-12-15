# Bibliothèque de Baillac

## Description

Ce projet est une application web pour la gestion d'une bibliothèque. Elle permet aux employés de se connecter, gérer les livres, enregistrer les emprunts et retours, et accéder à des fonctionnalités spécifiques en fonction de leur rôle (employé, administrateur).

## Fonctionnalités

- **Connexion des employés** : Formulaire d'authentification sécurisé.
- **Gestion des livres** : Ajouter, modifier et afficher les livres.
- **Gestion des emprunts et retours** : Suivi des emprunts et retours avec filtrage par étage et bâtiment.
- **Rôle d'administrateur** : Accès à des fonctionnalités supplémentaires pour la gestion des employés et des livres.

## Prérequis

Avant d'installer ce projet, assurez-vous que vous avez installé :

- PHP 7.4 ou supérieur
- Serveur Web (Apache ou Nginx)
- Système de gestion de base de données (PostgreSQL ou MySQL)

## Installation

1. Clonez ce repository :
    ```bash
    git clone https://github.com/username/bibliotheque_baillac.git
    ```

2. Accédez au répertoire du projet :
    ```bash
    cd bibliotheque_baillac
    ```

3. Configurez la base de données dans le fichier `config/database.php` (consultez la section *Base de données* ci-dessous).

4. Créez une base de données et importez le schéma. (Si vous n'avez pas le schéma, vous pouvez consulter la documentation de votre gestionnaire de base de données ou demander les fichiers SQL).

5. Configurez les paramètres dans `config/database.php` pour correspondre à vos informations de connexion.

6. Lancez votre serveur local et accédez à l'application via `http://localhost/bibliotheque_baillac`.

## Utilisation

### Connexion
1. Accédez à la page de connexion `/connexion`.
2. Entrez l'email et le mot de passe de l'employé.
3. Après la connexion réussie, vous serez redirigé vers la page d'accueil où vous pourrez gérer les livres, emprunts et retours.

### Gestion des livres
- Les administrateurs peuvent ajouter de nouveaux livres via la page `/livres/create`.
- La liste des livres est accessible via `/livres/list`.

### Gestion des emprunts et retours
- Les emprunts et retours sont visibles sur la page `/transactions/list`.


## Technologies Utilisées

- **PHP** : Langage principal pour le développement.
- **PostgreSQL/MySQL** : Base de données utilisée pour stocker les informations.
- **HTML/CSS/JavaScript** : Technologies utilisées pour la structure et l'interactivité de l'interface.
- **PDO** : Utilisé pour la gestion des requêtes SQL de manière sécurisée.

## Contribuer

Si vous souhaitez contribuer au projet, voici comment procéder :

1. Fork ce repository.
2. Créez une branche pour votre fonctionnalité (`git checkout -b feature/ma-fonctionnalite`).
3. Commitez vos changements (`git commit -am 'Ajout de la fonctionnalité'`).
4. Poussez la branche (`git push origin feature/ma-fonctionnalite`).
5. Ouvrez une pull request pour proposer vos modifications.

