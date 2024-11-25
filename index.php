<?php declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use Framework312\Router\SimpleRouter;
use Framework312\Template\SimpleRenderer; // Utilisez SimpleRenderer comme une classe, pas une interface
use Framework312\Router\View\AccueilView;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

// Initialisation du moteur de templates (Twig)
$loader = new FilesystemLoader(__DIR__ . '/src/template'); // Assurez-vous que le chemin est correct
$twig = new Environment($loader);

// Création de l'instance de SimpleRenderer avec l'objet Twig
$renderer = new SimpleRenderer($twig);

// Initialisation du routeur
$router = new SimpleRouter($renderer); // Passez l'instance de SimpleRenderer

// Enregistrement de la route pour la page d'accueil
$router->register('/', AccueilView::class);

// Servir la requête
$router->serve();
