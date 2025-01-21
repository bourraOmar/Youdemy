# Projet Youdemy

## Présentation
Youdemy est une plateforme de gestion de l'apprentissage (LMS) conçue pour simplifier la gestion des cours, des utilisateurs et du contenu éducatif. La plateforme s'adapte aux besoins de différents rôles : visiteurs, étudiants, enseignants et administrateurs, en offrant des fonctionnalités spécifiques pour chacun.

## Fonctionnalités Clés

### Interface Publique

#### Visiteurs
- Parcourir le catalogue de cours avec pagination.
- Rechercher des cours par mots-clés.
- Créer un compte et choisir un rôle (Étudiant ou Enseignant).

#### Étudiants
- Explorer le catalogue de cours.
- Rechercher et consulter les détails des cours (description, contenu, professeur, etc.).
- S'inscrire à des cours après connexion.
- Gérer les cours suivis dans la section "Mes Cours".

#### Enseignants
- Ajouter de nouveaux cours avec des détails complets :
  - Titre, description, contenu (vidéo ou document), tags et catégorie.
- Gérer les cours existants :
  - Modifier, supprimer et consulter la liste des étudiants inscrits.
- Accéder à une section "Statistiques" :
  - Nombre d'étudiants inscrits, nombre total de cours créés, etc.

### Interface d'Administration

#### Administrateurs
- Valider les comptes des enseignants.
- Gérer les utilisateurs :
  - Activer, suspendre ou supprimer des comptes.
- Superviser le contenu :
  - Cours, catégories et tags.
- Insérer des tags en masse pour plus d'efficacité.
- Accéder aux statistiques globales :
  - Nombre total de cours, répartition par catégorie, cours les plus populaires, Top 3 des enseignants.

### Fonctionnalités Transversales
- Les cours peuvent avoir plusieurs tags (relation many-to-many).
- Utilisation du polymorphisme pour des méthodes comme l'ajout et l'affichage des cours.
- Système d'authentification et d'autorisation pour sécuriser les routes sensibles.
- Contrôle d'accès basé sur les rôles pour garantir que chaque utilisateur accède uniquement aux fonctionnalités correspondant à son rôle.

## Exigences Techniques
- Respect des principes de la Programmation Orientée Objet (encapsulation, héritage, polymorphisme).
- Base de données relationnelle avec une gestion appropriée des relations (one-to-many, many-to-many).
- Utilisation des sessions PHP pour gérer les utilisateurs authentifiés.
- Validation des données utilisateur pour renforcer la sécurité.

## Installation

1. Clonez le dépôt :
   ```bash
   git clone https://github.com/WissamDouskary/Youdemy.git
   ```
2. Accédez au répertoire du projet :
   ```bash
   cd Youdemy
   ```
3. Configurez la base de données :
   - Importez le fichier SQL fourni dans votre système de gestion de base de données.
   - Configurez les identifiants de la base de données dans le projet.
4. Démarrez un serveur local :
   ```bash
   php -S localhost:8000
   ```
5. Accédez à l'application dans votre navigateur à l'adresse `http://localhost:8000`.

## Contribution
Les contributions sont les bienvenues ! Suivez ces étapes :

1. Forkez le dépôt.
2. Créez une nouvelle branche :
   ```bash
   git checkout -b nom-de-la-fonctionnalité
   ```
3. Committez vos modifications :
   ```bash
   git commit -m "Description de la fonctionnalité"
   ```
4. Poussez vers la branche :
   ```bash
   git push origin nom-de-la-fonctionnalité
   ```
5. Soumettez une pull request.

## Licence
Ce projet est sous licence MIT.

## Remerciements
Un grand merci à tous les contributeurs qui ont aidé à améliorer ce projet. Votre travail est grandement apprécié !
