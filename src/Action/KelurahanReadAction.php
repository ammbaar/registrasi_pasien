<?php

namespace App\Action;

use App\Domain\Kelurahan\Service\KelurahanReader;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 */
final class KelurahanReadAction
{
    /**
     * @var KelurahanReader
     */
    private $kelurahanReader;

    /**
     * The constructor.
     *
     * @param KelurahanReader $kelurahanReader The kelurahan reader
     */
    public function __construct(KelurahanReader $kelurahanReader)
    {
        $this->kelurahanReader = $kelurahanReader;
    }

    /**
     * Invoke.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     * @param array<mixed> $args The route arguments
     *
     * @return ResponseInterface The response
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        // Invoke the Domain (application service) with inputs and keep the result
        $res = $this->kelurahanReader->getKelurahanDetails();

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($res));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function kelurahan_dropdown(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        // Invoke the Domain (application service) with inputs and keep the result
        $res = $this->kelurahanReader->getKelurahanDropdown();

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($res));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
