<?php

namespace App\Domain\Pasien\Service;

use App\Domain\Pasien\Repository\PasienUpdaterRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class PasienUpdater
{
    private $repository;

    public function __construct(PasienUpdaterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function updatePasien(array $data): int
    {
        // Input validation
        $this->validatePasien($data);

        // Update data pasien
        $res = $this->repository->updatePasien($data);

        return $res;
    }

    private function validatePasien(array $data): void
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