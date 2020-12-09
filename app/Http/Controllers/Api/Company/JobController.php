<?php

namespace App\Http\Controllers\Api\Company;

use App\Enums\JobStatus;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Http\Resources\Job as JobResource;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
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
        $job = Job::findOrFail($id);
        $user = auth()->user();
        if($job->user->id != $user->id && $user->role != UserRole::Admin)
            return response()->error(["Không tìm thấy côn việc này"], 404);
        return response()->success(new JobResource($job));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobRequest $request, $id)
    {
        if($request->validator->fails()){
            return response()->error($request->validator->errors()->all(), 422);
        }
        $user = auth()->user();
        $editJob = Job::findOrFail($id);
        if($user->id != $editJob->user_id) {
            return response()->error(["Bạn không thể thực hiện chức năng này"], 403);
        }
        if ($request->hasFile('company_logo')) {
            $fileName = $request->file('company_logo')->getClientOriginalName();
            $path = Storage::putFileAs('logo/'.time().'_'.$user->id, $request->file('company_logo'), $fileName);
            $editJob->company_logo = $path;
            $editJob->save();
        }
        $editJob->update($request->except(['company_logo', 'is_expire', 'active_day', 'job_status']));
        $editJob->benefits()->delete();
        foreach($request->benefits as $key => $val)
        {
            $editJob->benefits()->create(\GuzzleHttp\json_decode($val, true));
        }
        $editJob->jobDetail()->update($request->only(['job_salary_type', 'job_minimum_salary', 'job_maximum_salary', 'job_level',
                            'job_type', 'job_description', 'job_requirement', 'cv_language']));
        $editJob->jobDetail->jobCategories()->sync($request->job_categories);

        $editJob->jobDetail->addresses()->sync([]);
        foreach($request->addresses as $key => $val)
        {
            $editJob->jobDetail->addresses()->create(\GuzzleHttp\json_decode($val, true));
        }

        return response()->success([], ['Chỉnh sửa việc làm thành công'], 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $user = auth()->user();
        if($user->id != $job->user_id) {
            return response()->error(["Bạn không thể thực hiện chức năng này"], 403);
        }
        if($job->job_status != JobStatus::Draft) {
            return response()->error(["Bạn không thể xóa công việc này"], 403);
        }
        $job->delete();
        return response()->success([], ['Xóa việc làm thành công'], 201);
    }
}
