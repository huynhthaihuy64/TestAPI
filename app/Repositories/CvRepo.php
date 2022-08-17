<?php


namespace App\Repositories;

use App\Models\Cv;
use App\Repositories\EloquentRepo;
use App\Services\Common\SheetService;

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
        return $this->model->where('id', $id)->first();
    }

    public function deleteById($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function insertSheet()
    {
        $cvs = $this->model->get();
        foreach ($cvs as $cv) {
            (new SheetService())->appendCvSheets([
                [
                    $cv->name,
                    $cv->email,
                    $cv->phone,
                    $cv->position,
                    $cv->file,
                    $cv->id_user,
                    $cv->active,
                    $cv->date,
                ]
            ]);
        }
    }
}
