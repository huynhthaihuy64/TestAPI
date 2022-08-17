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

    public function update(array $params, int $id)
    {
        return $this->userRepo->updateUser($params, $id);
    }

    public function insertSheet()
    {
        return $this->userRepo->insertSheet();
    }

    public function updateSheet()
    {
        return $this->userRepo->updateSheet();
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

    public function postForgot($request)
    {
        return $this->userRepo->postForgot($request);
    }

    public function updatePassword($request)
    {
        return $this->userRepo->updatePassword($request);
    }
}
