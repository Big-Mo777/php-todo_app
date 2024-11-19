<?php

namespace App;

/**
 * classe Router
 * Gère l'enrégistrement et la résoluton des routes pour notre applicationn web
 * Permet de définir des routes HTTP et d'exécuter les actions correspondantes
 * en fonction des requêtes entrantes.
 */
class Router
{
    // Propriété privée pour stocker les routes enrégistrées.
    private $routes = [];

    /**
     * Enregistre une route GET.
     * @param string $url URL de la route (ex: "/home").
     * @param callable $action Fonction ou méthode à exécuter si la route correspond.
     * @return void
     */

    public function get(string $url, callable $action)
    {
        $this->addRoute(method: 'GET', url: $url, action: $action);
    }
    /**
     * Enregistre une route POST.
     * @param string $url URL de la route (ex: "/delete").
     * @param callable $action Fonction ou méthode à exécuter si la route correspond.
     * @return void
     */

    public function post(string $url, callable $action)
    {
        $this->addRoute(method: 'POST', url: $url, action: $action);
    }


    /**
     * Ajoute une route à la liste des routes.
     * @param mixed $method 
     * @param mixed $url
     * @param mixed $action
     * @return void
     */
    private function addRoute($method, $url, $action)
    {

        $this->routes[] = [
            "method" => "$method",
            "url" => "$url",
            "action" => $action
        ];
    }

    /**
     * Résout la requête entrante en fonction des routes enregistrées.
     * Compare l'url et la méthode HTTP de la requête avec chaque route enregistrée.
     * si une corrrespondance est trouvée, l'action associée est exécutée
     * sinon, une erreur 404 est retourner
     * 
     * @return void
     */

    public function resolve()
    {
        // Récupérer l'url depuis la requête
        $requestUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        //    Récupérer la méthode HTTP utilisée pour la requête.
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        // Parcourir tutes les routes enregistrées.
        foreach ($this->routes as $route) {
            // Verifier si l'Url et la méthode HTTP correspond à la route actuelle.
            if ($route['url'] === $requestUrl && $route['method'] === $requestMethod) {
                // si une correspondance est trouvée, exécute l'action associée
                call_user_func($route['action']);
                return; //Termine la méthode après avoir l'action
            }

        }
        // si aucune correspondance n'est trouvée, retourner une erreur 404.
        http_response_code(404);
        echo "404 Pages non trouvé !";
    }

}
