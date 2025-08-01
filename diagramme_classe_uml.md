# Diagramme de Classe UML - Référentiel Centralisé Multi-SGBD

```mermaid
classDiagram
    class User {
        +id: Integer
        +nom: String
        +email: String
        +mot_de_passe: String
        +role: String
        +date_creation: DateTime
        +date_modification: DateTime
        +connecter()
        +deconnecter()
        +gererProfil()
    }

    class Profil {
        +id: Integer
        +nom: String
        +description: String
        +permissions: Array
        +date_creation: DateTime
        +creerProfil()
        +modifierProfil()
        +supprimerProfil()
        +assignerPermissions()
    }

    class SGBD {
        +id: Integer
        +nom: String
        +type: String
        +version: String
        +serveur: String
        +port: Integer
        +base_donnees: String
        +parametres_connexion: JSON
        +date_creation: DateTime
        +testerConnexion()
        +configurerSGBD()
    }

    class Script {
        +id: Integer
        +nom: String
        +description: String
        +contenu: Text
        +type: String
        +version: String
        +auteur_id: Integer
        +sgbd_id: Integer
        +statut: String
        +tags: Array
        +date_creation: DateTime
        +date_modification: DateTime
        +creer()
        +modifier()
        +supprimer()
        +executer()
        +versioner()
    }

    class Version {
        +id: Integer
        +script_id: Integer
        +numero_version: String
        +contenu: Text
        +commentaire: String
        +auteur_id: Integer
        +date_creation: DateTime
        +creerVersion()
        +restaurerVersion()
        +comparerVersions()
    }

    class Environnement {
        +id: Integer
        +nom: String
        +description: String
        +type: String
        +sgbd_id: Integer
        +configuration: JSON
        +date_creation: DateTime
        +configurer()
        +activer()
        +desactiver()
    }

    class Execution {
        +id: Integer
        +script_id: Integer
        +environnement_id: Integer
        +utilisateur_id: Integer
        +statut: String
        +message_erreur: String
        +temps_execution: Integer
        +date_execution: DateTime
        +logs: Text
        +executer()
        +annuler()
        +consulterLogs()
    }

    class Dependance {
        +id: Integer
        +script_parent_id: Integer
        +script_enfant_id: Integer
        +type_dependance: String
        +obligatoire: Boolean
        +date_creation: DateTime
        +creerDependance()
        +supprimerDependance()
        +verifierDependances()
    }

    class Permission {
        +id: Integer
        +nom: String
        +description: String
        +module: String
        +action: String
        +creer()
        +modifier()
        +supprimer()
    }

    class Journal {
        +id: Integer
        +utilisateur_id: Integer
        +action: String
        +objet_type: String
        +objet_id: Integer
        +details: JSON
        +date_action: DateTime
        +enregistrer()
        +consulter()
        +filtrer()
    }

    class Tag {
        +id: Integer
        +nom: String
        +couleur: String
        +description: String
        +date_creation: DateTime
        +creer()
        +modifier()
        +supprimer()
    }

    class Historique {
        +id: Integer
        +script_id: Integer
        +utilisateur_id: Integer
        +action: String
        +ancienne_valeur: Text
        +nouvelle_valeur: Text
        +date_modification: DateTime
        +enregistrer()
        +consulter()
    }

    class Notification {
        +id: Integer
        +utilisateur_id: Integer
        +titre: String
        +message: Text
        +type: String
        +lu: Boolean
        +date_creation: DateTime
        +envoyer()
        +marquerComeLu()
        +supprimer()
    }

    class Recherche {
        +criteres: JSON
        +resultats: Array
        +filtres: Array
        +rechercherParMotCle()
        +rechercherParTag()
        +rechercherParAuteur()
        +rechercherParSGBD()
        +filtrerResultats()
    }

    class Sauvegarde {
        +id: Integer
        +nom: String
        +chemin: String
        +taille: Integer
        +date_creation: DateTime
        +type: String
        +creerSauvegarde()
        +restaurerSauvegarde()
        +planifierSauvegarde()
    }

    %% Relations
    User ||--o{ Script : "crée"
    User ||--|| Profil : "possède"
    User ||--o{ Execution : "effectue"
    User ||--o{ Journal : "génère"
    User ||--o{ Notification : "reçoit"
    
    Profil ||--o{ Permission : "contient"
    
    SGBD ||--o{ Script : "supporte"
    SGBD ||--o{ Environnement : "héberge"
    
    Script ||--o{ Version : "possède"
    Script ||--o{ Execution : "exécuté"
    Script ||--o{ Dependance : "dépend_de"
    Script ||--o{ Dependance : "requis_par"
    Script ||--o{ Historique : "historique"
    Script }|--o{ Tag : "tagué"
    
    Environnement ||--o{ Execution : "lieu_execution"
    
    Execution ||--|| Journal : "journalisé"
```

## Description des Classes Principales

### 1. **User (Utilisateur)**
- Gère les utilisateurs du système avec leurs rôles et permissions
- Fonctionnalités d'authentification et de gestion de profil

### 2. **Script** 
- Classe centrale du système gérant les scripts SQL
- Supporte versioning, métadonnées, et exécution multi-SGBD

### 3. **SGBD**
- Représente les différents systèmes de gestion de base de données
- PostgreSQL, MySQL, SQL Server, DB2, etc.

### 4. **Environnement**
- Définit les environnements d'exécution (développement, test, production)
- Associé à un SGBD spécifique

### 5. **Version**
- Gère le versioning des scripts avec historique complet
- Permet comparaison et restauration

### 6. **Execution**
- Trace toutes les exécutions de scripts
- Logging et monitoring des performances

### 7. **Dependance**
- Gère les dépendances entre scripts
- Assure l'ordre d'exécution correct

## Fonctionnalités Clés Implémentées

✅ **Centralisation Multi-SGBD** - Support PostgreSQL, MySQL, SQL Server, DB2  
✅ **Gestion des Versions** - Versioning complet avec historique  
✅ **Traçabilité** - Journal d'audit et historique des modifications  
✅ **Dépendances** - Gestion des relations entre scripts  
✅ **Sécurité** - Système de profils et permissions  
✅ **Recherche Avancée** - Filtrage multi-critères  
✅ **Import/Export** - Fonctionnalités de sauvegarde  
✅ **Notifications** - Système d'alertes utilisateurs  

Ce diagramme UML reflète exactement les objectifs et fonctionnalités décrits dans votre document de spécifications.