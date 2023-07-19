<?php

namespace App\Domain\Pasien\Repository;

use PDO;

/**
 * Repository.
 */
class PasienUpdaterRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function updatePasien(array $input): int
    {
        $row = [
            'id' => $input['id'],
            'nama_pasien' => $input['nama_pasien'],
            'alamat' => $input['alamat'],
            'no_telp' => $input['no_telp'],
            'rt_rw' => $input['rt_rw'],
            'id_kelurahan' => $input['id_kelurahan'],
            'tgl_lahir' => $input['tgl_lahir'],
            'jenis_kelamin' => $input['jenis_kelamin']
        ];

        $sql = "UPDATE data_pasien SET 
                nama_pasien=:nama_pasien,
                alamat=:alamat,
                no_telp=:no_telp, 
                rt_rw=:rt_rw,
                id_kelurahan=:id_kelurahan,
                tgl_lahir=:tgl_lahir,
                jenis_kelamin=:jenis_kelamin
                WHERE id = :id;";

        $this->connection->prepare($sql)->execute($row);

        return true;
    }
}
