<?php declare(strict_types=1);

namespace Framework312\Router;

use Framework312\Router\Exception as RouterException;
use Framework312\Template\Renderer;
use Symfony\Component\HttpFoundation\Response;

class Route {
    private const VIEW_CLASS = 'Framework312\Router\View\BaseView';
    private const VIEW_USE_TEMPLATE_FUNC = 'use_template';
    private const VIEW_RENDER_FUNC = 'render';

    private string $view;

    public function __construct(string|object $class_or_view) {
        $reflect = new \ReflectionClass($class_or_view);
        $view = $reflect->getName();
        if (!$reflect->isSubclassOf(self::VIEW_CLASS)) {
            throw new RouterException\InvalidViewImplementation($view);
        }
        $this->view = $view;
    }

    public function call(Request $request, ?Renderer $engine): Response {
        // Création d'une instance de la vue
        $viewInstance = new $this->view;
        
        // Si la vue a la méthode 'use_template', on l'appelle pour lier le moteur de templates
        if (method_exists($viewInstance, self::VIEW_USE_TEMPLATE_FUNC)) {
            $viewInstance->{self::VIEW_USE_TEMPLATE_FUNC}($engine); 
        }
        
        // On génère la réponse :
        return new Response($viewInstance->{self::VIEW_RENDER_FUNC}($request));
    }
}

class SimpleRouter implements Router {
    private Renderer $engine;

    public function __construct(Renderer $engine) {
        $this->engine = $engine;
    }

    public function register(string $path, string|object $class_or_view) {
	    // On enregistre la route
        $this->routes[$path] = new Route($class_or_view); 
    }

    public function serve(mixed ...$args): void {
	    // Récupèration de la requête en cours
        $request = new Request(...$args);
        $path = $request->getPathInfo(); 

        // Vérification de la route 
        if (isset($this->routes[$path])) {
            // Si la route est trouvée, on génère la réponse
            $response = $this->routes[$path]->call($request, $this->engine);
            $response->send(); 
        } else {
            // Si la route n'est pas trouvée, alors une exception est lancée
            throw new RouterException\RouteNotFound("Route pour le chemin '{$path}' non trouvée.");
    }
}
}

?>
