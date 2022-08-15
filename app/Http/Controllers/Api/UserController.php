<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\ResponseService;
use App\Services\UserService;

class UserController extends Controller
{

    public $userService;

    private $responseService;

    public function __construct(UserService $userService, ResponseService $responseService)
    {
        $this->userService = $userService;
        $this->responseService = $responseService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return $this->userService->getAll();
    }

    public function create(RegisterRequest $request)
    {
        User::create($request->all(), with($request->role == 1));
        return redirect()->route('user.list');
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
            __('Show Success')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        //
        User::find($id)->update($request->all());
        return redirect()->route('user.list');
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
        $del = User::find($id)->delete();
        if ($del) {
            return redirect()->route('user.list');
        }
    }
}
