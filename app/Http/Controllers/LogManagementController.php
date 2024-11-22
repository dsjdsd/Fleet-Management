<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vehicle;
use App\Models\User;
use App\Models\AssignedVehicle;
use App\Models\LogManagements;
use DataTables;
use Illuminate\Support\Facades\Crypt;

class LogManagementController extends Controller
{
    public function log_management(Request $request){

        if ($request->ajax()) {
            $query = LogManagements::join('vehicles', 'log_managements.vehicle_id', '=', 'vehicles.id')
            ->join('users', 'log_managements.driver_id', '=', 'users.id')
            ->select('log_managements.*','vehicles.registration_number','users.name')
            ->orderBy('log_managements.id', 'desc') 
            ->get();
            foreach ($query as $row) {
                // Change the date format
                $row->log_date = date('d-M-Y', strtotime($row->log_date));
            }
            return DataTables::of($query)
              ->addColumn('action', function ($row) {
                if(auth()->user()->can('Edit Car Log Book')){
                    $actionBtn='<a href="'.route('edit_log', ['add_log_id' => Crypt::encryptString($row->id)]).'" class="btn btn-success">Edit</a>';
                }
                if(auth()->user()->can('Delete Car Log Book')){
                    $actionBtn .= '<a href="javascript:void(0)" class="delete btn btn-danger" data-id="'.Crypt::encryptString($row->id).'">Delete</a>';
                }
                return $actionBtn;
              })
              ->rawColumns(['action'])
              ->make(true);
        }
        return view('dashboardPages.carLog.log_management');
    }
    public function add_log(){
        $data['vehicles'] = Vehicle::where('is_disposed', 0) ->orderBy('id', 'desc') ->select('id', 'registration_number') ->limit(10) ->get();        
        $data['drivers'] = User::where('id','!=',1)->get();
        return view('dashboardPages.carLog.add_log',$data);
    }
    public function edit_log($add_log_id){
        $add_log_id = Crypt::decryptString($add_log_id);
        $vehicles = Vehicle::where('is_disposed', 0) ->orderBy('id', 'desc') ->select('id', 'registration_number') ->limit(10) ->get();
        $data['drivers'] = User::where('id','!=',1)->get();
        $query = LogManagements::join('users', 'log_managements.driver_id', '=', 'users.id')
            ->select('log_managements.*','users.name')
            ->where('log_managements.id',$add_log_id) 
            ->first();
        if(!$vehicles->contains('id',$query->vehicle_id)){
            $additionalVehicle = vehicle::where('id', $query->vehicle_id)->first();
            $vehicles = collect([$additionalVehicle])->merge($vehicles);
        }
        $data['vehicles']=$vehicles;
        $data['log_management'] = $query;

        return view('dashboardPages.carLog.edit_log',$data);
    }
    public function get_vehicle_wise_driver(Request $request){
        $data = [];
        $query = AssignedVehicle::join('users', 'users.id', '=', 'assigned_vehicles.user_id')
        ->where('assigned_vehicles.vehicle_id',$request->vehicle_id)
        ->where('assigned_vehicles.released_on',$request->released_on)
        ->select('users.id as user_id','users.name')
        ->first();
        if($query){
            $data['user_id'] = $query->user_id;
            $data['name'] = $query->name;
        }
        return $data;
    }
    public function create_log(Request $request){
        $validation = [];
        $validation['vehicle_id'] ='required'; 
        $validation['driver_id'] ='required'; 
        $validation['log_date'] ='required'; 
        $validation['from'] ='required'; 
        $validation['to'] ='required'; 
        $validation['distance'] ='required'; 
        $validation['fuel'] ='required'; 
        $validation['comment'] ='required';
        $request->validate($validation);
        if($request->add_log_id){
            $LogManagement =  LogManagements::find($request->add_log_id);
            $LogManagement->vehicle_id = $request->vehicle_id;
            $LogManagement->driver_id = $request->driver_id;
            $LogManagement->log_date = date('Y-m-d',strtotime($request->log_date));
            $LogManagement->from = $request->from;
            $LogManagement->to = $request->to;
            $LogManagement->distance = $request->distance;
            $LogManagement->fuel = $request->fuel;
            $LogManagement->comment = $request->comment;
            $LogManagement->save();
            return redirect()->route('log_management')->with('message', 'Add Log updated successfully');

        }
        else{
            $LogManagement = new LogManagements();
            $LogManagement->vehicle_id = $request->vehicle_id;
            $LogManagement->driver_id = $request->driver_id;
            $LogManagement->log_date = date('Y-m-d',strtotime($request->log_date));
            $LogManagement->from = $request->from;
            $LogManagement->to = $request->to;
            $LogManagement->distance = $request->distance;
            $LogManagement->fuel = $request->fuel;
            $LogManagement->comment = $request->comment;
            $LogManagement->save();
            return redirect()->route('log_management')->with('message', 'Add Log added successfully');
        }
    }
    public function remove_log(Request $request){
        if ($request->ajax()) {
            LogManagements::where('id',Crypt::decryptString($request->add_log_id))->delete();
            return true;
        }
    }
}
