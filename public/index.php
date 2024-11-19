<?php

// Autoloader

// function monAutoloader($class){
//     require "../src/$class.php";
// }


// Enregister l'autoloader 
// spl_autoload_register(callback: "monAutoloader");


// require "../src/Highfive/Person.php";
// require "../src/Highfive/Product.php";

// echo "hello word ! 🚀🚀";



// echo "<pre>";

// $person = new App\Highfive\Person();
// $person->sayHello();

// $product = new App\Highfive\Product();
// $product->describe();


// todo list app


// require __DIR__ ."/../vendor/autoload.php";

use App\Controllers\TodoController;
use App\Router;

require dirname(path: __DIR__) . "/vendor/autoload.php";

// Démmarage de la session

if (!isset($_SESSION)) {
    session_start();
}

// Création d'une instace de routeur

$router = new Router();

// Création d'une instace du controlleurs 
$todoController = new TodoController();

   // Définir les routres de l'application
$router->get("/", [$todoController, 'index']);
$router->get("/add", [$todoController, 'add']);
$router->post("/add", [$todoController, 'add']);
$router->get("/toggle", [$todoController, 'toggle']);
$router->get("/delete", [$todoController, 'delete']);

// Resoudre la route correspondante
$router->resolve();
// echo "<pre>";
// var_dump($router);

