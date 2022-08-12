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
use App\Services\ResponseService;

class ConfirmController extends Controller
{

    private $confirmService;

    private $responseService;


    public function __construct(ConfirmService $confirmService, ResponseService $responseService)
    {
        $this->confirmService = $confirmService;
        $this->responseService = $responseService;
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

    public function update(ConfirmRequest $request, int $id)
    {
        $params = $request->all();
        $data = $this->confirmService->updateConfirm($params, $id);
        return $this->responseService->response(
            $data ? true : false,
            $data,
            __('Update Success')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConfirmRequest $request)
    {
        $params = $request->all();
        $data = $this->confirmService->create($params);
        return $this->responseService->response(
            $data ? true : false,
            $data,
            __('Create Success')
        );
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
        return $this->responseService->response(
            $data ? true : false,
            $data,
            __('Delete Success')
        );
    }
}
