<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CvRequest;
use App\Http\Requests\CvUpdateRequest;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use App\Services\CvService;
use App\Services\ResponseService;

class CvController extends Controller
{

    private $cvService;

    private $responseService;

    public function __construct(CvService $cvService, ResponseService $responseService)
    {
        $this->cvService = $cvService;
        $this->responseService = $responseService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cvs = $this->cvService->getAll();
        return $cvs;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(CvRequest $request)
    {
        $params = $request->validated();
        $data = $this->cvService->create($params);

        return $this->responseService->response(
            $data ? true : false,
            $data,
            __('Success')
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->cvService->getById($id);

        return $this->responseService->response(
            true,
            $data,
            $data ? __('Success') :
                __('Fail')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function update(CvUpdateRequest $request, int $id)
    {
        $params = $request->only('name', 'email', 'phone', 'position', 'active');
        $data = $this->cvService->update($params, $id);

        return $this->responseService->response(
            $data ? true : false,
            $data,
            $data ? __('Sucess') :
                __('Fail')
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = $this->cvService->delete($id);
        return $this->responseService->response(
            true,
            $data,
            $data ? __('Success') :
                __('Fail')
        );
    }

    public function sendmail($email)
    {
        $details = [
            'title' => 'Mail from Huyhuynh',
            'body' => '<h1>Cảm ơn bạn đã tham gia phỏng vấn công ty chúng tôi</h1>
            <h2>Nếu bạn có thể phỏng vấn trước 6pm thì hãy confirm mail này và truy cập trang web để tạo tài khoản và apply lịch phỏng vấn</h2>
            <a href="http://recruitment-manager-laravel.test/index" class="btn btn-block btn-danger">
                  Confirm
              </a>'
        ];
        Mail::to($email)->send(new TestMail($details));
        if (Mail::failures()) {
            return $this->responseService->response(
                true,
                '',
                __('Fail')
            );
        } else {
            return $this->responseService->response(
                true,
                '',
                __('Success')
            );
        }
    }
}
