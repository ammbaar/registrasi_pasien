<?php

namespace App\Domain\Pasien\Repository;

use App\Domain\Pasien\Data\PasienReaderResult;
use DomainException;
use PDO;

/**
 * Repository.
 */
class PasienReaderRepository
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

    public function getPasien(): array
    {
        $sql = "SELECT p.*, k.nama_kelurahan, k.nama_kecamatan, k.nama_kota 
            FROM data_pasien AS p
            INNER JOIN data_kelurahan AS k ON k.id = p.id_kelurahan;";
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll(PDO::FETCH_OBJ);

        if (!$row) {
            throw new DomainException(sprintf('Data pasien tidak ditemukan'));
        }

        return $row;
    }

    public function getPasienDropdown(): array
    {
        $sql = "SELECT id, nama_pasien FROM data_pasien;";
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll(PDO::FETCH_OBJ);

        if (!$row) {
            throw new DomainException(sprintf('Data pasien tidak ditemukan'));
        }

        return $row;
    }
}
