<?php declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php'; // Assurez-vous que le chemin est correct

use Framework312\Router\SimpleRouter;
use Framework312\Template\SimpleRenderer; // Utilisez l'implémentation concrète
use Framework312\Router\View\AccueilView;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

// Initialisation du moteur de templates (Twig)
$loader = new FilesystemLoader(__DIR__ . '/src/template'); // Assurez-vous que le chemin est correct
$twig = new Environment($loader);

// Initialisation du routeur
$router = new SimpleRouter(new SimpleRenderer($twig)); // Utilisez l'implémentation concrète

// Enregistrement de la route pour la page d'accueil
$router->register('/', AccueilView::class); // Route pour le chemin '/'

// Servir la requête
$router->serve();
?>