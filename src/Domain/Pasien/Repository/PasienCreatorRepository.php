<?php

namespace App\Domain\Pasien\Repository;

use PDO;

/**
 * Repository.
 */
class PasienCreatorRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function insertPasien(array $input): int
    {
        $date = date("ym");

        $sql = "SELECT COUNT(*) AS jumlah FROM data_pasien;";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_OBJ);
        $count = ($data[0]->jumlah + 1);
        $id = str_pad($count, 6, '0', STR_PAD_LEFT);

        $row = [
            'id' => $date.$id,
            'nama_pasien' => $input['nama_pasien'],
            'alamat' => $input['alamat'],
            'no_telp' => $input['no_telp'],
            'rt_rw' => $input['rt_rw'],
            'id_kelurahan' => $input['id_kelurahan'],
            'tgl_lahir' => $input['tgl_lahir'],
            'jenis_kelamin' => $input['jenis_kelamin']
        ];

        $sql = "INSERT INTO data_pasien SET 
                id=:id, 
                nama_pasien=:nama_pasien,
                alamat=:alamat,
                no_telp=:no_telp, 
                rt_rw=:rt_rw,
                id_kelurahan=:id_kelurahan,
                tgl_lahir=:tgl_lahir,
                jenis_kelamin=:jenis_kelamin;";

        $this->connection->prepare($sql)->execute($row);

        return (int)$this->connection->lastInsertId();
    }
}
