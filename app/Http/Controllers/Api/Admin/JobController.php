<?php

namespace App\Http\Controllers\Api\Admin;

use App\Enums\JobStatus;
use App\Enums\UserRole;
use app\Helpers\CollectionHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\JobResource;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        if($user->role != UserRole::Admin)
            return response()->error(["Bạn không có quyền truy cập"], 403);
        $job = Job::where('job_status', JobStatus::Active)->get();
        $pagination = CollectionHelper::paginate($job, $request->pageSize);
        return response()->success(JobResource::collection($pagination));
    }

    public function pending(Request $request)
    {
        $user = auth()->user();
        if($user->role != UserRole::Admin)
            return response()->error(["Bạn không có quyền truy cập"], 403);
        $job = Job::where('job_status', JobStatus::Pending)->get();
        $pagination = CollectionHelper::paginate($job, $request->pageSize);
        return response()->success(JobResource::collection($pagination));
    }

    public function all(Request $request)
    {
        $user = auth()->user();
        if($user->role != UserRole::Admin)
            return response()->error(["Bạn không có quyền truy cập"], 403);
        $job = Job::all();
        $pagination = CollectionHelper::paginate($job, $request->pageSize);
        return response()->success(JobResource::collection($pagination));
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
