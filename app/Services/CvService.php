<?php

namespace App\Services;

use App\Repositories\CvRepo;

class CvService
{
    public $cvRepo;

    public function __construct(CvRepo $cvRepo)
    {
        $this->cvRepo = $cvRepo;
    }

    public function create(array $params)
    {
        $cvName = ($params['name']) . "_" . $params['file']->getClientOriginalName();

        $params['file']->move(public_path('uploads'), $cvName);

        $params['file'] = $cvName;

        $data = $this->cvRepo->create($params);
        return $data;
    }

    public function update(array $params, int $id)
    {
        return $this->cvRepo->updateCv($params, $id);
    }

    public function getAll()
    {
        return $this->cvRepo->getAll();
    }

    public function getById($id)
    {
        return $this->cvRepo->getById($id);
    }

    public function delete($id)
    {
        return $this->cvRepo->deleteById($id);
    }
}
