# IT Asset Manager

Un système orienté objet (POO) complet de gestion de parc informatique basé sur l'architecture MVC native en PHP 8.

---

## Fonctionnalités Clés

- **Tableau de bord statistique :** Métriques d'équipements et graphiques interactifs (Chart.js) groupés par statut et marque.
- **Gestion du Parc (CRUD) :** Ajout, modification, suppression et consultation des équipements informatiques.
- **Génération de QR Code (Endroid) :** Génération dynamique de QR Codes imprimables pour chaque équipement permettant une identification rapide.
- **Consultation Publique par Scan :** La fiche détaillée d'un équipement (`show-asset`) est directement accessible au scan du QR Code par n'importe quel utilisateur sans authentification.
- **Espace Technicien Sécurisé :** Gestion des sessions et accès aux actions d'administration (CRUD/Dashboard) protégé par mot de passe (hachage `BCRYPT`).

---

## Audit & Sécurité

1. **Protection Injection SQL :** Toutes les interactions avec la base de données MySQL s'effectuent via l'extension PDO avec **requêtes préparées et paramètres liés**.
2. **Protection Faille XSS :** L'ensemble des variables affichées dans les vues est échappé systématiquement avec `htmlspecialchars()`.
3. **Sécurisation des Identifiants :** Mots de passe utilisateurs sécurisés en BDD avec la fonction native PHP `password_hash()` (`PASSWORD_BCRYPT`).
4. **Contrôle d'Accès centralisé :** Le routeur vérifie les sessions sur toutes les routes sensibles.

---

## Architecture du Projet (MVC Native)

```text
itAssetManager/
├── config/
│   └── Database.php          # Singleton de connexion PDO MySQL
├── public/
│   └── index.php             # Point d'entrée unique (Front Controller)
├── src/
│   ├── Controllers/          # Contrôleurs (AssetController, DashboardController, AuthController)
│   ├── Models/               # Modèles de données PDO (Asset, User)
│   └── Router.php            # Routeur centralisé en POO
├── views/
│   ├── assets/               # Vues pour la gestion des équipements
│   ├── auth/                 # Vue de connexion
│   ├── layout/               # Header & Footer Bootstrap
│   └── dashboard.php         # Vue statistiques avec Chart.js
├── composer.json             # Autoloading PSR-4 & Dépendances
└── README.md