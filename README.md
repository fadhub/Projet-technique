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
## Choix du sujet

 gestion de tâches simple et efficace pour organiser vos activités quotidiennes.

---


## La méthode Waterfall (En cascade)

![w:900 Waterfall](img_presentation/Waterfall.png)


---

## Travail à faire

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
Ce projet technique a pour objectif d'appliquer les connaissances acquises et de valider notre compréhension.

#### 2TUP

![center h:380](img_presentation/2TUP.png)



---


# Exigences - Analyse Technique
## Technologies à Utilisée
1. **Base de données** : Mysql.
2. **Framework** : Laravel.
3. **Architecture N-tier** : Services.
4. **Architecture** : MVC.
5. **Moteur de vues** : Blade.
6. **AJAX** : Interactivité fluide sans rechargement.
7. **Gestion des Images** : Upload et stockage sécurisé.
8. **Internationalisation** : Support multilingue de l'interface.
9. **Vite** : Optimisation des performances.
10. **Preline UI** : Intégration d'un design système moderne.
11. **Lucide Library**
12. **Tailwind CSS** : Framework CSS utilitaire pour un design réactif et moderne.
---
## Fonctionnalités

![center](img_presentation/use_case.png)



---

## Conception
![center h:450](img_presentation/diagramme_class.png)


---

## Versions

### Version 1

- Public Side
- Branch : public

### Version 2

- Admin Side
- Branch : admin

### Version 3

- Authontification / Authorization (Gates)
- Branch : gates

### Version 4

- SPA (Single Page Application) AJAX
- Branch : spa AJAX

### Version 5

- SPA (Single Page Application) Alpine.js
- Branch : spa Alpine.js

### Version 6

- Spatie / Authorization
- Branch : spatie

### Version 7

- API
- Branch : api

### Version 8

- Mobile App
- Branch : mobile

---

## Sujet Live Coding

- Ajouter avec un pop-up modal (AJAX).
- Rechercher les tâches.
