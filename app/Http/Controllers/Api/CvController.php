<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CvRequest;
use App\Http\Requests\CvUpdateRequest;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use App\Services\CvService;
use App\Services\Common\ResponseService;

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
        $data = $this->cvService->getAll();
        return $this->responseService->response(
            $data ? true : false,
            $data,
            $data ?
                __('messages.get.success', ['name' => 'cv']) :
                __('messages.get.fail', ['name' => 'cv'])
        );
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
            $data ?
                __('messages.create.success', ['name' => 'cv']) :
                __('messages.create.fail', ['name' => 'cv'])
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
            $data ? true : false,
            $data,
            $data ?
                __('messages.show.success', ['name' => 'cv']) :
                __('messages.show.fail', ['name' => 'cv'])
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
            $data ?
                __('messages.update.success', ['name' => 'cv']) :
                __('messages.update.fail', ['name' => 'cv'])
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
            $data ? true : false,
            $data,
            $data ?
                __('messages.delete.success', ['name' => 'cv']) :
                __('messages.delete.fail', ['name' => 'cv'])
        );
    }

    public function sendmail($email)
    {
        $details = [
            'title' => __('messages.mail.title'),
            'body' => __('messages.mail.requestMail'),
        ];
        Mail::to($email)->send(new TestMail($details));
        if (Mail::failures()) {
            return $this->responseService->response(
                true,
                '',
                __('messages.get.fail', ['name' => 'send mail'])
            );
        } else {
            return $this->responseService->response(
                true,
                '',
                __('messages.get.success', ['name' => 'send mail'])
            );
        }
    }

    public function appendCvSheets()
    {
        $data = $this->cvService->insertSheet();
        return $this->responseService->response(
            true,
            $data,
            __('messages.get.success', ['name' => 'cv'])
        );
    }
}
