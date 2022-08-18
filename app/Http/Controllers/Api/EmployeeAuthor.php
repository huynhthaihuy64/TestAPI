<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Employee;
use App\Services\Common\ResponseService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EmployeeAuthor extends Controller
{

    private $responseService;

    public function __construct(ResponseService $responseService)
    {
        $this->responseService = $responseService;
    }

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => __('messages.auth.login.fail'),
                'message' => __('messages.auth.unAuthorize'),
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        return response()->json([
            'status' => __('messages.auth.login.success', ['name' => $user->name]),
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = Employee::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;

        return $this->responseService->response(
            $success ? true : false,
            $success,
            $success ?
                __('messages.auth.register.success', ['name' => $user->name]) :
                __('messages.auth.register.fail', ['name' => $user->name])
        );
    }

    public function employee(Request $request)
    {
        return response()->json($request->user());
    }

    public function index()
    {
        $data = Employee::get();
        return $this->responseService->response(
            $data ? true : false,
            $data,
            $data ?
                __('messages.auth.register.success', ['name' => 'employee']) :
                __('messages.auth.register.fail', ['name' => 'employee'])
        );
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'status' => 'success',
        ]);
    }
}
