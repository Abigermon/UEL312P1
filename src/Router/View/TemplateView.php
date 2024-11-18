<?php declare(strict_types=1);

namespace Framework312\Router\View;

use Framework312\Router\Request;
use Framework312\Router\View\BaseView;
use Symfony\Component\HttpFoundation\Response;

class TemplateView extends BaseView
{
    private $renderer;

    /**
     * Constructeur
     * @param $renderer
     */
    public function __construct($renderer) {
        $this->renderer = $renderer;
        // Enregistre la route avec la vue et son chemin
        $this->renderer->register(static::class);
    }

    static public function use_template(): bool
    {
        return true; # utilise un template
    }

    public function render(Request $request): Response
    {
        //Obtient la méthode voulu de la requête.
        $request = $request->getMethod();
        //Retourne le nom du fichier de template associé à la classe
        $templateName = $this->getTemplateName();
        // Rendu du contenu du template avec les données de la requête
        $content = $this->renderer->render($templateName, $request);
        // Création de la réponse HTTP avec le contenu généré
        $response = new Response($content);
        // Détecte automatiquement le type de contenu en format MIME
        $mimeType = mime_content_type($templateName);
        // Définition de l'en-tête Content-Type de la réponse avec le type MIME détecté
        $response->headers->set('Content-Type', $mimeType);

        return $response;
    }

    /**
     * Génère le nom du fichier de template associé à la classe actuelle.
     *
     * @return string Le nom du fichier template en minuscule.
     */
    private function getTemplateName(): string {
        return strtolower(static::class) . '_template.html.twig';
    }

}