<?php

namespace App\Services;

use App\Repositories\CvRepo;
use Carbon\Carbon;

/**
 * Class CampaignService
 * @package App\Services
 */
class CvService
{
    public $cvRepo;

    public function __construct(CvRepo $cvRepo)
    {
        $this->cvRepo = $cvRepo;
    }

    public function create(array $params)
    {
        return $this->cvRepo->create($params);
    }
    public function getAll()
    {
        return $this->cvRepo->getAll();
    }
    public function delete($id)
    {
        return $this->cvRepo->deleteById($id);
    }
}
