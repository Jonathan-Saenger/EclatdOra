<h1 align="center">
  ✨ EclatdOra
</h1>

<p align="center">
  Plateforme moderne de vente de prestations de services, développée avec Symfony
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Status-En%20développement-blue?style=for-the-badge" alt="Status" />
  <img src="https://img.shields.io/badge/Symfony-7.x-black?style=for-the-badge&logo=symfony" alt="Symfony" />
  <img src="https://img.shields.io/badge/PHP-%3E=8.1-blue?style=for-the-badge&logo=php" alt="PHP" />
  <img src="https://img.shields.io/badge/Bootstrap-5.x-purple?style=for-the-badge&logo=bootstrap" alt="Bootstrap" />
</p>

---

## 📝 À propos du projet

**EclatdOra** a été développé initialement dans le cadre d'une mission professionnelle. La décision de rendre ce projet accessible en open source répond à une volonté de partage de connaissances et d'expérience avec la communauté des développeurs. Notre objectif est que cette application puisse servir d'exemple, d'inspiration ou de base d'apprentissage pour d'autres projets similaires.

Bien que conçu pour un contexte spécifique, le code est partagé dans l'espoir qu'il contribue positivement à l'écosystème Symfony et aide d'autres développeurs dans leurs propres défis techniques.

## 🌟 Présentation

**EclatdOra** est une application web de vente de prestations de services. Elle permet aux utilisateurs de découvrir, sélectionner et acheter des services en ligne via une interface moderne et responsive. Conçue avec une approche centrée sur l'expérience utilisateur, l'application facilite la recherche et l'achat de services tout en offrant une gestion simplifiée pour les administrateurs.

## 🚀 Fonctionnalités principales

- 🔍 **Découverte de services** - Navigation intuitive et recherche avancée
- 🛒 **Gestion de panier** - Ajout, modification et suppression de services
- 👤 **Comptes utilisateurs** - Authentification et profils personnalisés
- 💳 **Paiement sécurisé** - Processus d'achat fluide et sécurisé
- 📊 **Tableau de bord** - Suivi des commandes et historique d'achats
- 🛠️ **Administration** - Interface complète de gestion du contenu
- 📱 **Design responsive** - Adapté à tous les appareils et écrans

## 🛠️ Technologies utilisées

### Front-end
<p align="center">
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/html5/html5-original.svg" alt="HTML5" width="50" height="50"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/css3/css3-original.svg" alt="CSS3" width="50" height="50"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/javascript/javascript-original.svg" alt="JavaScript" width="50" height="50"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/bootstrap/bootstrap-original.svg" alt="Bootstrap" width="50" height="50"/>
</p>

### Back-end
<p align="center">
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/php/php-original.svg" alt="PHP" width="50" height="50"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/symfony/symfony-original.svg" alt="Symfony" width="50" height="50"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mysql/mysql-original-wordmark.svg" alt="MySQL" width="50" height="50"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/composer/composer-original.svg" alt="Composer" width="50" height="50"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/doctrine/doctrine-original.svg" alt="Doctrine" width="50" height="50"/>
</p>

## 🗂️ Structure du projet

```
EclatdOra/
├── assets/             # Ressources front-end
├── config/             # Configuration Symfony
├── migrations/         # Migrations de base de données
├── public/             # Fichiers publics accessibles
├── src/                # Code source PHP
│   ├── Controller/     # Contrôleurs de l'application
│   ├── Entity/         # Entités Doctrine (modèles)
│   ├── Form/           # Formulaires
│   ├── Repository/     # Repositories pour l'accès aux données
│   ├── Security/       # Classes liées à la sécurité
```

## ⚙️ Installation

### Prérequis
- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Symfony CLI

### Étapes d'installation

1. **Cloner le dépôt**
   ```bash
   git clone https://github.com/Jonathan-Saenger/EclatdOra.git
   cd EclatdOra
   ```

2. **Installer les dépendances PHP**
   ```bash
   composer install
   ```

3. **Configurer l'environnement**
   ```bash
   # Copier le fichier d'environnement
   cp .env .env.local

   # Configurer la connexion à la base de données dans .env.local
   # DATABASE_URL="mysql://user:password@127.0.0.1:3306/eclatdora?serverVersion=8.0"
   ```

4. **Créer la base de données et appliquer les migrations**
   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

5. **Démarrer le serveur de développement**
   ```bash
   # Avec Symfony CLI
   symfony server:start
   ```

8. **Accéder à l'application**
   L'application est maintenant accessible à l'adresse: [http://localhost:8000](http://localhost:8000)

## 🖥️ Guide d'utilisation

### Pour les visiteurs
- Parcourir le catalogue de services ou toute autre partie de l'application
- Consulter les détails des services
- Créer un compte utilisateur

### Pour les utilisateurs connectés
- Ajouter des services au panier
- Gérer le contenu du panier
- Passer des commandes
- Consulter l'historique des commandes
- Prenez rendez-vous avec Cédric M.

## 📱 Site en ligne

<p>
<a href="https://www.eclat-dora.fr">https://www.eclat-dora.fr</a>
</p>

---

<p align="center">
  <em>Développé avec passion et ✨ éclat ✨</em>
</p>