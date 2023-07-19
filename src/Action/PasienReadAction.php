<?php

namespace App\Action;

use App\Domain\Pasien\Service\PasienReader;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 */
final class PasienReadAction
{
    /**
     * @var PasienReader
     */
    private $pasienReader;

    /**
     * The constructor.
     *
     * @param PasienReader $pasienReader The pasien reader
     */
    public function __construct(PasienReader $pasienReader)
    {
        $this->pasienReader = $pasienReader;
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
        $res = $this->pasienReader->getPasienDetails();

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($res));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function pasien_dropdown(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        // Invoke the Domain (application service) with inputs and keep the result
        $res = $this->pasienReader->getPasienDropdown();

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($res));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
