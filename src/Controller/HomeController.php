<?php declare(strict_types=1);

namespace Framework312\Controller;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController {
    private Environment $twig;

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }

    public function index(Request $request): Response {
        $content = $this->twig->render('index.twig', [
            'auteurs' => 'Abigail Germon , Vincent Ackermann, Hillel Magnichewer et Hugo Rytlewski'
        ]);
        return new Response($content);
    }
}