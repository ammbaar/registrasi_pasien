<?php

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserReaderResult;
use App\Domain\User\Repository\UserReaderRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class UserReader
{
    /**
     * @var UserReaderRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param UserReaderRepository $repository The repository
     */
    public function __construct(UserReaderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a user by the given user id.
     *
     * @param int $userId The user id
     *
     * @throws ValidationException
     *
     * @return UserReaderResult The user data
     */
    public function getUserDetails(int $userId): UserReaderResult
    {
        // Input validation
        if (empty($userId)) {
            throw new ValidationException('User ID required');
        }

        $userRow = $this->repository->getUserById($userId);

        // Optional: Do something complex here...

        // Map array to data object
        $user = new UserReaderResult();
        $user->id = (int)$userRow['id'];
        $user->username = (string)$userRow['username'];
        $user->password = (string)$userRow['password'];
        $user->role = (string)$userRow['role'];

        return $user;
    }

    public function getAllUser()
    {
        $row = $this->repository->getAllUser();

        $rows = array();
        foreach ($row as $data) {
            $rows[] = $data;
        }

        return $rows;
    }

    public function getAuth($username, $password)
    {
        $row = $this->repository->getAuth($username, $password);

        return $row;
    }
}