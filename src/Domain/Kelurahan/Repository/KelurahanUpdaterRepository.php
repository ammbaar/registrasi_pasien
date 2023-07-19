<?php

namespace App\Domain\Kelurahan\Repository;

use PDO;

/**
 * Repository.
 */
class KelurahanUpdaterRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function updateKelurahan(array $input): int
    {
        $row = [
            'id' => $input['id'],
            'nama_kelurahan' => $input['nama_kelurahan'],
            'nama_kecamatan' => $input['nama_kecamatan'],
            'nama_kota' => $input['nama_kota']
        ];

        $sql = "UPDATE data_kelurahan SET 
                nama_kelurahan = :nama_kelurahan, 
                nama_kecamatan = :nama_kecamatan,
                nama_kota = :nama_kota
                WHERE id = :id;";

        $this->connection->prepare($sql)->execute($row);

        return true;
    }
}
