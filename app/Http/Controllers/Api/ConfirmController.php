<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ConfirmRequest;
use Illuminate\Support\Facades\Mail;
use App\Services\ConfirmService;
use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use App\Services\Common\ResponseService;

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
        $data = $this->confirmService->getAll();
        return $this->responseService->response(
            $data ? true : false,
            $data,
            $data ?
                __('messages.get.success', ['name' => 'confirm']) :
                __('messages.get.fail', ['name' => 'confirm'])
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
        $data = $this->confirmService->getById($id);
        return $this->responseService->response(
            $data ? true : false,
            $data,
            $data ?
                __('messages.show.success', ['name' => 'confirm']) :
                __('messages.show.fail', ['name' => 'confirm'])
        );
    }

    public function update(ConfirmRequest $request, int $id)
    {
        $params = $request->all();
        $data = $this->confirmService->updateConfirm($params, $id);
        return $this->responseService->response(
            $data ? true : false,
            $data,
            $data ?
                __('messages.update.success', ['name' => 'confirm']) :
                __('messages.update.fail', ['name' => 'confirm'])
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(ConfirmRequest $request)
    {
        $params = $request->all();
        $data = $this->confirmService->create($params);
        return $this->responseService->response(
            $data ? true : false,
            $data,
            $data ?
                __('messages.create.success', ['name' => 'confirm']) :
                __('messages.create.fail', ['name' => 'confirm'])
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
            $data ?
                __('messages.delete.success', ['name' => 'confirm']) :
                __('messages.delete.fail', ['name' => 'confirm'])
        );
    }

    public function acceptInterview($mail)
    {
        $details = [
            'title' => __('messages.mail.title'),
            'body' => __('messages.mail.acceptInterview'),
        ];
        Mail::to($mail)->send(new TestMail($details));
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

    public function passInterview($mail)
    {
        $details = [
            'title' => __('messages.mail.title'),
            'body' => __('messages.mail.passInterview'),
        ];
        Mail::to($mail)->send(new TestMail($details));
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

    public function failInterview($mail)
    {
        $details = [
            'title' => __('messages.mail.title'),
            'body' => __('messages.mail.failInterview'),
        ];
        Mail::to($mail)->send(new TestMail($details));
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

    public function appendConfirmSheets()
    {
        $data = $this->confirmService->insertSheet();
        return $this->responseService->response(
            true,
            $data,
            __('messages.get.success', ['name' => 'confirm'])
        );
    }
}
