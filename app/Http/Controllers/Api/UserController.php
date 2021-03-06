<?php

namespace App\Http\Controllers\Api;

use app\Helpers\CollectionHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Enums\UserRole;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        if(Gate::denies('users.viewAny')) return $this->notAuthorized();
//        $users = User::orderBy('id')->where('role', '!=', 1)->paginate(15);
//        return response()->success(UserResource::collection($users));
    }

    public function me()
    {
        $user = auth()->user();

        return response()->success([ "user" => new UserResource($user) ]);
    }

    public function userinfo(Request $request)
    {
        if(Gate::denies('users.viewAny')) return $this->notAuthorized();
        $sort = $request->get('sorted');
        $users = User::where('role', '!=', UserRole::Company)
            ->filter($request->get('filtered'))
            ->sort($sort)
            ->get();
        if(count($sort))
        {
            if($sort[0]['id'] == 'name' )
                if($sort[0]['desc'])
                    $users = $users->sortByDesc(function ($val){
                        return $val->userable->name;
                    });
                else
                    $users = $users->sortBy(function ($val){
                        return $val->userable->name;
                    });
        }

        $pagination = CollectionHelper::paginate($users, $request->pageSize);
        return response()->success(UserResource::collection($pagination));
    }

    public function companyinfo(Request $request)
    {
        if(Gate::denies('users.viewAny')) return $this->notAuthorized();
        $sort = $request->get('sorted');
        $users = User::where('role', '=', UserRole::Company)
            ->filterCom($request->get('filtered'))
            ->sortCom($sort)
            ->get();
        if(count($sort))
        {
            if($sort[0]['id'] == 'name' )
                if($sort[0]['desc'])
                    $users = $users->sortByDesc(function ($val){
                        return $val->userable->name;
                    });
                else
                    $users = $users->sortBy(function ($val){
                        return $val->userable->name;
                    });
            else if($sort[0]['id'] == "contact_office_email" )
                if($sort[0]['desc'])
                    $users = $users->sortByDesc(function ($val){
                        return $val->userable->contact_office_email;
                    });
                else
                    $users = $users->sortBy(function ($val){
                        return $val->userable->contact_office_email;
                    });
            else if($sort[0]['id'] == "company_size" )
                if($sort[0]['desc'])
                    $users = $users->sortByDesc(function ($val){
                        return $val->userable->company_size;
                    });
                else
                    $users = $users->sortBy(function ($val){
                        return $val->userable->company_size;
                    });
        }

        $pagination = CollectionHelper::paginate($users, $request->pageSize);
        return response()->success(UserResource::collection($pagination));
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
        return response()->success(new UserResource(User::findOrFail($id)));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function editstatus(Request $request, $id)
    {
        if(Gate::denies('users.viewAny')) return $this->notAuthorized();
        $user = User::findOrFail($id);
        if($user->isActive)
        {
            $user->isActive = false;
            $user->save();
            return response()->success([],['Khóa tài khoản thành công1'], 200);
        }
        else
        {
            $user->isActive = true;
            $user->save();
            return response()->success([],'Kích hoạt tài khoản thành công!', 200);
        }
    }

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
        $user = User::findOrFail($id);
        if(Gate::denies('users.update', $user)) return $this->notAuthorized();
        if(isset($request['password']))
            $user->update(['password' => bcrypt($request->password)]);
        if(isset($request['isAdmin']))
        {
            if (Auth::user()->isAdmin)
                $user->update(['isAdmin' => $request->isAdmin]);
        }

        return response()->success(new UserResource($user));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if(Gate::denies('users.delete', $user)) return $this->notAuthorized();
        $user->delete();
        return  response()->success("", "Delete successfully");
    }
}
