<?php

namespace App\Action;

use App\Domain\Kelurahan\Service\KelurahanCreator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 */
final class KelurahanCreateAction
{
    private $kelurahanCreator;

    public function __construct(KelurahanCreator $kelurahanCreator)
    {
        $this->kelurahanCreator = $kelurahanCreator;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Collect input from the HTTP request
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $res = $this->kelurahanCreator->createKelurahan($data);

        // Build the HTTP response
        $response->getBody()->write((string)json_encode(['status' => 'success']));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}