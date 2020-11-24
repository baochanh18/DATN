<?php

namespace App\Http\Controllers\Api;

use App\Enums\JobStatus;
use app\Helpers\CollectionHelper;
use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Resources\Job as JobResource;
use App\Http\Resources\ShortJobInfo as ShortJobInfoResource;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $job = Job::all();
        $paginate = CollectionHelper::paginate($job, 30);
        return response()->success(JobResource::collection($paginate));
    }

    public function search(Request $request)
    {
        $jobs = Job::where('is_expire', 0)->where('job_status', JobStatus::Active);

        if($request->level != "all")
            $jobs = $jobs->levelsearch($request->level);
        if($request->category != "all")
            $jobs = $jobs->categorysearch($request->category);
        if($request->salary != "all")
            $jobs = $jobs->salarysearch($request->salary);
        if($request->city != "all")
            $jobs = $jobs->citysearch($request->city);
        if($request->filter != "")
            $jobs = $jobs->filtersearch($request->filter);

        if($request->sort == "desc")
            $jobs = $jobs->orderBy('active_day', 'asc');
        else
            $jobs = $jobs->orderBy('active_day', 'desc');
        $jobs = $jobs->get();
        $pagination = CollectionHelper::paginate($jobs, 15);
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
        return response()->success(new JobResource(Job::findOrFail($id)));
    }

    public function other_job($id)
    {
        $current_job = Job::findOrFail($id);
        $another_job = $current_job->user->jobs->where('id', '!=' , $id);
        return response()->success(ShortJobInfoResource::collection($another_job));
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
