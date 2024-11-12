<?php declare(strict_types=1);

namespace Framework312\Template;

interface Renderer {
    public function render(mixed $data, string $template): string;
    public function register(string $tag);
}

// Implémentation de l'interface Renderer
class SimpleRenderer implements Renderer {
    // Tableau pour enregistrer les tags
    private array $tags = [];

    // Méthode pour enregistrer un tag
    public function register(string $tag) {
        $this->tags[] = $tag; 
    }

    // Méthode pour rendre un template avec les données
    public function render(mixed $data, string $template): string {
        
        foreach ($data as $key => $value) {
            // Chaque {{ key }} sera remplacer par la valeur correspondante dans les données
            $template = str_replace("{{ $key }}", $value, $template);
        }
        return $template;  
    }
}

?>