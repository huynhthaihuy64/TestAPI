<?php

namespace App\Services;

use App\Repositories\UserRepo;
use Carbon\Carbon;

/**
 * Class CampaignService
 * @package App\Services
 */
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
    public function getAll()
    {
        return $this->userRepo->getAll();
    }
    public function delete($id)
    {
        return $this->userRepo->deleteById($id);
    }
}
