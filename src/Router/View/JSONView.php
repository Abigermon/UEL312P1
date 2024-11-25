<?php declare(strict_types=1);

namespace Framework312\Router\View;

use Framework312\Router\Request;
use Framework312\Router\View\BaseView;
use Symfony\Component\HttpFoundation\Response;

abstract class JSONView extends BaseView
{

    static public function use_template(): bool
    {
        return false; # n'utilise pas de template
    }

    public function render(Request $request): Response
    {
        //Transformé en JSON
        $response = new Response(json_encode($request));

        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

}