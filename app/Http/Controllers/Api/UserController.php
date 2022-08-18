<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\Common\SheetService;
use App\Services\Common\ResponseService;
use App\Services\UserService;

class UserController extends Controller
{

    public $userService;

    private $responseService;

    private $sheetService;

    public function __construct(UserService $userService, ResponseService $responseService, SheetService $sheetService)
    {
        $this->userService = $userService;
        $this->responseService = $responseService;
        $this->sheetService = $sheetService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->userService->getAll();
        return $this->responseService->response(
            $data ? true : false,
            $data,
            $data ?
                __('messages.get.success', ['name' => 'user']) :
                __('messages.get.fail', ['name' => 'user'])
        );
    }

    public function create(UserRequest $request)
    {
        $params = $request->all();
        $data = $this->userService->create($params);
        return $this->responseService->response(
            $data ? true : false,
            $data,
            $data ?
                __('messages.create.success', ['name' => $data->name]) :
                __('messages.create.fail', ['name' => $data->name])
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = $this->userService->getById($id);
        return $this->responseService->response(
            $data ? true : false,
            $data,
            $data ?
                __('messages.show.success', ['name' => $data->name]) :
                __('messages.show.fail', ['name' => 'user'])
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, int $id)
    {
        //
        $params = $request->only('name', 'email');
        $data = $this->userService->update($params, $id);
        return $this->responseService->response(
            $data ? true : false,
            $data,
            $data ?
                __('messages.create.success', ['name' => $request->name]) :
                __('messages.create.fail', ['name' => $request->name])
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = $this->userService->delete($id);
        return $this->responseService->response(
            $data ? true : false,
            $data,
            $data ?
                __('messages.delete.success', ['name' => 'user']) :
                __('messages.delete.fail', ['name' => 'user'])
        );
    }

    public function insertSheet()
    {
        $this->userService->insertSheet();
        $data = (new SheetService())->readSheets();
        return response()->json($data);
    }

    public function getSheet()
    {
        return $this->sheetService->readSheets();
    }

    public function updateSheet()
    {
        $this->userService->updateSheet();
    }

    public function postForgot(ForgotRequest $request)
    {
        $data = $this->userService->postForgot($request);
        return $this->responseService->response(
            true,
            $data,
            __('messages.create.success', ['name' => 'user'])
        );
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $params = $request->all();
        $data = $this->userService->updatePassword($params);
        return $this->responseService->response(
            true,
            $data,
            __('messages.update.success', ['name' => 'user'])
        );
    }
}
