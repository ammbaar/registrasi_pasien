<?php

namespace App\Domain\Kelurahan\Service;

use App\Domain\Kelurahan\Data\KelurahanReaderResult;
use App\Domain\Kelurahan\Repository\KelurahanReaderRepository;

/**
 * Service.
 */
final class KelurahanReader
{
    /**
     * @var KelurahanReaderRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param KelurahanReaderRepository $repository The repository
     */
    public function __construct(KelurahanReaderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getKelurahanDetails()
    {
        $row = $this->repository->getKelurahan();

        $rows = array();
        foreach ($row as $data) {
            $rows[] = $data;
        }

        return $rows;
    }

    public function getKelurahanDropdown()
    {
        $row = $this->repository->getKelurahanDropdown();

        $rows = array();
        foreach ($row as $data) {
            $rows[] = $data;
        }

        return $rows;
    }
}