<?php

namespace App\Domain\Pasien\Service;

use App\Domain\Pasien\Data\PasienReaderResult;
use App\Domain\Pasien\Repository\PasienReaderRepository;

/**
 * Service.
 */
final class PasienReader
{
    /**
     * @var PasienReaderRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param PasienReaderRepository $repository The repository
     */
    public function __construct(PasienReaderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getPasienDetails()
    {
        $row = $this->repository->getPasien();

        $rows = array();
        foreach ($row as $data) {
            $rows[] = $data;
        }

        return $rows;
    }

    public function getPasienDropdown()
    {
        $row = $this->repository->getPasienDropdown();

        $rows = array();
        foreach ($row as $data) {
            $rows[] = $data;
        }

        return $rows;
    }
}