<?php


namespace App\Repositories;

use App\Models\User;
use App\Repositories\EloquentRepo;

class UserRepo extends EloquentRepo
{
    public function getModel()
    {
        return User::class;
    }
    public function create(array $params)
    {
        return $this->model->insert($params);
    }
    public function getAll()
    {
        return $this->model->get();
    }
    public function deleteById($id)
    {
        return $this->model->where('id', $id)->delete();
    }
}
