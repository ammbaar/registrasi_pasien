<?php

namespace App\Action;

use App\Domain\Kelurahan\Service\KelurahanUpdater;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 */
final class KelurahanUpdateAction
{
    private $kelurahanUpdater;

    public function __construct(KelurahanUpdater $kelurahanUpdater)
    {
        $this->kelurahanUpdater = $kelurahanUpdater;
    }

    /**
     * Invoke.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     *
     * @return ResponseInterface The response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Collect input from the HTTP request
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $res = $this->kelurahanUpdater->updateKelurahan($data);

        // Build the HTTP response
        $response->getBody()->write((string)json_encode(['status' => 'success']));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}