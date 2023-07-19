<?php

namespace App\Domain\Kelurahan\Repository;

use PDO;

/**
 * Repository.
 */
class KelurahanCreatorRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function insertKelurahan(array $input): int
    {
        $row = [
            'nama_kelurahan' => $input['nama_kelurahan'],
            'nama_kecamatan' => $input['nama_kecamatan'],
            'nama_kota' => $input['nama_kota']
        ];

        $sql = "INSERT INTO data_kelurahan SET 
                nama_kelurahan=:nama_kelurahan, 
                nama_kecamatan=:nama_kecamatan,
                nama_kota=:nama_kota;";

        $this->connection->prepare($sql)->execute($row);

        return (int)$this->connection->lastInsertId();
    }
}
