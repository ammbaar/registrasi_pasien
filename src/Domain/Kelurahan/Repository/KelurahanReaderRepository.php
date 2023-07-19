<?php

namespace App\Domain\Kelurahan\Repository;

use App\Domain\Kelurahan\Data\KelurahanReaderResult;
use DomainException;
use PDO;

/**
 * Repository.
 */
class KelurahanReaderRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getKelurahan(): array
    {
        $sql = "SELECT * FROM data_kelurahan;";
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll(PDO::FETCH_OBJ);

        if (!$row) {
            throw new DomainException(sprintf('Data kelurahan tidak ditemukan'));
        }

        return $row;
    }

    public function getKelurahanDropdown(): array
    {
        $sql = "SELECT id, nama_kelurahan FROM data_kelurahan;";
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll(PDO::FETCH_OBJ);

        if (!$row) {
            throw new DomainException(sprintf('Data kelurahan tidak ditemukan'));
        }

        return $row;
    }
}
