<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserReaderResult;
use DomainException;
use PDO;

/**
 * Repository.
 */
class UserReaderRepository
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

    /**
     * Get user by the given user id.
     *
     * @param int $userId The user id
     *
     * @throws DomainException
     *
     * @return array The user row
     */
    public function getUserById(int $userId): array
    {
        $sql = "SELECT * FROM user WHERE id = :id;";
        $statement = $this->connection->prepare($sql);
        $statement->execute(['id' => $userId]);

        $row = $statement->fetch();

        if (!$row) {
            throw new DomainException(sprintf('User tidak ditemukan: %s', $userId));
        }

        return $row;
    }

    public function getAllUser(): array
    {
        $sql = "SELECT * FROM user WHERE id != 1 ORDER BY id ASC;";
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll(PDO::FETCH_OBJ);

        if (!$row) {
            throw new DomainException(sprintf('User tidak ditemukan'));
        }

        return $row;
    }

    public function getAuth($username, $password): array
    {
        $pass = sha1($password);
        $sql = "SELECT * FROM user WHERE username = :username AND password = :password;";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam("username", $username);
        $statement->bindParam("password", $pass);
        $statement->execute();

        $row = $statement->fetch();

        if (!$row) {
            return ['id' => '0'];
        }

        return $row;
    }
}
