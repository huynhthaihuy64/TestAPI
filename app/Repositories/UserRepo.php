<?php


namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Str;
use App\Repositories\EloquentRepo;
use App\Services\Common\SheetService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserRepo extends EloquentRepo
{
    public function getModel()
    {
        return User::class;
    }

    public function create(array $params)
    {
        return $this->model->create($params);
    }

    public function updateUser(array $params, int $id)
    {
        return $this->model->where('id', $id)->update($params);
    }

    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function insertSheet()
    {
        $users = $this->model->get();
        foreach ($users as $user) {
            (new SheetService())->appendSheets([
                [
                    $user->name,
                    $user->email,
                    $user->password,
                ]
            ]);
        }
    }

    public function updateSheet()
    {
        $users = $this->model->get();
        foreach ($users as $user) {
            (new SheetService())->updateSheets([
                [
                    $user->name,
                    $user->email,
                    $user->password,
                ]
            ]);
        }
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function deleteById($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function postForgot($request)
    {
        $token = Str::random(64);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::send('verify', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password Notification');
        });
    }

    public function updatePassword(array $params)
    {
        // $updatePassword = DB::table('password_resets')
        //     ->where(['email' => $request->email, 'token' => $request['token']])
        //     ->first();
        $updatePassword = DB::table('password_resets')->where('email', $params['email'])->get();
        if (!$updatePassword) {
            return response()->json([
                'status' => __('messages.auth.login.fail'),
                'message' => __('messages.update.fail', ['name' => 'password']),
            ], 401);
        }

        $user = User::where('email', $params['email'])
            ->update(['password' => Hash::make($params['password'])]);

        DB::table('password_resets')->where(['email' => $params['email']])->delete();
    }
}
