Je veux que tu écrives un fichier de tests unitaires Laravel complet pour tester un service appelé TaskService. 
Voici les détails à prendre en compte :

1. **Contexte du projet :**
   - Laravel 10+
   - Base de données avec tables : tasks, categories, users
   - TaskService contient les méthodes : 
     - getAll(array $filters = []): LengthAwarePaginator
       - supporte la recherche sur title et description via 'search' dans les filtres
       - supporte la filtration par catégorie via 'category_id' dans les filtres
       - retourne les tasks avec les relations user et categories, paginées par 10
     - create(array $data): Task
     - update(int $id, array $data): Task
     - delete(int $id): bool

2. **Objectif du test :**
   - Tester toutes les fonctionnalités du TaskService sans passer par le controller
   - Utiliser uniquement **unit testing** et la base de données (DatabaseTransactions pour rollback)
   - Ne pas tester la validation de formulaire ni les vues

3. **Tests à inclure :**
   - Vérifier que getAll() retourne au moins une task
   - Vérifier que getAll() peut filtrer par mot clé ('search') sur title ou description
   - Vérifier que getAll() peut filtrer par catégorie ('category_id')
   - Vérifier que update() modifie correctement un champ de la task (ex : title)
   - Vérifier que delete() supprime correctement la task de la base

4. **Précisions techniques :**
   - Pour récupérer une task ou catégorie existante, utiliser Task::first() et Category::first()
   - Toujours vérifier avec assertNotNull que la task ou category existe avant le test
   - Utiliser assertDatabaseHas et assertDatabaseMissing pour vérifier les modifications
   - Chaque test doit être annoté avec `/** @test */` et avoir un nom clair en anglais
   - Utiliser `use DatabaseTransactions` pour rollback automatique après chaque test
   - SetUp doit instancier `$this->service = new TaskService();`

5. **Structure du fichier :**
   - Namespace : `Tests\Unit`
   - Use : TestCase, Task, Category, TaskService, DatabaseTransactions
   - Class : TaskServiceTest extends TestCase
   - Méthodes de test :
     - it_can_get_all_tasks()
     - it_can_filter_tasks_by_search()
     - test_it_can_filter_tasks_by_category()
     - it_can_update_a_task()
     - it_can_delete_a_task()

6. **Style du code :**
   - Code lisible et bien indenté
   - Utiliser `snake_case` pour variables locales si nécessaire
   - Les tests doivent être autonomes et stables
   - Ne pas inclure de controller ou de route, uniquement TaskService

**Ta tâche pour l’IA :**  
Génère le code complet de TaskServiceTest.php basé sur ces instructions, prêt à être utilisé dans un projet Laravel avec TaskService.
