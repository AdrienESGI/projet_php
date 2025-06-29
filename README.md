# 📘 Projet Alternance IT – Site + ESP32

##  Présentation

Ce projet a été conçu pour répondre à un double besoin :
- faciliter la **mise en relation entre alternants et entreprises IT**
- explorer les possibilités d’un **serveur web embarqué** avec l’ESP32

Le système repose sur **trois modules interconnectés** :
1. Une **application web complète** (PHP/MySQL)
2. Une **base de données relationnelle** robuste
3. Un **serveur ESP32 embarqué** autonome avec API REST

---

##  Auteurs

- **Adrien GUILLON** : Backend PHP & Base de données MySQL  
- **Clément BOYER** : Développement embarqué ESP32  
- **Nahel SAMSON** : Frontend HTML/CSS & UI  
- **Encadrant** : Sébastien PLATTARD  
- **Établissement** : ESGI – 1ère année, classe 1B  

---

## 🗂 Structure du site web

```txt
/ (racine)
├── index.php                      # Page d’accueil
├── login.php                      # Connexion utilisateur
├── logout.php                     # Déconnexion
├── register.php                   # Inscription
├── profil.php                     # Fiche utilisateur
├── creer_cv.php                   # Formulaire de CV
├── generate_cv.php                # Génération du CV PDF via TCPDF
├── offres.php                     # Liste des offres
├── annonces.php                   # Détail d'une annonce
├── postuler.php                   # Postuler à une offre
├── candidatures.php               # Suivi des candidatures
├── competences.php                # Liste des compétences
├── suivi_competences.php          # Compétences utilisateur
├── messages.php                   # Messagerie interne
├── assets/                        # Images, styles CSS
└── includes/                      # Connexion DB, fonctions, utilitaires


## ⚙ Stack technique

### Web
- **Frontend** : HTML5, CSS3, JS vanilla
- **Backend** : PHP 8 (sans framework)
- **Base de données** : MySQL 5.7/8.0
- **PDF** : TCPDF

### ESP32
- **Microcontrôleur** : ESP32 WROVER (WiFi + BLE)
- **IDE** : Arduino IDE
- **Librairies** :
  - `ESPAsyncWebServer`
  - `SPIFFS` / `SD.h`
  - `Hash.h` (SHA-256)

---

---

##  Sécurité

- Hash des mots de passe : SHA-256 ou `password_hash` (BCRYPT)
- Requêtes préparées (PDO)
- Vérification des rôles par `$_SESSION['role']`
- Aucune donnée sensible stockée en clair sur l’ESP32
- Authentification ESP32 via cookie + SHA-256

---

##  Fonctionnalités clés

- Création de profil complet enrichi
- Génération dynamique de CV PDF
- Publication et filtrage d’annonces
- Suivi des candidatures
- Messagerie interne
- Matching par compétences
- Serveur ESP32 avec upload sécurisé

---

##  Base de données – Tables principales

- `utilisateurs`
- `profil_utilisateur`
- `annonces`
- `candidatures`
- `competences`, `utilisateurs_competences`, `annonces_competences`
- `experiences_professionnelles`
- `messages`

---

##  Améliorations envisagées

- Passage à HTTPS (via proxy NGINX)
- Portage vers React ou Vue.js
- SPIFFS OTA pour l’ESP32
- Normalisation 3FN + triggers en base

---

> Ce projet est un **MVP** démontrant la faisabilité d’un environnement complet mêlant **développement web**, **embarqué**, et **logique métier structurée**.

