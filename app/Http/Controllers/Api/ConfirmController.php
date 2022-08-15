<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ConfirmRequest;
use Illuminate\Support\Facades\Mail;
use App\Services\ConfirmService;
use App\Http\Controllers\Controller;
use App\Mail\TestMail;
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
            __('Show Success')
        );
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

    public function acceptInterview($mail, $date)
    {
        $details = [
            'title' => 'Mail from Huyhuynh',
            'body' => '<h2>Cảm ơn bạn đã dành thời gian quan tâm đến công ty CP Phần Mềm Mor và gửi CV ứng tuyển cho vị trí Back-end PHP. Chúng tôi rất mong muốn được trao đổi với bạn chi tiết hơn về công việc này, cũng như để hiểu rõ hơn về bạn.</h2><br/>
            <h2>Buổi phỏng vấn sẽ được bắt đầu vào: </h2><br/>

            <h2><b>Thời gian : ' . $date . '</b></h2><br/>
            <h2><b>Hình thức phỏng vấn: Online</b></h2>
            <h2><b>Link phỏng vấn: <a href="https://meet.google.com/ogs-nvuf-eha?authuser=0">https://meet.google.com/ogs-nvuf-eha?authuser=0</a></b></h2>
            <h2><b>Trân trọng!</b></h2>'
        ];
        Mail::to($mail)->send(new TestMail($details));
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

    public function passInterview($mail)
    {
        $details = [
            'title' => 'Mail from Huyhuynh',
            'body' => '<h2>Chúng tôi chân thành cảm ơn sự quan tâm của bạn đối với công ty CP Phần Mềm MOR (MOR JSC) cũng như vị trí thực tập mà bạn đã ứng tuyển.</h2> <br/>

            <h2>Sau quá trình xem xét, công ty đã quyết định mời bạn vào thực tập tại trụ sở của công ty.</h2> <br/>
            
              <h2><b>-  Địa chỉ: Công ty CP Phần Mềm MOR - CN Đà Nẵng.</b><br/>
            
              <b> 112 Nguyễn Hữu Thọ, Phường Hoà Thuận Tây, Quận Hải Châu, Tp Đà Nẵng.</b></h2><br/>
              <h2><b>Trân Trọng!</b></h2>'
        ];
        Mail::to($mail)->send(new TestMail($details));
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

    public function failInterview($mail)
    {
        $details = [
            'title' => 'Mail from Huyhuynh',
            'body' => '<h2>Cảm ơn bạn đã dành thời gian tham gia tuyển dụng vị trí lập trình viên Back End của công ty.</h2><br/>
            <h2>Chúng tôi thực sự ấn tượng bởi hồ sơ và kĩ năng của bạn cũng như những gì bạn thể hiện trong suốt buổi phỏng vấn. </h2><br/>
            <h2>Tuy nhiên, chúng tôi rất tiếc phải thông báo với bạn rằng chúng tôi đã quyết định lựa chọn một ứng viên khác phù hợp hơn với vị trí lập trình viên Back End và yêu cầu của công việc tại thời điểm này.</h2><br/>
            
            <h2>Chúng tôi tin rằng bạn có thể phù hợp với công ty chúng tôi cho những vị trí trong tương lai. Chúng tôi sẽ lưu lại hồ sơ của bạn và xin phép liên hệ lại với bạn khi có cơ hội phù hợp. </h2><br/>
             
            <h2><b>Xin chúc bạn mọi điều may mắn trong sự nghiệp.</b></h2><br/>
            
            <h2><b>Trân trọng!</b></h2>'
        ];
        Mail::to($mail)->send(new TestMail($details));
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
