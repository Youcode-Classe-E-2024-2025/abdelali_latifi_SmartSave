# SaveSmart

SaveSmart est une application de gestion financière personnelle permettant aux utilisateurs d'optimiser leur budget et d'atteindre leurs objectifs d'épargne. Développée avec Laravel, elle offre une interface intuitive pour suivre les finances et prendre des décisions éclairées.

## Fonctionnalités

### Fonctionnalités de base (S1) :
- Inscription et authentification sécurisée.
- Gestion multi-utilisateurs pour un même compte familial.
- Suivi des revenus, dépenses et objectifs via une interface CRUD.
- Visualisation des finances sous forme de tableaux et graphiques.
- Catégorisation des transactions (Alimentation, Logement, Divertissement, Épargne, etc.).

### Fonctionnalités avancées (S2) :
- Création et suivi d'objectifs d’épargne personnalisés.
- Affichage de la progression des économies.
- Algorithme d’optimisation budgétaire basé sur des règles logiques.
- Application de la règle 50/30/20 (Besoins 50% / Envies 30% / Épargne 20%).

## Technologies utilisées
- Laravel (PHP)
- PostgreSQL
- Chart.js (Visualisation des données)

## Installation

1. **Cloner le dépôt :**
   ```sh
   git clone https://github.com/Youcode-Classe-E-2024-2025/abdelali_latifi_SmartSave.git
   cd savesmart
   ```

2. **Installer les dépendances :**
   ```sh
   composer install
   npm install
   ```

3. **Configurer l'environnement :**
   ```sh
   cp .env.example .env
   php artisan key:generate
   ```
   Modifier le fichier `.env` pour configurer la base de données.

4. **Exécuter les migrations et seeders :**
   ```sh
   php artisan migrate --seed
   ```

5. **Lancer le serveur de développement :**
   ```sh
   php artisan serve
   ```
   Accédez à l'application via [http://127.0.0.1:8000](http://127.0.0.1:8000).

