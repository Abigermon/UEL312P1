<?php declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use Framework312\Controller\HomeController;
use Framework312\Controller\InfoController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

// Initialisation du moteur de templates (Twig)
$loader = new FilesystemLoader(__DIR__ . '/src/Template');
$twig = new Environment($loader);

// Initialisation des contrôleurs
$homeController = new HomeController($twig);
$infoController = new InfoController($twig);

// Fonction pour gérer les routes
function handleRoute(string $path, Request $request, HomeController $homeController, InfoController $infoController): Response {
    switch ($path) {
        case '/':
            return $homeController->index($request);
        case '/info':
            return $infoController->index($request);
        default:
            global $twig;
            $content = $twig->render('404.twig', ['message' => 'Page non trouvée']);
            return new Response($content, Response::HTTP_NOT_FOUND);
    }
}

// Gestion de la requête HTTP
$request = Request::createFromGlobals();
$path = $request->getPathInfo();

// Appel de la fonction de gestion des routes
$response = handleRoute($path, $request, $homeController, $infoController);

// Envoi de la réponse au client
$response->send();