<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Arr;
use App\Models\Admin;
use App\Http\Requests\Dashboard\Admins\StoreAdminRequest;
use App\Http\Requests\Dashboard\Admins\UpdateAdminRequest;
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\UploadImageTrait;

class AdminsController extends Controller
{
    use UploadImageTrait;

    // function __construct()
    // {
    //      $this->middleware('permission:admin-list|admin-create|admin-edit|admin-delete', ['only' => ['index','store']]);
    //      $this->middleware('permission:admin-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:admin-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:admin-delete', ['only' => ['destroy']]);
    // }

    public function index(Request $request)
    {
        
        $admins = Admin::when($request->query('from_date'), function($query, $from_date) {
            $query->where('created_at', '>=', $from_date);
        })->when($request->query('to_date'), function($query, $to_date) {
            $query->where('created_at', '<=', $to_date);
        })->orderBy('id','DESC')->paginate(30);
        return view('admin.admins.index',compact('admins'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function create()
    {
         $roles=Role::select('id','guard_name','name')->get();
         $type=request('type');
        return view('admin.admins.create',compact('roles','type'));
    }


    public function store(StoreAdminRequest $request)
    {
        $input = $request->except('_token','roles_name');
        $input['password'] = ($input['password']);
        $input['account_type'] = 'admin';
        $input['admin_id'] = auth('admin')->user()->id;
        $admin = Admin::create($input);
        $admin->assignRole($request->input('roles_name'));
        if(request()->hasFile('photo_profile') && request()->file('photo_profile')->isValid()){
            $this->convertImageToWebp($request->photo_profile,$admin,'photo_profile','admins');
        }
        return redirect()->route('admins.index',['type'=>request('type')])->with('success',trans('messages.AddSuccessfully'));
    }


    public function show(Admin $admin)
    {
        return view('admin.admins.show',compact('admin'));
    }


    public function edit(Admin $admin)
    {

        $roles=Role::select('id','guard_name','name')->get();
         
        $adminRole = $admin->roles?->pluck('name')->first();
        // $adminRole = $admin->roles_name;
        // dd($adminRole);
        $type=request('type');
        return view('admin.admins.edit',compact('admin','roles','adminRole','type'));

    }


    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $input = $request->except('_token','_method');

        if(!empty($input['password'])){
            $input['password'] = ($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $admin->update($input);

        DB::table('model_has_roles')->where('model_id',$admin->id)->delete();

        $admin->assignRole($request->input('roles_name'));
        if(request()->hasFile('photo_profile') && request()->file('photo_profile')->isValid()){
            $admin->clearMediaCollection('photo_profile');
            $this->convertImageToWebp($request->photo_profile,$admin,'photo_profile','admins');
        }
        return redirect()->route('admins.index',['type'=>request('type')])
            ->with('success',trans('messages.UpdatedSuccessfully'));
    }


    public function destroy(Admin $admin)
    {
        $admin->clearMediaCollection('photo_profile');
        $admin->delete();
        return redirect()->route('admins.index',['type'=>request('type')])
            ->with('success', trans('messages.DeletedSuccessfully'));
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        Admin::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=> trans('messages.RecordsDeleteSuccessfully')]);
    }


}
