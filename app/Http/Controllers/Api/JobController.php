<?php

namespace App\Http\Controllers\Api;

use App\Enums\JobStatus;
use App\Enums\UserRole;
use app\Helpers\CollectionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Http\Resources\SaveJobResource;
use App\Http\Resources\ShortJobInfo;
use App\Models\Job;
use App\Models\Saved_job;
use Illuminate\Http\Request;
use App\Http\Resources\Job as JobResource;
use App\Http\Resources\ShortJobInfo as ShortJobInfoResource;
use Illuminate\Support\Facades\DB;
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
        $job = Job::all();
        $paginate = CollectionHelper::paginate($job, 30);
        return response()->success(JobResource::collection($paginate));
    }

    public function search(Request $request)
    {
        $jobs = Job::with(['jobDetail', 'jobDetail.jobCategories', 'jobDetail.addresses', 'jobDetail.addresses.city',
            'benefits', 'applyCvs', 'jobDetail.addresses.location','jobDetail.addresses.country'])
            ->where('is_expire', 0)->where('job_status', JobStatus::Active);

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
    public function store(JobRequest $request)
    {
//        return response()->json(\GuzzleHttp\json_decode($request->addresses[0], true));
        if($request->validator->fails()){
            return response()->error($request->validator->errors()->all(), 422);
        }
        $user = auth()->user();
        if($user->role != UserRole::Company) {
            return response()->error(["Bạn không có thực hiện chức năng này"], 403);
        }
        $fileName = $request->file('company_logo')->getClientOriginalName();
        $path = Storage::putFileAs('logo/'.time().'_'.$user->id, $request->file('company_logo'), $fileName);

        DB::beginTransaction();
        try {
            $job = new Job($request->except(['company_logo', 'is_expire', 'active_day', 'job_status']));
            $job->company_logo = $path;
            $job->user_id = $user->id;
            $job->save();
            foreach($request->benefits as $key => $val)
            {
                info("call create benefit");
                $job->benefits()->create(\GuzzleHttp\json_decode($val, true));
            }
            $detail = $job->jobDetail()->create($request->all());
            $detail->jobCategories()->sync($request->job_categories);
            foreach($request->addresses as $key => $val)
            {
                info("call create address");
                $detail->addresses()->create(\GuzzleHttp\json_decode($val, true));
            }
            DB::commit();

            return response()->success([], ['Tạo việc làm mơi thành công'], 201);
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            throw $exception;
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
        $job = Job::findOrFail($id);
        if($job->job_status != JobStatus::Active)
            return response()->error(["Không tìm thấy côn việc này"], 404);
        return response()->success(new JobResource($job));
    }

    public function other_job($id)
    {
        $current_job = Job::findOrFail($id);
        $another_job = $current_job->user->jobs->where('id', '!=' , $id);
        return response()->success(ShortJobInfoResource::collection($another_job));
    }

    public function save_job($id)
    {
        $user = auth()->user();
        if($user->role == UserRole::Company)
            return response()->error(["Bạn là nhà tuyển dụng, bạn không thể lưu công việc"], 422);
        if(count($user->savedJobs->where('job_id', $id)) != 0)
            return response()->error(["Bạn đã lưu công việc này rồi"], 422);
        Saved_job::create([
           'user_id' => $user->id,
           'job_id' => $id
        ]);
        return response()->success([], ['Lưu việc làm thành công'], 201);
    }

    public function unsave_job($id)
    {
        $user = auth()->user();
        $job = Job::findOrFail($id);
        if(count($job->savedJobs->where('user_id', $user->id)) == 0)
            return response()->error(["Bạn chưa lưu công việc này"], 422);
        else
        {
            $saved_job = $job->savedJobs->where('user_id', $user->id)->first();
            $saved_job->delete();
            return response()->success([], ['Bỏ lưu việc làm thành công thành công'], 201);
        }
    }

    public function getsaved_job()
    {
        $user = auth()->user();
        return response()->success(SaveJobResource::collection($user->savedJobs));
    }

    public function getjobs(Request $request)
    {
        $user = auth()->user();
        if($user->role != UserRole::Company)
            return response()->error(["Bạn không có quyền truy cập"], 422);
        if($request->type >= 0 && $request->type <= 3)
        {
            $job = $user->jobs->where('job_status', $request->type)->where('is_expire', 0);
            return response()->success(ShortJobInfo::collection($job));
        }
        if($request->type == 4)
        {
            $job = $user->jobs->where('is_expire', 1);
            return response()->success(ShortJobInfo::collection($job));
        }
        return response()->success(ShortJobInfo::collection($user->jobs));
    }

    public function getnewest_job()
    {
        $job = Job::where('is_expire', 0)->where('job_status', JobStatus::Active)
                    ->orderBy('active_day', 'desc')
                    ->take(10)->get();
        return response()->success(JobResource::collection($job));
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
