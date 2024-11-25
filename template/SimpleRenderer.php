<?php

namespace Framework312\Template;

use Twig\Environment;

class SimpleRenderer implements Renderer {
    private Environment $twig;

    // Constructeur qui prend un objet Twig\Environment
    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }

    // Implémentation de la méthode render
    public function render(mixed $data, string $template): string {
        // Utilise l'objet Twig pour rendre le template avec les données
        return $this->twig->render($template, $data);
    }

    // Enregistrer des tags (si nécessaire)
    public function register(string $tag) {
        // Cette méthode peut être adaptée selon vos besoins
    }
}
