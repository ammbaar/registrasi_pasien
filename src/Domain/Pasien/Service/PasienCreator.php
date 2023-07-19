<?php

namespace App\Domain\Pasien\Service;

use App\Domain\Pasien\Repository\PasienCreatorRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class PasienCreator
{
    private $repository;

    public function __construct(PasienCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createPasien(array $data): int
    {
        // Input validation
        $this->validateNewPasien($data);

        // Insert
        $res = $this->repository->insertPasien($data);

        return $res;
    }

    private function validateNewPasien(array $data): void
    {
        $errors = [];

        // Here you can also use your preferred validation library

        if (empty($data['nama_pasien'])) {
            $errors['nama_pasien'] = 'Input required';
        }

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}