<?php


namespace App\Repositories;

use App\Models\Cv;
use App\Repositories\EloquentRepo;

class CvRepo extends EloquentRepo
{
    public function getModel()
    {
        return Cv::class;
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
