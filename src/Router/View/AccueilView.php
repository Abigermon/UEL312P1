<?php declare(strict_types=1);

namespace Framework312\Router\View;

use Framework312\Router\Request;
use Symfony\Component\HttpFoundation\Response;
use Framework312\Template\Renderer;

class AccueilView extends TemplateView {
    public function __construct(Renderer $renderer) {
        parent::__construct($renderer); // Appel du constructeur parent
    }

    public function render(Request $request): Response {
        $data = [
            'title' => 'Page d\'accueil',
            'content' => 'Bienvenue sur la page d\'accueil avec Twig et Symfony !'
        ];

        $html = $this->renderer->render($data, 'index.twig');
        return new Response($html);
    }
}
?>