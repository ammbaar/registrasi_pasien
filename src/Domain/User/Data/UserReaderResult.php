<?php

namespace App\Domain\User\Data;

final class UserReaderResult
{
    /**
     * @var int
     */
    public $id;

    /** @var string */
    public $username;

    /** @var string */
    public $password;

    /** @var string */
    public $role;
}