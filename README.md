# Tweetly
# Tweetly - Réseau Social Minimaliste

Bienvenue sur **Tweetly**, un projet de réseau social minimaliste inspiré de Twitter. Ce projet permet aux utilisateurs de s'inscrire, se connecter, publier des tweets, suivre d'autres utilisateurs, envoyer des messages privés, et bien plus encore.

## Fonctionnalités

- **Inscription et Connexion** : Les utilisateurs peuvent créer un compte et se connecter pour accéder à la plateforme.
- **Publication de Tweets** : Publiez des tweets avec du texte et des images (jusqu'à 4 médias par tweet).
- **Suivi et Abonnés** : Suivez d'autres utilisateurs et consultez vos abonnés.
- **Messages Privés** : Envoyez et recevez des messages privés avec d'autres utilisateurs.
- **Personnalisation de Profil** : Modifiez votre photo de profil, bannière, biographie, et autres informations personnelles.
- **Thème Clair/Sombre** : Alternez entre les thèmes clair et sombre pour une meilleure expérience utilisateur.
- **Recherche** : Recherchez des utilisateurs via une barre de recherche dynamique.
- **Mises à jour en temps réel** : Les tweets et messages sont mis à jour automatiquement.

## Structure du Projet

Voici la structure principale du projet :
. ├── index.php # Page principale ├── ajax.php # Gestion des requêtes AJAX ├── app.php # Fichier principal incluant les dépendances ├── app.css # Styles personnalisés ├── app.js # Scripts JavaScript pour les interactions ├── assets/ # Contient les ressources (images, polices, etc.) │ ├── db_banner/ # Bannières des utilisateurs │ ├── db_logo/ # Logos des utilisateurs │ ├── db_tweet/ # Médias des tweets │ ├── fonts/ # Polices utilisées │ └── tailwind/ # Fichiers Tailwind CSS ├── pages/ # Pages spécifiques │ ├── login.php # Page de connexion │ └── register.php # Page d'inscription ├── process/ # Scripts de traitement │ ├── updateMessage.php # Mise à jour des messages │ └── updateTweet.php # Mise à jour des tweets └── src/ # Classes PHP ├── Auth.php # Gestion de l'authentification ├── Database.php # Connexion à la base de données ├── Tweet.php # Gestion des tweets └── User.php # Gestion des utilisateurs

## Installation

1. Clonez ce dépôt sur votre machine locale :
   ```bash
   git clone https://github.com/votre-utilisateur/tweetly.git

   Configurez votre serveur local (Apache, Nginx, etc.) pour pointer vers le dossier public.

Importez la base de données :

Créez une base de données MySQL.
Importez le fichier SQL fourni (par exemple, database.sql).
Configurez la connexion à la base de données dans src/Database.php :

<?php
private $host = 'localhost';
private $db_name = 'nom_de_votre_base';
private $username = 'votre_utilisateur';
private $password = 'votre_mot_de_passe';

npm install
npx tailwindcss -i ./assets/tailwind/input.css -o ./assets/tailwind/output.css --watch

Lancez votre serveur et accédez à l'application via votre navigateur.

Technologies Utilisées
Frontend :
HTML, CSS (avec Tailwind CSS), JavaScript (jQuery)
Backend :
PHP
Base de Données :
MySQL
Contributions
Les contributions sont les bienvenues ! Si vous souhaitez améliorer ce projet, n'hésitez pas à soumettre une pull request ou à ouvrir une issue.

Auteur
Ce projet a été réalisé par [Votre Nom]. Si vous avez des questions, vous pouvez me contacter à votre.email@example.com.

Licence
Ce projet est sous licence MIT. Vous êtes libre de l'utiliser, le modifier et le distribuer.

Merci d'avoir exploré Tweetly ! 🚀 ```
