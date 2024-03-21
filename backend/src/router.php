<?php

// Inclure toutes les routes ici
require_once 'userRoutes/getOneUser.php';
require_once 'Controllers/UserController.php';


// Définir une fonction de routage
function routeRequest($request_uri, $request_method) {
    // Définir les routes disponibles avec leurs contrôleurs et actions associées
    $routes = array(
        '/users' => array('controller' => 'UserController', 'action' => 'getAllUsers', 'method' => 'GET'),
        '/users/create' => array('controller' => 'UserController', 'action' => 'createUser', 'method' => 'POST'),
        // Autres routes...
    );

    // Vérifier si la route demandée existe
    if (array_key_exists($request_uri, $routes)) {
        $route = $routes[$request_uri];

        // Vérifier si la méthode de la requête correspond à la méthode définie pour cette route
        if ($request_method === $route['method']) {
            $controllerName = $route['controller'];
            $actionName = $route['action'];

            // Instancier le contrôleur et appeler l'action appropriée
            $controller = new $controllerName();
            $controller->$actionName();
        } else {
            // Méthode non autorisée pour cette route
            http_response_code(405); // Méthode non autorisée
            echo "Method Not Allowed";
        }
    } else {
        // Route non trouvée
        http_response_code(404); // Non trouvé
        echo "Not Found";
    }
}

// Exécuter la fonction de routage avec l'URI de la requête et la méthode HTTP
routeRequest($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);