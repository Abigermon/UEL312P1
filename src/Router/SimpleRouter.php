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
        // Instancier la vue
        $viewInstance = new $this->view();
        
        // Vérifier si la vue a une méthode use_template, et si oui, l'appeler
        if (method_exists($viewInstance, self::VIEW_USE_TEMPLATE_FUNC)) {
            $viewInstance->{self::VIEW_USE_TEMPLATE_FUNC}($engine);
        }

        // Vérifier si la vue a une méthode render, et si oui, l'appeler
        if (method_exists($viewInstance, self::VIEW_RENDER_FUNC)) {
            $content = $viewInstance->{self::VIEW_RENDER_FUNC}($request);
            return new Response($content);
        }

        // Retourner une réponse vide ou erreur si la vue ne gère pas ces méthodes
        return new Response('View rendering error', 500);
    }
}


class SimpleRouter implements Router {
    private Renderer $engine;
    private array $routes = [];

    public function __construct(Renderer $engine) {
        $this->engine = $engine;
    }

    // Enregistrer une route et l'associer à une vue
    public function register(string $path, string|object $class_or_view) {
        $this->routes[$path] = new Route($class_or_view);
    }

    // Servir une requête
    public function serve(mixed ...$args): void {
        // Récupérer le chemin de la requête
        $path = $_SERVER['REQUEST_URI'];
    
        // Si l'URL est la racine, rediriger vers /accueil
        if ($path === '/UEL312P1' || $path === '/UEL312P1/') {
            header('Location: /UEL312P1/accueil');
            exit();
        }
    
        // Supprimer le préfixe '/UEL312P1' du chemin de la requête
        $path = str_replace('/UEL312P1', '', $path);
        
        var_dump($this->routes);
        var_dump($path);
        
        // Vérifier si une route correspond au chemin
        if (isset($this->routes[$path])) {
            $route = $this->routes[$path];
            $response = $route->call(new Request(), $this->engine); // Appel de la méthode 'call' de la route
            $response->send(); // Envoyer la réponse HTTP
        } else {
            // Si aucune route ne correspond, retourner une erreur 404
            $response = new Response('Page not found', 404);
            $response->send();
        }
    }
    
}

?>
