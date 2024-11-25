<?php declare(strict_types=1);

namespace Framework312\Router\View;

use Framework312\Router\Exception as RouterException;
use Framework312\Router\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class HTMLView extends BaseView
{

    static public function use_template(): bool
    {
        return false; # n'utilise pas de template
    }

    public function render(Request $request): Response
    {
        // Créer le contenu HTML
        $content = "<html><head><title>HTML View</title></head><body>";
        $content .= "<h1>Bienvenue dans HTMLView</h1>";
        $content .= "<p>Voici une page HTML simple.</p>";
        $content .= "</body></html>";

        // Créer la réponse avec le contenu
        $response = new Response($content);

        // Définir l'en-tête Content-Type
        $response->headers->set('Content-Type', 'text/html');

        return $response;
    }
}
