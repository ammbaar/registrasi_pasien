<?php

namespace App\Domain\Kelurahan\Data;

final class KelurahanReaderResult
{
    /**
     * @var int
     */
    public $id;

    /** @var string */
    public $nama_kelurahan;

    /** @var string */
    public $nama_kecamatan;

    /** @var string */
    public $nama_kota;
}