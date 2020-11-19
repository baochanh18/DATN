<?php

namespace App\Http\Controllers\Api;

use app\Helpers\CollectionHelper;
use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Resources\Job as JobResource;

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
//        $jobs = Job::whereHas('jobDetail', function (Builder $query) {
//            $query->whereHas('addresses', function (Builder $query) {
//                $query->whereHas('location', function (Builder $query) {
//                   $query->where('city_id', 27);
//                });
//            });
//            $query->where('job_description', 'like', '%'.'quite'.'%');
//        });
        $jobs = Job::where('is_expire', 0);

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
            $jobs = $jobs->orderBy('active_day', 'desc');
        else
            $jobs = $jobs->orderBy('active_day', 'asc');
        $jobs = $jobs->get();
        $pagination = CollectionHelper::paginate($jobs, 15);
        return response()->success(\App\Http\Resources\Job::collection($pagination));
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
