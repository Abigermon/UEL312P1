<?php declare(strict_types=1);

namespace Framework312\Router\View;

use Framework312\Router\Request;
use Symfony\Component\HttpFoundation\Response;
use Framework312\Template\SimpleRenderer;

class AccueilView extends TemplateView {
    public function render(Request $request): Response {
        $data = [
            'title' => 'Page d\'accueil',
            'content' => 'Bienvenue sur la page d\'accueil avec Twig et Symfony !'
        ];

        $html = $this->renderer->render('accueil.twig', $data);
        return new Response($html);
    }
}
?>