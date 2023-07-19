<?php

namespace App\Action;

use App\Domain\Pasien\Service\PasienCreator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 */
final class PasienCreateAction
{
    private $pasienCreator;

    public function __construct(PasienCreator $pasienCreator)
    {
        $this->pasienCreator = $pasienCreator;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Collect input from the HTTP request
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $res = $this->pasienCreator->createPasien($data);

        // Build the HTTP response
        $response->getBody()->write((string)json_encode(['status' => 'success']));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}