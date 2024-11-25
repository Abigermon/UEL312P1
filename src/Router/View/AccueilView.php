<?php declare(strict_types=1);

namespace Framework312\Router\View;

use Framework312\Router\Request;
use Symfony\Component\HttpFoundation\Response;
use Framework312\Template\Renderer;

class AccueilView extends TemplateView {
    public function __construct(Renderer $renderer) {
        // Appel au constructeur de la classe parent TemplateView pour initialiser le renderer
        parent::__construct($renderer);
    }

    public function render(Request $request): Response {
        // Données à transmettre au template
        $data = [
            'title' => 'Page d\'accueil',
            'content' => 'Bienvenue sur la page d\'accueil avec Twig et Symfony !'
        ];

        // Rendu du template index.twig avec les données
        $html = $this->renderer->render($data, 'index.twig');

        // Création de la réponse HTTP avec le contenu généré
        return new Response($html);
    }
}
