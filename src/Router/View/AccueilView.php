<?php

namespace Framework312\Router\View;

use Framework312\Router\Request;
use Symfony\Component\HttpFoundation\Response;

class AccueilView extends BaseView {

    public static function use_template(): bool {
        return true; // Ou ajustez en fonction de votre logique
    }

    public function render(Request $request): Response {
        // Votre logique pour le rendu de la page d'accueil
        return new Response('<html><body>Accueil Page</body></html>');
    }
}
