<?php


namespace App\Repositories;

use App\Models\Cv;
use App\Models\User;
use App\Repositories\EloquentRepo;

class CvRepo extends EloquentRepo
{
    public function getModel()
    {
        return Cv::class;
    }

    public function create(array $params)
    {
        return $this->model->create($params);
    }

    public function updateCv(array $params, int $id)
    {
        return $this->model->where('id', '=', $id)->update($params);
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function deleteById($id)
    {
        return $this->model->where('id', $id)->delete();
    }
}
