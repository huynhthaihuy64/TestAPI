<?php

return [

    'auth' => [
        'unAuthorize' => 'Unauthorized',
        'register' => [
            'success' => ':name Register Success',
            'fail' => ':name Register Fail'
        ],
        'login' => [
            'success' => ':name Login Success',
            'fail' => ':name Login Fail',
        ]
    ],

    'get' => [
        'success' => 'Get :name success',
        'fail' => 'Get :name failure'
    ],

    'create' => [
        'success' => 'Create :name success',
        'fail' => 'Create :name failure'
    ],

    'show' => [
        'success' => 'show :name success',
        'fail'    => 'show :name fail'
    ],

    'delete' => [
        'success' => 'Delete :name success',
        'fail' => 'Delete :name failure',
        'required' => 'invalid ids',
    ],

    'update' => [
        'success' => 'Update :name success',
        'fail'    => 'Update :name fail'
    ],

    'mail' =>
    [
        'title' => 'Mail from Huyhuynh',

        //Accept Interview
        'acceptInterview' => '<h2>Thank you for your time and interest in Mor Software Joint Stock Company and send your CV for the position of Back-end PHP. We look forward to talking with you in more detail about this job, as well as to get to know you better.</h2><br/>
        <h2>The interview will begin on </h2><br/>
        <h2><b>Interview online Google Meet</b></h2>
        <h2><b>Link interview: <a href="https://meet.google.com/ogs-nvuf-eha?authuser=0">https://meet.google.com/ogs-nvuf-eha?authuser=0</a></b></h2>
        <h2><b>Best regards!</b></h2>',

        //Pass Interview
        'passInterview' => '<h2>We sincerely thank you for your interest in MOR Software Joint Stock Company (MOR JSC) as well as the internship position you have applied for.</h2> <br/>
        <h2>After the review process, the company has decided to invite you to do an internship at the company headquarters.</h2> <br/>
          <h2><b>-  Addres: Company MOR - CN Đà Nẵng.</b><br/>
          <b> 112 Nguyễn Hữu Thọ, Phường Hoà Thuận Tây, Quận Hải Châu, Tp Đà Nẵng.</b></h2><br/>
          <h2><b>Best regards!</b></h2>',

        //Fail Interview
        'failInterview' => '<h2>Thank you for taking the time to participate in the recruitment of the company Back End programmer position.</h2><br/>
        <h2>We are really impressed by your resume and skills as well as what you showed during the interview.</h2><br/>
        <h2>However, we regret to inform you that we have decided to select another candidate more suitable for the position of Back End developer and the requirements of the job at this time.</h2><br/>
        
        <h2>We believe you may be a good fit for our company for future positions. We will keep your record and ask for your permission to contact you again when appropriate opportunities arise.</h2><br/>
         
        <h2><b>I wish you all the best in your career.</b></h2><br/>
        
        <h2><b>Best regards!</b></h2>',

        //Request Mail
        'requestMail' => '<h1>Thank you for participating in our company interview</h1>
        <h2>If you can interview before 6pm, please confirm this email and visit the website to create an account and apply for an interview.</h2>
        <a href="http://recruitment-manager-laravel.test/index" class="btn btn-block btn-danger">
              Confirm
          </a>'
    ],

    //Request Validate
    'email' => [
        'required' => 'Please enter your email',
        'unique' => 'Email already exist',
        'exists' => 'Email does not exist',
        'email' => 'The attribute must be a valid email address',
    ],

    'password' => [
        'required' => 'Please enter your password',
        'regex' => 'Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters',
        'confirmed' => 'Password confirm does not match',
    ],

    'name' => [
        'required' => 'Please enter your name',
    ],

    'date' => [
        'required' => 'Please enter date',
    ],

    'phone' => [
        'required' => 'Please enter your phone',
        'numeric' => 'Phone must be a number',
    ],

    'position' => [
        'required' => 'Please enter your position',
    ],

    'active' => [
        'required' => 'Please choose your active',
    ],

    'file' => [
        'required' => 'Please choose your file',
    ],

    'id_user' => [
        'required' => 'Please choose your presenter',
    ]
];
