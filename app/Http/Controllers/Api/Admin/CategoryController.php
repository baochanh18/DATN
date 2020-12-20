<?php

namespace App\Http\Controllers\Api\Admin;

use app\Helpers\CollectionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\Admin\CategoryResource;
use App\Models\Job_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Gate::denies('users.viewAny')) return $this->notAuthorized();
        $filter = $request->get('filtered');
        $sorted = $request->get('sorted');
        $categories = Job_category::withCount('jobDetails');
        if(count($filter))
            if($filter[0]['id'] == 'job_name')
                $categories = $categories->where('job_name', 'LIKE', '%' . $filter[0]['value'] . '%');
        if(count($sorted))
        {
            if($sorted[0]['id'] == 'job_name' || $sorted[0]['id'] == 'job_details_count')
                if($sorted[0]['desc'])
                    $categories = $categories->orderBy($sorted[0]['id'], 'desc');
                else
                    $categories = $categories->orderBy($sorted[0]['id']);
        }

        $pagination = CollectionHelper::paginate($categories->get(), $request->pageSize);
        return response()->success(CategoryResource::collection($pagination));
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
    public function store(CategoryRequest $request)
    {
        if(Gate::denies('users.viewAny')) return $this->notAuthorized();
        if($request->validator->fails()){
            return response()->error($request->validator->errors()->all(), 422);
        }
        Job_category::create($request->only(['job_name']));
        return response()->success([], ['Tạo ngành nghề thành công'], 201);
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
    public function update(CategoryRequest $request, $id)
    {
        if(Gate::denies('users.viewAny')) return $this->notAuthorized();
        if($request->validator->fails()){
            return response()->error($request->validator->errors()->all(), 422);
        }
        $category = Job_category::findOrFail($id);
        $category->update($request->only(['job_name']));
        return response()->success([], ['Chỉnh sửa ngành nghề thành công'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('users.viewAny')) return $this->notAuthorized();
        $category = Job_category::findOrFail($id);
        $category->jobDetails()->detach();
        $category->delete();
        return response()->success([], ['Xóa ngành nghề thành công'], 201);
    }
}
