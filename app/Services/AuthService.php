<?php

namespace App\Services;

use App\Repositories\AuthRepo;
use Carbon\Carbon;

/**
 * Class CampaignService
 * @package App\Services
 */
class AuthService
{
    public $authRepo;

    public function __construct(AuthRepo $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function postForgot($request)
    {
        return $this->authRepo->postForgot($request);
    }

    public function updatePassword($request)
    {
        return $this->authRepo->updatePassword($request);
    }
}
