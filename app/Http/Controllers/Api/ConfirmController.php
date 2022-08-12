<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ConfirmRequest;
use App\Mail\MyTestMail;
use Illuminate\Support\Facades\Mail;
use App\Services\ConfirmService;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthService;

class ConfirmController extends Controller
{

    private $confirmService;

    public function __construct(ConfirmService $confirmService)
    {
        $this->confirmService = $confirmService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->confirmService->getAll();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.confirm.create', [
            'title' => 'Confirm Schedule',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConfirmRequest $request)
    {
        $params = $request->except(['_token']);
        $data = $this->confirmService->create($params);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Confirm  $confirm
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = $this->confirmService->delete($id);
        return $data;
    }
}
