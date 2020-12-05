<?php

namespace App\Http\Controllers\Api;

use App\Enums\JobStatus;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobStatusRequest;
use App\Http\Resources\Job as JobResource;
use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PreviewJobController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::findOrFail($id);
        $user = auth()->user();
        if($job->user->id != $user->id && $user->role != UserRole::Admin)
            return response()->error(["Không tìm thấy công việc này"], 404);
        return response()->success(new JobResource($job));
    }

    public function editjobstatus(JobStatusRequest $request, $id)
    {
        if($request->validator->fails()){
            return response()->error($request->validator->errors()->all(), 422);
        }
        $job = Job::findOrFail($id);
        $user = auth()->user();
        if($job->user->id != $user->id && $user->role != UserRole::Admin)
            return response()->error(["Không tìm thấy công việc này"], 404);

        if($user->role == UserRole::Admin)
        {
            error_log("call vao if");
            if ($request->job_status == JobStatus::Active && $job->active_day == null) {
                $job->job_status = JobStatus::Active;
                $job->active_day = Carbon::now();
                $job->save();
                return response()->success([], ['Kích hoạt việc làm thành công'], 201);
            } else if ($request->job_status == JobStatus::Hidden) {
                $job->job_status = JobStatus::Hidden;
                $job->is_expire = 1;
                $job->save();
                return response()->success([], ['Ẩn việc làm thành công'], 201);
            }
        }
        else
        {
            error_log("call vao else");
            if($request->job_status == JobStatus::Active && $job->is_expire == 0 && $job->active_day != null)
            {
                $job->job_status = JobStatus::Active;
                $job->save();
                return response()->success([], ['Kích hoạt việc làm thành công'], 201);
            }
            else if($request->job_status == JobStatus::Hidden)
            {
                $job->job_status = JobStatus::Hidden;
                $job->save();
                return response()->success([], ['Ẩn việc làm thành công'], 201);
            }
            else
            {
                $job->job_status = JobStatus::Pending;
                $job->save();
                return response()->success([], ['Yêu cầu xét duyệt việc làm thành công'], 201);
            }
        }
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
