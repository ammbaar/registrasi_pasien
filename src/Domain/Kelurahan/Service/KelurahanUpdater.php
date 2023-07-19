<?php

namespace App\Domain\Kelurahan\Service;

use App\Domain\Kelurahan\Repository\KelurahanUpdaterRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class KelurahanUpdater
{
    private $repository;

    public function __construct(KelurahanUpdaterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function updateKelurahan(array $data): int
    {
        // Input validation
        $this->validateKelurahan($data);

        // Update data kelurahan
        $res = $this->repository->updateKelurahan($data);

        return $res;
    }

    private function validateKelurahan(array $data): void
    {
        $errors = [];

        // Here you can also use your preferred validation library

        if (empty($data['nama_kelurahan'])) {
            $errors['nama_kelurahan'] = 'Input required';
        }

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}