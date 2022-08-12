<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
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

    public function check()
    {
        return view('admin.index', [
            'title' => 'Admin Page',
        ]);
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
        $user = User::get()->find($id);
        return view('admin.user.edit', [
            'title' => 'Edit User',
            'user' => $user,
        ]);
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
            Session::flash('success', 'Delete Success');
            return redirect()->back();
        } else {
            Session::flash('error', 'Delete Fail');
            return redirect()->back();
        }
    }
}
