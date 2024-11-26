<?php declare(strict_types=1);

namespace Framework312\Controller;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class InfoController {
    private Environment $twig;

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }

    public function index(Request $request): Response {
        $content = $this->twig->render('info.twig', [
            'message' => 'Ceci est une page de test'
        ]);
        return new Response($content);
    }
}