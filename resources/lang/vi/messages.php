<?php

return [

    'auth' => [
        'unAuthorize' => 'Không được phép',
        'register' => [
            'success' => ':name Đăng ký thành công',
            'fail' => ':name Đăng ký thất bại'
        ],
        'login' => [
            'success' => ':name Đăng nhập thành công',
            'fail' => ':name Đăng nhập thất bại',
        ]
    ],

    'get' => [
        'success' => 'Lấy dữ liệu :name thành công',
        'fail' => 'Lấy dữ liệu :name thất bại'
    ],

    'create' => [
        'success' => 'Khởi tạo :name thành công',
        'fail' => 'Khởi tạo :name thất bại'
    ],

    'show' => [
        'success' => 'Hiển thị :name thành công',
        'fail'    => 'Hiển thị :name thất bại'
    ],

    'delete' => [
        'success' => 'Xoá :name thành công',
        'fail' => 'Xoá :name thất bại',
        'required' => 'Không có giá trị ids',
    ],

    'update' => [
        'success' => 'Cập nhật :name thành công',
        'fail'    => 'Cập nhật :name thất bại'
    ],

    'mail' =>
    [
        'title' => 'Mail from Huyhuynh',

        //Accept Interview
        'acceptInterview' => '<h2>Cảm ơn bạn đã dành thời gian quan tâm đến công ty CP Phần Mềm Mor và gửi CV ứng tuyển cho vị trí Back-end PHP. Chúng tôi rất mong muốn được trao đổi với bạn chi tiết hơn về công việc này, cũng như để hiểu rõ hơn về bạn.</h2><br/>
        <h2>Buổi phỏng vấn sẽ được bắt đầu vào: </h2><br/>
        <h2><b>Hình thức phỏng vấn: Online</b></h2>
        <h2><b>Link phỏng vấn: <a href="https://meet.google.com/ogs-nvuf-eha?authuser=0">https://meet.google.com/ogs-nvuf-eha?authuser=0</a></b></h2>
        <h2><b>Trân trọng!</b></h2>',

        //Pass Interview
        'passInterview' => '<h2>Chúng tôi chân thành cảm ơn sự quan tâm của bạn đối với công ty CP Phần Mềm MOR (MOR JSC) cũng như vị trí thực tập mà bạn đã ứng tuyển.</h2> <br/>
        <h2>Sau quá trình xem xét, công ty đã quyết định mời bạn vào thực tập tại trụ sở của công ty.</h2> <br/>
          <h2><b>-  Địa chỉ: Công ty CP Phần Mềm MOR - CN Đà Nẵng.</b><br/>
          <b> 112 Nguyễn Hữu Thọ, Phường Hoà Thuận Tây, Quận Hải Châu, Tp Đà Nẵng.</b></h2><br/>
          <h2><b>Trân Trọng!</b></h2>',

        //Fail Interview
        'failInterview' => '<h2>Cảm ơn bạn đã dành thời gian tham gia tuyển dụng vị trí lập trình viên Back End của công ty.</h2><br/>
        <h2>Chúng tôi thực sự ấn tượng bởi hồ sơ và kĩ năng của bạn cũng như những gì bạn thể hiện trong suốt buổi phỏng vấn. </h2><br/>
        <h2>Tuy nhiên, chúng tôi rất tiếc phải thông báo với bạn rằng chúng tôi đã quyết định lựa chọn một ứng viên khác phù hợp hơn với vị trí lập trình viên Back End và yêu cầu của công việc tại thời điểm này.</h2><br/>
        <h2>Chúng tôi tin rằng bạn có thể phù hợp với công ty chúng tôi cho những vị trí trong tương lai. Chúng tôi sẽ lưu lại hồ sơ của bạn và xin phép liên hệ lại với bạn khi có cơ hội phù hợp. </h2><br/>
        <h2><b>Xin chúc bạn mọi điều may mắn trong sự nghiệp.</b></h2><br/>
        <h2><b>Trân trọng!</b></h2>',

        //Request Mail
        'requestMail' => '<h1>Cảm ơn bạn đã tham gia phỏng vấn công ty chúng tôi</h1>
        <h2>Nếu bạn có thể phỏng vấn trước 6pm thì hãy confirm mail này và truy cập trang web để tạo tài khoản và apply lịch phỏng vấn</h2>
        <a href="http://recruitment-manager-laravel.test/index" class="btn btn-block btn-danger">
              Confirm
          </a>'
    ],

    //Request Validate
    'email' => [
        'required' => 'Email không được trống',
        'unique' => 'Email đã tồn tại',
        'exists' => 'Email không tồn tại',
        'email' => 'Thuộc tính Email không đúng',
    ],

    'password' => [
        'required' => 'Password không được trống',
        'regex' => 'Password phải chứa ít nhất một số và một chữ cái viết hoa và viết thường và ít nhất 8 ký tự trở lên ',
        'confirmed' => 'Password không khớp',
    ],

    'name' => [
        'required' => 'Name không được trống',
    ],

    'date' => [
        'required' => 'Date không được trống',
    ],

    'phone' => [
        'required' => 'Số điện thoại không được trống',
        'numeric' => 'Số điện thoại phải là dạng số',
    ],

    'position' => [
        'required' => 'Hãy nhập vị trí muốn ứng tuyển',
    ],

    'active' => [
        'required' => 'Hãy chọn trạng thái của bạn',
    ],

    'file' => [
        'required' => 'Hãy chọn tập tin bạn muốn',
    ],

    'id_user' => [
        'required' => 'Hãy chọn người giới thiệu của bạn',
    ]
];
