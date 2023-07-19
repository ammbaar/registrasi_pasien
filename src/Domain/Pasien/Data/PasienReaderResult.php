<?php

namespace App\Domain\Pasien\Data;

final class PasienReaderResult
{
    /**
     * @var int
     */
    public $id;

    /** @var string */
    public $nama_pasien;

    /** @var string */
    public $alamat;

    /** @var string */
    public $no_telp;

    /** @var string */
    public $rt_rw;

    /** @var int */
    public $id_kelurahan;

    /** @var string */
    public $tgl_lahir;

    /** @var string */
    public $jenis_kelamin;
}