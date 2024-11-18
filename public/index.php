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

use App\Router;

require dirname(path: __DIR__) . "/vendor/autoload.php";

// Démmarage de la session

if (!isset($_SESSION)) {
    session_start();
}

// Création d'une instace de routeur

$router = new Router();

$router->get(url:"/", function () {});
$router->get(url:"/add", function () {});
$router->post(url:"/add", function () {});
$router->get(url:"/toggle", function () {});
$router->get(url:"/delete", function () {});

echo "<pre>";
var_dump($router);