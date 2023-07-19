<?php

namespace App\Domain\Kelurahan\Service;

use App\Domain\Kelurahan\Repository\KelurahanCreatorRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class KelurahanCreator
{
    private $repository;

    public function __construct(KelurahanCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createKelurahan(array $data): int
    {
        // Input validation
        $this->validateNewKelurahan($data);

        // Insert
        $res = $this->repository->insertKelurahan($data);

        return $res;
    }

    private function validateNewKelurahan(array $data): void
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