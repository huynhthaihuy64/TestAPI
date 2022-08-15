<?php

namespace App\Services;

use App\Repositories\ConfirmRepo;
use Carbon\Carbon;

/**
 * Class CampaignService
 * @package App\Services
 */
class ConfirmService
{
    public $confirmRepo;

    public function __construct(ConfirmRepo $confirmRepo)
    {
        $this->confirmRepo = $confirmRepo;
    }

    public function create(array $params)
    {
        return $this->confirmRepo->create($params);
    }

    public function getAll()
    {
        return $this->confirmRepo->getAll();
    }

    public function getById($id)
    {
        return $this->confirmRepo->getById($id);
    }

    public function updateConfirm(array $params, int $id)
    {
        return $this->confirmRepo->updateConfirm($params, $id);
    }

    public function delete($id)
    {
        return $this->confirmRepo->deleteById($id);
    }
}
