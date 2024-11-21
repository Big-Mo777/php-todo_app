<?php

namespace App\Controllers;

use DB\Database;

class TodoController
{

    public function index()
    {
        // Récupérer l'instance de connexion à la BDD
        $db = Database::getInstance();

        //   Récupérer les tâche depuis la BDD

        $query = $db->query("SELECT * FROM todos_db.todos ;");
       $todos = $query->fetchAll(); // retourne le résultat de l'exécution de la requête plud précisement les tâches

        // charger la vue "Views/index.php"

        require __DIR__ . "/../Views/index.php";
        // require dirname(path: __DIR__) . "/Views/index.php";
    }
    public function add()
    {
        // echo "méthode add";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task = trim($_POST['task']);
            if ($task) {
                // Récupérer l'instance de connexion à la BDD
                $db = Database::getInstance();
                // prepare la requête SQL pour insére une nouvelle tâche dans la tabke "todos".
                //les placeholders `:task` et `:done` sont utilisés pour pour éviter les injections SQL.
                // cela sécurise les données entrés par l'utilisateur
                $stmt = $db->prepare("INSERT INTO todos (task, done) VALUES (:task, :done);");
                $stmt->execute([":task" => $task, ":done" => 0]); // exécution de la requête
                //    $stmt->execute(["task"=> $task, "done" => 0]); ont peut retirer les ":" des placeholders. C'est pareil !
            }
            header('location: /');
            exit;
        }
        // chargement de la vue add.php
        require dirname(__DIR__) . "/Views/add.php";
    }
    public function delete()
    {
        $id = $_GET["id"] ?? "null";
        if ($id) {
            // Récupérer l'instance de connexion à la BDD
            $db = Database::getInstance();
            $stmt = $db->prepare("DELETE FROM todos WHERE id = : id;"); // $stmt pour "prepared statement" en anglais, "requête préparé" en fr donc stmt ==> statement 
            $stmt->execute(["id" => (int) $id]);
        }
        header('location: /');
        exit;
    }
    public function toggle()
    {
        $id = $_GET["id"] ?? "null";
        if ($id) {
            //Récumperer l'instance de connexion à la BDO
        $db = Database::getInstance();
        //Quelle requête SQL exécuter pour marquer une tâche avec l'id 1 comme terminée ou non terminée en fonction de ce qui était là.

        $stmt = $db->prepare("UPDATE todos SET done = NOT done WHERE id = :id");
        $stmt->execute(["id" => (int) $id]);
 
            // foreach ($_SESSION['todos'] as &$todo) {
            //     if ($todo['id'] === $id) {
            //         $todo['done'] = !$todo['done'];
            //     }
            // }
        }
        header('location: /');
        exit;
    }
}
