<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Models\District;
use App\Models\vehicle;
use App\Models\AssignedVehicle;
use App\Models\UserTransfer;
use App\Models\AssignTask;
use App\Helpers\CustomHelpers;
use Auth;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function roles(Request $request){
        if ($request->ajax()) {
            $roles = Role::with('permissions')->where('roles.name','!=','admin');
            return Datatables::of($roles)
                            ->addColumn('permission', function($row){
                                $permissions = $row->permissions->pluck('name')->toArray();
                                $permission_data = wordwrap(implode(', ', $permissions), 75, "<br>", true);
                                return !empty($permission_data) ? $permission_data : 'None';
                            })
                            ->addColumn('action', function($row){
                                $actionBtn = '';
                                
                                if(auth()->user()->can('Edit Role')){
                                    $actionBtn=' <a href="'.route('edit_role', ['role_id' => Crypt::encryptString($row->id)]).'" class="edit btn btn-success btn-sm">Edit</a>';
                                }
                                
                                if(auth()->user()->can('Remove Role')){
                                    $actionBtn .= '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="'.Crypt::encryptString($row->id).'">Delete</a>';
                                }

                                return $actionBtn;
                            })
                            ->rawColumns(['action','permission'])
                            ->make(true);
        }
        return view('dashboardPages.roles.roles');
    }

    public function edit_role(Request $request){
        try{
            $selected_role_id=$request->role_id;

            $role = Role::with('permissions')->where('id',Crypt::decryptString($request->role_id))->first();

            $selected_permissions = $role->permissions->pluck('name')->toArray();
            
            $all_permissions = Permission::all()->toArray();

            return view('dashboardPages.roles.edit_role',compact('role','selected_permissions','all_permissions','selected_role_id'));
        }
        catch(\Exception $e){
            abort(404);
        }
    }

    public function update_role(Request $request){
        $assigned_permissions=!empty($request->assigned_permissions) ? $request->assigned_permissions : [];
        $role = Role::find(Crypt::decryptString($request->role_id));
        
        $new_permissions=[];
        
        foreach($assigned_permissions as $key=>$val){
            $new_permissions[]=$val;
        }

        $role->syncPermissions($new_permissions);
        $role->save();

        return redirect()->route('roles')->with('message', 'Permissions updated successfully');
    }

    public function create_role(){
        $all_permissions = Permission::all()->toArray();
        return view('dashboardPages.roles.new_role',compact('all_permissions'));
    }

    public function new_role(Request $request){
        $validated = $request->validate([
            'role' => 'required'
        ]);

        $new_role=Role::create(['name' => $request->role,'guard_name'=>'web']);

        $assigned_permissions=!empty($request->assigned_permissions) ? $request->assigned_permissions : [];

        $new_permissions=[];
        
        foreach($assigned_permissions as $key=>$val){
            $new_permissions[]=$val;
        }

        $new_role->syncPermissions($new_permissions);
        $new_role->save();

        return redirect()->route('roles')->with('message', 'Permissions updated successfully');
    }

    public function remove_role(Request $request){
        if ($request->ajax()) {
            Role::where('id',Crypt::decryptString($request->role_id))->delete();

            return true;
        }
    }

    public function all_users(Request $request){
        $users = User::orderBy('id', 'DESC')->where('id','!=',1)->get();
        if ($request->ajax()) {
            $users = User::orderBy('id', 'DESC')->where('id','!=',1);

            return Datatables::of($users)
                            ->addColumn('district', function($row){
                                return getDistrictName($row->district);
                            })
                            ->addColumn('dob', function($row){
                                return date('F d, Y',strtotime($row->dob));
                            })
                            ->addColumn('status', function($row){
                                return ($row->status==1) ? 'Active' : 'InActive';
                            })
                            ->addColumn('role', function($row){
                                return !is_null($row->roles()->first()) ? ucfirst($row->roles()->first()->name) : '';
                            })
                            ->addColumn('action', function($row){
                                $actionBtn = '<a href="'.route('edit_user', ['user_id' => Crypt::encryptString($row->id)]).'" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="'.Crypt::encryptString($row->id).'">Delete</a>';

                                if($row->status==1){
                                    $actionBtn .= '&nbsp;<a href="javascript:void(0)" class="update_status btn btn-danger btn-sm" data-id="'.Crypt::encryptString($row->id).'" data-status="0">DeActivate</a>';
                                }
                                else{
                                    $actionBtn .= '&nbsp;<a href="javascript:void(0)" class="update_status btn btn-success btn-sm" data-id="'.Crypt::encryptString($row->id).'" data-status="1">Activate</a>';
                                }

                                return $actionBtn;
                            })
                            ->rawColumns(['action','permission'])
                            ->make(true);
        }
        return view('dashboardPages.users.index');
    }

    public function new_user(Request $request){
        $roles = Role::where('name','!=','admin')->get();
        $districts=District::all();
        
        return view('dashboardPages.users.new_user',compact('roles','districts'));
    }

    public function add_new_user(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'pno_number' => 'required|digits:9|unique:users,pno_number',
            'dob' => 'required',
            'contact_number' => 'required|unique:users,contact_number',
            'district' => 'required',
            'role' => 'required',
            'father_name' => 'required',
            'caste' => 'required',
            'joining_date' => 'required',
            'home_town' => 'required',
            'reserve_driver_joining_date' => 'required',
            'main_reserve_driver_joining_date' => 'required',
            'current_distrtict_joining_date' => 'required',
            'profile_image' => 'mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $profile_image='';

        if (!is_null($request->file('profile_image')) && $request->file('profile_image')->isValid()) {
            $profile_image = time() . '_' . $request->pno_number.".".$request->file('profile_image')->getClientOriginalExtension(); 

            $path = $request->file('profile_image')->storeAs('public/profile_image', $profile_image);
        }

        $faker = Faker::create();

        $user = new User();
        $user->name = $request->name;
        $user->pno_number = $request->pno_number;
        $user->dob = date('Y-m-d',strtotime($request->dob));
        $user->district = $request->district;
        $user->contact_number = $request->contact_number;
        $user->photo=$profile_image;
        $user->email = $faker->unique()->safeEmail;
        $user->father_name = $request->father_name;
        $user->caste = $request->caste;
        $user->joining_date = date('Y-m-d',strtotime($request->joining_date));
        $user->home_town = $request->home_town;
        $user->reserve_driver_joining_date = date('Y-m-d',strtotime($request->reserve_driver_joining_date));
        $user->main_reserve_driver_joining_date = date('Y-m-d',strtotime($request->main_reserve_driver_joining_date));
        $user->current_distrtict_joining_date = date('Y-m-d',strtotime($request->current_distrtict_joining_date));
        $user->other_comment = $request->other_comments;
        $user->password = '';
        $user->save();

        //assign role to the user
        $user->assignRole($request->role);

        return redirect()->route('all_users')->with('message', 'User added successfully');
    }

    public function edit_user(Request $request){
        try{
            $roles = Role::where('name','!=','admin')->get();
                
            $districts=District::all();

            $user_info=User::where('id',Crypt::decryptString($request->user_id))->first();

            return view('dashboardPages.users.edit_user',compact('roles','districts','user_info'));
        }
        catch(\Exception $e){
            abort(404);
        }
    }

    public function update_user(Request $request){
        $user_id=Crypt::decryptString($request->user_id);
        
        $validated = $request->validate([
            'name' => 'required',
            'pno_number' => 'required|digits:9|unique:users,pno_number,'.$user_id,
            'dob' => 'required',
            'contact_number' => 'required|unique:users,contact_number,'.$user_id,
            'district' => 'required',
            'role' => 'required',
            'profile_image' => 'mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $profile_image='';

        if (!is_null($request->file('profile_image')) && $request->file('profile_image')->isValid()) {
            $old_profile_image=User::where('id',$user_id)->value('photo');

            $filePath = 'public/profile_image/'.$old_profile_image; 
            $fullPath = Storage::path($filePath);
            
            if (file_exists($fullPath)) {
                Storage::disk('public')->delete('profile_image/' .$old_profile_image);
            }

            $profile_image = time() . '_' . $request->pno_number.".".$request->file('profile_image')->getClientOriginalExtension(); 

            $path = $request->file('profile_image')->storeAs('public/profile_image', $profile_image);
        }

        $user = User::find(Crypt::decryptString($request->user_id));
        $user->name = $request->name;
        $user->pno_number = $request->pno_number;
        $user->dob = date('Y-m-d',strtotime($request->dob));
        $user->district = $request->district;
        $user->contact_number = $request->contact_number;
        $user->father_name = $request->father_name;
        $user->caste = $request->caste;
        $user->joining_date = date('Y-m-d',strtotime($request->joining_date));
        $user->home_town = $request->home_town;
        $user->reserve_driver_joining_date = date('Y-m-d',strtotime($request->reserve_driver_joining_date));
        $user->main_reserve_driver_joining_date = date('Y-m-d',strtotime($request->main_reserve_driver_joining_date));
        $user->current_distrtict_joining_date = date('Y-m-d',strtotime($request->current_distrtict_joining_date));
        $user->other_comment = $request->other_comments;

        if($profile_image!=''){
            $user->photo = $profile_image;
        }

        $user->update();

        //assign role to the user
        $user->roles()->detach();
        $user->assignRole($request->role);
        $user->save();

        return redirect()->route('all_users')->with('message', 'User information updated successfully');
    }

    public function remove_user(Request $request){
        if ($request->ajax()) {
            $old_profile_image=User::where('id',Crypt::decryptString($request->user_id))->value('photo');

            $filePath = 'public/profile_image/'.$old_profile_image; 
            $fullPath = Storage::path($filePath);
            
            if (file_exists($fullPath)) {
                Storage::disk('public')->delete('profile_image/' .$old_profile_image);
            }

            User::where('id',Crypt::decryptString($request->user_id))->delete();

            return true;
        }
    }

    public function update_user_status(Request $request){
        if ($request->ajax()) {
            $user=User::find(Crypt::decryptString($request->user_id));
            $user->status=$request->user_status;
            $user->update();

            return true;
        }
    }

    public function user_vehicle_history(Request $request){
        if ($request->ajax()) {
            $assigned_vehicles=AssignedVehicle::where('user_id','!=',1);
            return Datatables::of($assigned_vehicles)
                            ->addColumn('user_name', function($row){
                                return getUserName($row->user_id);
                            })
                            ->addColumn('pno_number', function($row){
                                return getUserPnoNumber($row->user_id);
                            })
                            ->addColumn('vehicle_number', function($row){
                                return getVehicleRegstrationId($row->vehicle_id);
                            })
                            ->addColumn('assigned_on', function($row){
                                return date('F d, Y',strtotime($row->assigned_on));
                            })
                            ->addColumn('release_date', function($row){
                                if(!is_null($row->released_on)){
                                    return date('F d, Y',strtotime($row->released_on));
                                }
                                else{
                                    return 'NA';
                                }
                            })
                            ->filterColumn('user_name', function ($query, $keyword) {
                                $query->whereHas('user', function ($subQuery) use ($keyword) {
                                    $subQuery->where('name', 'like', '%' . $keyword . '%');
                                });
                            })
                            ->filterColumn('pno_number', function ($query, $keyword) {
                                $query->whereHas('user', function ($subQuery) use ($keyword) {
                                    $subQuery->where('pno_number', 'like', '%' . $keyword . '%');
                                });
                            })
                            ->filterColumn('vehicle_number', function ($query, $keyword) {
                                $query->whereHas('vehicle', function ($subQuery) use ($keyword) {
                                    $subQuery->where('registration_number', 'like', '%' . $keyword . '%');
                                });
                            })
                            ->make(true);
        }

        return view('dashboardPages.users.user_vehicle_history');
    }

    public function assign_vehicle(Request $request){
        $users_list = User::where('users.id', '!=', 1)
                        ->leftJoin('assigned_vehicles', 'users.id', '=', 'assigned_vehicles.user_id')
                        ->select('users.*')
                        ->where(function ($query) {
                            $query->whereNull('assigned_vehicles.user_id') 
                                ->orWhereNotNull('assigned_vehicles.released_on'); 
                        })
                        ->get();

        $vehicles_list = vehicle::where('vehicles.id', '!=', 1)
                                ->select('vehicles.*')
                                ->leftJoin('assigned_vehicles', 'vehicles.id', '=', 'assigned_vehicles.vehicle_id')
                                ->where(function ($query) {
                                    $query->whereNull('assigned_vehicles.vehicle_id') 
                                        ->orWhereNotNull('assigned_vehicles.released_on'); 
                                })
                                ->get();

        return view('dashboardPages.users.assign_vehicle',compact('users_list','vehicles_list'));
    }

    public function allocate_vehicle(Request $request){
        $validated = $request->validate([
            'user' => 'required',
            'registration_number' => 'required'
        ]);

        if(AssignedVehicle::where('vehicle_id',$request->registration_number)->where('user_id',$request->user)->exists()){

            $assigned_vehicle_id=AssignedVehicle::where('vehicle_id',$request->registration_number)->where('user_id',$request->user)->value('id');

            $assigned_vehicle=AssignedVehicle::find($assigned_vehicle_id);
            $assigned_vehicle->released_on=date('Y-m-d');
            $assigned_vehicle->update();
        }

        $assigned_vehicle=new AssignedVehicle;
        $assigned_vehicle->vehicle_id=$request->registration_number;
        $assigned_vehicle->user_id=$request->user;
        $assigned_vehicle->assigned_on=date('Y-m-d');
        $assigned_vehicle->save();

        return redirect()->route('user_assign_vehicle')->with('message', 'Vehicle assigned successfully');
    }

    public function user_assign_vehicle(Request $request){
        if ($request->ajax()) {
            $assigned_vehicles=AssignedVehicle::whereNull('released_on')->where('user_id','!=',1);
            return Datatables::of($assigned_vehicles)
                            ->addColumn('user_name', function($row){
                                return getUserName($row->user_id);
                            })
                            ->addColumn('vehicle_number', function($row){
                                return getVehicleRegstrationId($row->vehicle_id);
                            })
                            ->addColumn('assigned_on', function($row){
                                return date('F d, Y',strtotime($row->assigned_on));
                            })
                            ->addColumn('action', function($row){
                                $actionBtn = '<a href="'.route('edit_assign_vehicle', ['assigned_id' => Crypt::encryptString($row->id)]).'" class="edit btn btn-success btn-sm">Edit</a>';

                                return $actionBtn;
                            })
                            ->rawColumns(['action','permission'])
                            ->make(true);
        }

        return view('dashboardPages.users.user_assign_vehicle');
    }

    public function edit_assign_vehicle(Request $request){
        try{
            $users_list=User::where('users.id','!=',1)->get();
            
            $encryptedAssignedId=$request->assigned_id;

            //$vehicles_list=vehicle::where('id','!=',1)->get();
            $vehicleId=Crypt::decryptString($request->assigned_id);

            $vehicles_list = Vehicle::where('vehicles.id', '!=', 1)
                                    ->select('vehicles.*')
                                    ->leftJoin('assigned_vehicles', 'vehicles.id', '=', 'assigned_vehicles.vehicle_id')
                                    ->where(function ($query) use ($vehicleId) {
                                        $query->whereNull('assigned_vehicles.vehicle_id') 
                                            ->orWhereNotNull('assigned_vehicles.released_on') 
                                            ->orWhere('assigned_vehicles.id', $vehicleId); 
                                    })
                                    ->get();

            $assigned_vehicle_info=AssignedVehicle::where('id',Crypt::decryptString($request->assigned_id))->first();
        
            return view('dashboardPages.users.edit_assign_vehicle',compact('users_list','vehicles_list','assigned_vehicle_info','encryptedAssignedId'));
        }
        catch(\Exception $e){
            abort(404);
        }
    }

    public function update_assigned_vehicle(Request $request){
        $validated = $request->validate([
            'registration_number' => 'required'
        ]);

        $assigned_vehicle=AssignedVehicle::find(Crypt::decryptString($request->assigned_vehicle_id));

        $assigned_vehicle->vehicle_id=$request->registration_number;

        $assigned_vehicle->update();

        return redirect()->route('user_assign_vehicle')->with('message', 'Vehicle assigned successfully');
    }

    public function assign_task(Request $request){
        if ($request->ajax()) {
            $assigned_tasks=AssignTask::orderBy('id', 'DESC');
            return Datatables::of($assigned_tasks)
                            ->addColumn('user_name', function($row){
                                return getUserName($row->user_id);
                            })
                            ->addColumn('assigned_on', function($row){
                                return date('F d, Y',strtotime($row->assigned_on));
                            })
                            ->addColumn('status', function($row){
                                return ($row->status==1) ? 'Active' : 'InActive';
                            })
                            ->addColumn('action', function($row){
                                $actionBtn = '';
                                
                                if(auth()->user()->can('Edit Assigned Tasks')){
                                    $actionBtn=' <a href="'.route('edit_task', ['task_id' => Crypt::encryptString($row->id)]).'" class="edit btn btn-success btn-sm">Edit</a>';

                                    if($row->status==1){
                                        $actionBtn .= '&nbsp;<a href="javascript:void(0)" class="update_status btn btn-danger btn-sm" data-id="'.Crypt::encryptString($row->id).'" data-status="0">DeActivate</a>';
                                    }
                                    else{
                                        $actionBtn .= '&nbsp;<a href="javascript:void(0)" class="update_status btn btn-success btn-sm" data-id="'.Crypt::encryptString($row->id).'" data-status="1">Activate</a>';
                                    }
                                }
                                
                                return $actionBtn;
                            })
                            ->filterColumn('user_name', function ($query, $keyword) {
                                $query->whereHas('user', function ($subQuery) use ($keyword) {
                                    $subQuery->where('name', 'like', '%' . $keyword . '%');
                                });
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }

        return view('dashboardPages.users.assign_task');
    }

    public function create_task(Request $request){
        $validated = $request->validate([
            'user' => 'required',
            'assined_on' => 'required',
            'task' => 'required',
            'description' => 'required'
        ]);

        $assigned_task=new AssignTask;
        $assigned_task->user_id=$request->user;
        $assigned_task->assigned_on=date('Y-m-d',strtotime($request->assined_on));
        $assigned_task->task_title=$request->task;
        $assigned_task->task_description=$request->description;
        $assigned_task->save();

        return redirect()->route('assign_task')->with('message', 'Task assigned successfully');
    }

    public function get_searched_users(Request $request){
        if ($request->ajax()) {
            $users = User::whereRaw('LOWER(name) like ?', [strtolower($request->q) . '%'])->get();
            
            $items=[];

            foreach($users as $key=>$val){
                $items[$key]['id']=$val->id;
                $items[$key]['text']=$val->name;
            }

            $data['items']=$items;

            return json_encode($data);
        }
    }

    public function add_task(Request $request){
        $users=User::where('id','!=',1)->orderBy('name', 'ASC')->offset(0)->limit(10)->get();
        return view('dashboardPages.users.add_task',compact('users'));
    }

    public function edit_task(Request $request){
        $assigned_task_detail=AssignTask::find(Crypt::decryptString($request->task_id));

        $users=User::where('id','!=',1)->orderBy('name', 'ASC')->offset(0)->limit(10)->get();

        if(!$users->contains('id',$assigned_task_detail->user_id)){
            $additionalUser = User::where('id', $assigned_task_detail->user_id)->first();
            $users = collect([$additionalUser])->merge($users);
        }

        return view('dashboardPages.users.edit_task',compact('assigned_task_detail','users'));
    }

    public function update_task(Request $request){
        $validated = $request->validate([
            'user' => 'required',
            'assined_on' => 'required',
            'task' => 'required',
            'description' => 'required'
        ]);

        $assigned_task=AssignTask::find(Crypt::decryptString($request->task_id));
        $assigned_task->user_id=$request->user;
        $assigned_task->assigned_on=date('Y-m-d',strtotime($request->assined_on));
        $assigned_task->task_title=$request->task;
        $assigned_task->task_description=$request->description;
        $assigned_task->update();

        return redirect()->route('assign_task')->with('message', 'Task updated successfully');
    }

    public function update_task_status(Request $request){
        if ($request->ajax()) {
            $assigned_task=AssignTask::find(Crypt::decryptString($request->task_id));
            $assigned_task->status=$request->task_status;
            $assigned_task->update();

            return true;
        }
    }

    public function user_transfer(Request $request){
        if ($request->ajax()) {
            $user_transfer=UserTransfer::orderBy('id', 'DESC');
            return Datatables::of($user_transfer)
                    ->addColumn('user_name', function($row){
                        return getUserName($row->user_id);
                    })
                    ->addColumn('district', function($row){
                        return getDistrictName($row->district_id);
                    })
                    ->addColumn('transferred_on', function($row){
                        return date('F d, Y',strtotime($row->transferred_on));
                    })
                    ->addColumn('action', function($row){
                        $actionBtn = '';
                        
                        if(auth()->user()->can('Edit User Transfer')){
                            $actionBtn=' <a href="'.route('edit_user_transfer', ['transfer_id' => Crypt::encryptString($row->id)]).'" class="edit btn btn-success btn-sm">Edit</a>';
                        }

                        return $actionBtn;
                    })
                    ->filterColumn('user_name', function ($query, $keyword) {
                        $query->whereHas('user', function ($subQuery) use ($keyword) {
                            $subQuery->where('name', 'like', '%' . $keyword . '%');
                        });
                    })
                    ->filterColumn('district', function ($query, $keyword) {
                        $query->whereHas('district', function ($subQuery) use ($keyword) {
                            $subQuery->where('district', 'like', '%' . $keyword . '%');
                        });
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('dashboardPages.users.user_transfer');
    }

    public function add_user_transfer(Request $request){
        $users=User::where('id','!=',1)->orderBy('name', 'ASC')->offset(0)->limit(10)->get();

        $districts=District::get();

        return view('dashboardPages.users.add_user_transfer',compact('users','districts'));
    }

    public function create_user_transfer(Request $request){
        $validated = $request->validate([
            'user' => 'required',
            'district' => 'required',
            'transferred_on' => 'required'
        ]);

        $user_transfer=new UserTransfer;
        $user_transfer->user_id=$request->user;
        $user_transfer->district_id=$request->district;
        $user_transfer->transferred_on=date('Y-m-d',strtotime($request->transferred_on));
        $user_transfer->save();

        return redirect()->route('user_transfer')->with('message', 'User transfer added successfully');
    }

    public function edit_user_transfer(Request $request){
        try{
            $transferred_user_detail=UserTransfer::find(Crypt::decryptString($request->transfer_id));

            $users=User::where('id','!=',1)->orderBy('name', 'ASC')->offset(0)->limit(10)->get();
            
            if(!$users->contains('id',$transferred_user_detail->user_id)){
                $additionalUser = User::where('id', $transferred_user_detail->user_id)->first();
                $users = collect([$additionalUser])->merge($users);
            }

            $districts=District::get();
            
            return view('dashboardPages.users.edit_user_transfer',compact('transferred_user_detail','users','districts'));
        }
        catch(\Exception $e){
            abort(404);
        }
    }

    public function update_user_transfer(Request $request){
        $validated = $request->validate([
            'user' => 'required',
            'district' => 'required',
            'transferred_on' => 'required'
        ]);

        $user_transfer=UserTransfer::find(Crypt::decryptString($request->transfer_id));
        $user_transfer->user_id=$request->user;
        $user_transfer->district_id=$request->district;
        $user_transfer->transferred_on=date('Y-m-d',strtotime($request->transferred_on));
        $user_transfer->update();

        return redirect()->route('user_transfer')->with('message', 'User transfer added successfully');
    }

    public function user_profile(Request $request){
        $districts=District::all();
        return view('dashboardPages.users.user_profile',compact('districts'));
    }

    public function update_user_profile(Request $request){
        $user_id=Auth()->user()->id;
        
        $validated = $request->validate([
            'name' => 'required',
            'pno_number' => 'required|digits:9|unique:users,pno_number,'.$user_id,
            'dob' => 'required',
            'contact_number' => 'required',
            'district' => 'required',
            'profile_image' => 'mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $profile_image='';

        if (!is_null($request->file('profile_image')) && $request->file('profile_image')->isValid()) {
            $old_profile_image=User::where('id',$user_id)->value('photo');

            $filePath = 'public/profile_image/'.$old_profile_image; 
            $fullPath = Storage::path($filePath);
            
            if (file_exists($fullPath)) {
                Storage::disk('public')->delete('profile_image/' .$old_profile_image);
            }

            $profile_image = time() . '_' . $request->pno_number.".".$request->file('profile_image')->getClientOriginalExtension(); 

            $path = $request->file('profile_image')->storeAs('public/profile_image', $profile_image);
        }

        $user = User::find($user_id);
        $user->name = $request->name;
        $user->pno_number = $request->pno_number;
        $user->dob = date('Y-m-d',strtotime($request->dob));
        $user->district = $request->district;
        $user->contact_number = $request->contact_number;

        if($profile_image!=''){
            $user->photo = $profile_image;
        }

        $user->update();

        return redirect()->route('dashboard')->with('message', 'Profile information updated successfully');
    }

}
