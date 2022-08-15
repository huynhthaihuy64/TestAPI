<?php

namespace App\Services;

use App\Repositories\UserRepo;

class UserService
{
    public $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function create(array $params)
    {
        return $this->userRepo->create($params);
    }

    public function getById($id)
    {
        return $this->userRepo->getById($id);
    }

    public function getAll()
    {
        return $this->userRepo->getAll();
    }

    public function delete($id)
    {
        return $this->userRepo->deleteById($id);
    }
}
