<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;

/**
 * Action
 */
final class PageAction
{
    /**
     * @var PhpRenderer
     */
    private $renderer;

    public function __construct(PhpRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        //optional
        $this->renderer->addAttribute('title', 'Registrasi Pasien');

        return $this->renderer->render($response, 'home.php', ['name' => 'World']);
    }

    public function page_kelurahan(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        //optional
        $this->renderer->addAttribute('title', 'Registrasi Pasien');

        return $this->renderer->render($response, 'kelurahan.php');
    }

    public function page_pasien(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        //optional
        $this->renderer->addAttribute('title', 'Registrasi Pasien');

        return $this->renderer->render($response, 'pasien.php');
    }
}