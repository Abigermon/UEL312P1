<?php declare(strict_types=1);

namespace Framework312\Tests\Controller;

use PHPUnit\Framework\TestCase; 
use Framework312\Controller\HomeController; 
use Twig\Environment; 
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response; 

class HomeControllerTest extends TestCase
{
    public function testIndexReturnsCorrectResponse(): void
    {
        // Création d'un "mock" pour simuler le fonctionnement de Twig
        $twigMock = $this->createMock(Environment::class);

        // Définir ce que doit faire le mock Twig quand sa méthode "render" est appelée
        $twigMock->method('render')
            ->with( 
                'index.twig', // Le nom du fichier template
                [ // Les données qui seront passées au template
                    'auteurs' => 'Abigail Germon , Vincent Ackermann, Hillel Magnichewer et Hugo Rytlewski'
                ]
            )
            ->willReturn('<html><body>Page Content</body></html>'); // Simule le retour de "render"

        $controller = new HomeController($twigMock);
        $request = $this->createMock(Request::class);
        $response = $controller->index($request);
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('<html><body>Page Content</body></html>', $response->getContent());
    }
}
