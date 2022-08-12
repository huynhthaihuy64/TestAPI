<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CvRequest;
use App\Http\Requests\CvUpdateRequest;
use App\Mail\MyTestMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Cv;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthService;
use Illuminate\Support\Facades\Session;

class CvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cvs = CV::get();
        return view('admin.cv.list', [
            'title' => 'List Cv',
            'cvs' => $cvs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('submit_cv', [
            'title' => 'Submit Cv',
            'users' => User::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CvRequest $request)
    {
        $tname = $request->name;
        $fileName = $tname . '-' . $request->file->getClientOriginalName();
        $request->file->move(public_path('uploads'), $fileName);
        $cv = new Cv;
        $cv->name = $request->name;
        $cv->email = $request->email;
        $cv->id_user = $request->id_user;
        $cv->phone = $request->phone;
        $cv->file = $fileName;
        $cv->position = $request->position;
        $cv->date = $request->date;
        $cv->save();
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('admin.cv.edit', [
            'title' => 'Edit CV',
            'cv' => Cv::get()->find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function update(CvUpdateRequest $request, $id)
    {
        $cv = Cv::find($id);
        $tname = $request->name;
        $fileName =  $tname . '-' . $request->file->getClientOriginalName();
        $request->file->move(public_path('uploads'), $fileName);
        $cv->name = $request->name;
        $cv->email = $request->email;
        $cv->phone = $request->phone;
        $cv->file = $fileName;
        $cv->date =  !empty($cv->date) && $cv->date != NULL ? $cv->date : $request->date;
        $cv->position = $request->position;
        $cv->active = $request->active;
        $cv->save();
        Session::flash('success', 'Update Success');
        return redirect()->route('cv.list');
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
        $del = Cv::find($id)->delete();
        if ($del) {
            Session::flash('success', 'Delete Success');
            return redirect()->back();
        } else {
            Session::flash('error', 'Delete Fail');
            return redirect()->back();
        }
    }
}
