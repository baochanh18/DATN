<?php

namespace App\Http\Controllers\Api;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApplyCvRequest;
use App\Models\Apply_cv;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplyCvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function store(ApplyCvRequest $request, $id)
    {
        if($request->validator->fails()){
            return response()->error($request->validator->errors()->all(), 422);
        }
        else
        {
            $user = auth()->user();
            $job = Job::findOrFail($id);
            if($user->role == UserRole::Company)
                return response()->error(["Bạn là nhà tuyển dụng, bạn không thể ứng tuyển"], 422);
            if(count($job->applyCvs->where('user_id', $user->id)))
                return response()->error(["Bạn đã ứng tuyển công việc này rồi"], 422);
            $fileName = $request->file('cv_file')->getClientOriginalName();
            $path = Storage::putFileAs('\apply-cv/'.time().'_'.$user->id, $request->file('cv_file'), $fileName);
            $cv = new Apply_cv($request->except('cv_file'));
            $cv->job_id = $id;
            $cv->user_id = $user->id;
            $cv->cv_file = $path;
            $cv->save();
            return response()->success([],["Ứng tuyển thành công"],201);
//            return Storage::download($path);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
