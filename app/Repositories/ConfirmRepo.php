<?php


namespace App\Repositories;

use App\Models\Confirm;
use App\Repositories\EloquentRepo;
use App\Services\Common\SheetService;

class ConfirmRepo extends EloquentRepo
{
    public function getModel()
    {
        return Confirm::class;
    }

    public function create(array $params)
    {
        return $this->model->insert($params);
    }

    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function updateConfirm(array $params, int $id)
    {
        return $this->model->where('id', '=', $id)->update($params);
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function deleteById($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function insertSheet()
    {
        $confirms = $this->model->get();
        foreach ($confirms as $confirm) {
            (new SheetService())->appendConfirmSheets([
                [
                    $confirm->name,
                    $confirm->email,
                    $confirm->date,
                ]
            ]);
        }
    }
}
