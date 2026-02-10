---
marp: true
theme: default
style: |
  section {
    background-color: #ffffff;
    color: #333333;
    font-family: 'Segoe UI', Helvetica, Arial, sans-serif;
  }
  h1 {
    color: #1a202c;
    font-size: 1.6em;
    font-weight: 600;
  }
  h2 {
    color: #4a5568;
    font-size: 1.5em;
    font-weight: 300;
  }
  section.title-slide {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    background: #ffffff;
  }
  section.title-slide h1 {
    font-size: 1.6em;
    margin-bottom: 0.5em;
    color: #2d3748;
    text-transform: uppercase;
    letter-spacing: 2px;
  }
  section.title-slide h2 {
    margin-bottom: 3em;
    color: #718096;
    font-size: 1.4em;
    font-weight: 300;
  }
  .info-box {
    padding: 20px 0;
    margin-top: 20px;
    text-align: left;
  }
  .info-box strong {
    display: inline-block;
    width: 180px;
    margin: 8px 0;
    font-size: 1em;
    color: #718096;
    font-weight: 500;
  }
  .info-box span {
    font-weight: 600;
    color: #2d3748;
  }
---



# **Présentation Projet-technique**

## Application de gestion de tâches

<div class="info-box">

**Réalisé par :** <span>Fadna Lakhouchen</span>
**Encadré par :** <span>M. ESSARRAJ FOUAD</span>


</div>

---

## Plan

<div style="font-size: 20px;">

| | |
| :--- | :--- |
| 1. Méthode Waterfall | 9. v2 : Admin Side |
| 2. Exigences : Travail à faire | 10. v3 : Authentification / Authorization |
| 3. Contexte : projet fin de formation | 11. v4 : SPA / AJAX |
| 4. Analyse Technique | 12. v5 : SPA / Alpine.js |
| 5. Analyse Fonctionnelle | 13. v6 : Spatie / Authorization |
| 6. Conception | 14. v7 : API |
| 7. Versions | 15. v8 : Mobile App |
| 8. v1 : Public Side | |

</div>

---


## La méthode Waterfall (En cascade)

![w:900 Waterfall](img_presentation/Waterfall.png)


---

## Exigences - Travail à faire

### Partie Publique
*   Affichage des tâches en grille avec pagination.
*   Consultation détaillée de chaque tâche.
*   Interface responsive avec Tailwind CSS.

### Partie Admin
*   Gestion complète CRUD des tâches.
*   Tableau de bord sécurisé.
*   Modales pour ajouter/éditer avec validation.
*   Architecture N-tier avec Services.


---

## Contexte : projet fin de formation
*   **Projet de Fin de Formation:** Ce projet technique a pour objectif d'appliquer les connaissances acquises et de valider notre compréhension.

#### Processus 2TUP

![center h:380](img_presentation/2TUP.png)



---


# Analyse Technique
### Technologies à Utilisée
1. **Base de données** : Mysql.
2. **Framework** : Laravel.
3. **Architecture N-tier** : Services.
4. **Architecture** : MVC.
5. **Moteur de vues** : Blade.
6. **AJAX** : Interactivité fluide sans rechargement.
7. **Gestion des Images** : Upload et stockage sécurisé.
8. **Internationalisation** : Support multilingue de l'interface.
---
9. **Vite** : Optimisation des performances.
10. **Preline UI** : Intégration d'un design système moderne.
11. **Lucide Library**
12. **Tailwind CSS** : Framework CSS utilitaire pour un design réactif et moderne.
---
## Analyse Fonctionnelle

![center](img_presentation/use_case.png)



---

## Conception
![center h:450](img_presentation/diagramme_class.png)


---

## Versions

| Version | Description | Branche |
| :--- | :--- | :--- |
| **v1** | Public Side (Consultation, Recherche, Filtre) | `public` |
| **v2** | Admin Side (CRUD, Modales) | `admin` |
| **v3** | Authentification / Authorization (Gates) | `gates` |
| **v4** | SPA / AJAX | `spa-ajax` |
| **v5** | SPA / Alpine.js | `spa-alpine` |
| **v6** | Spatie / Authorization | `spatie` |
| **v7** | API | `api` |
| **v8** | Mobile App | `mobile` |

---

## **v1** : Public Side

* **Live Coding :** Création du portfolio personnel

---

## **v2** : Admin Side

* **Live Coding :** Gestion des articles (CRUD)

---

## **v3** : Authentification / Authorization

* **Live Coding :** 

---

## **v4** : SPA / AJAX

* **Live Coding :** 
  - Bouton “Ajouter” via modale
  - Barre de recherche dynamique

---

## **v5** : SPA / Alpine.js

* **Live Coding :** 

---

## **v6** : Spatie / Authorization

* **Live Coding :**

---

## **v7** : API

* **Live Coding :** 

---

## **v8** : Mobile App

* **Live Coding :** 