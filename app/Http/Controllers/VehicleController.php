<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Crypt;
use App\Models\VehicleMake;
use App\Models\District;
use App\Models\VehicleColor;
use App\Models\vehicle;
use App\Models\vehicle_detail;
use App\Models\VehicleDeployment;
use App\Models\Zone;
use App\Models\Range;
use App\Models\VehicleTransfer;


class VehicleController extends Controller {
    public function make(Request $request){
        if ($request->ajax()) {
            $make=VehicleMake::orderBy('id', 'DESC');

            return Datatables::of($make)
                            ->addColumn('special_purpose_vehicle', function($row){
                                return (!empty($row->special_purpose_vehicle) && !is_null($row->special_purpose_vehicle)) ? $row->special_purpose_vehicle : 'NA';
                            })
                            ->addColumn('action', function($row){
                                $actionBtn = '';
                                
                                if(auth()->user()->can('Edit Model/Make')){
                                    $actionBtn='<a href="'.route('edit_make', ['make_id' => Crypt::encryptString($row->id)]).'" class="edit btn btn-success btn-sm">Edit</a>';
                                }
                                
                                if(auth()->user()->can('Remove Model/Make')){
                                    $actionBtn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="'.Crypt::encryptString($row->id).'">Delete</a>';
                                }

                                return $actionBtn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }

        return view('dashboardPages.vehicles.make');
    }

    public function new_make(){
        return view('dashboardPages.vehicles.new_make');
    }

    public function update_make(Request $request){
        $validated = $request->validate([
            'make' => 'required',
            'vehicle_type' => 'required',
            'special_purpose_vehicles' => 'required_if:vehicle_type,Special Purpose Vehicles',
        ]);
        
        $make = VehicleMake::find(Crypt::decryptString($request->make_id));
        $make->make=$request->make;
        $make->vehicle_type=$request->vehicle_type;
        $make->special_purpose_vehicle=$request->special_purpose_vehicles;
        $make->update();

        return redirect()->route('make')->with('message', 'Make updated successfully');
    }

    public function edit_make(Request $request){
        $make_id=$request->make_id;
        $make=VehicleMake::where('id',Crypt::decryptString($request->make_id))->first();
        
        return view('dashboardPages.vehicles.edit_make',compact('make','make_id'));
    }

    public function create_make(Request $request){
        $validated = $request->validate([
            'make' => 'required',
            'vehicle_type' => 'required',
            'special_purpose_vehicles' => 'required_if:vehicle_type,Special Purpose Vehicles'
        ]);
        
        $vehicle=new VehicleMake;
        $vehicle->make=$request->make;
        $vehicle->vehicle_type=$request->vehicle_type;
        $vehicle->special_purpose_vehicle=$request->special_purpose_vehicles;
        $vehicle->save();

        return redirect()->route('make')->with('message', 'Make created successfully');
    }

    public function remove_make(Request $request){
        if ($request->ajax()) {
            VehicleMake::where('id',Crypt::decryptString($request->make_id))->delete();

            return true;
        }
    }

    public function vehicle_color(Request $request){
        return view('dashboardPages.vehicles.vehicle_color');
    }

    public function create_vehicle(){
        $data['vehicle_make'] = VehicleMake::get();
        $data['districts'] = District::get();
        $data['vehicle_colors'] = VehicleColor::get();
        return view('dashboardPages.vehicles.new-vehicle',$data);
    }
    public function new_vehicle(Request $request){
        
        $validation = [];
        $validation['registration_number'] ='required'; 
        $validation['upp_number'] ='required'; 
        $validation['chasis_number'] ='required'; 
        $validation['engine_number'] ='required'; 
        $validation['vehicle_make'] ='required'; 
        $validation['vehicle_color'] ='required'; 
        $validation['vehicle_district'] ='required'; 
        $validation['total_run_km_till_date'] ='required'; 
        $validation['attached_for_duty'] ='required'; 
        $validation['vehicle_condition'] ='required'; 
        $validation['total_repair_cost'] ='required'; 
        $validation['monthly_fuel_quota'] ='required'; 
        $validation['petro_card_number'] ='required'; 
        $validation['phq_logistics_order_no'] ='required'; 
        $validation['date_of_allotment'] ='required'; 
        $request->validate($validation);
        if($request->id){
            $vehicles = vehicle::find($request->id);
            $vehicle_details = vehicle_detail::where('vehicle_id',$request->id)->first();
            $vehicles['registration_number'] = $request->registration_number;
            $vehicles['upp_number'] = $request->upp_number;
            $vehicles['chasis_number'] = $request->chasis_number;
            $vehicles['engine_number'] = $request->engine_number;
            $vehicles['vehicle_make'] = $request->vehicle_make;
            $vehicles['vehicle_color'] = $request->vehicle_color;
            $vehicles['petro_card_number'] = $request->petro_card_number;
            $vehicles['phq_logistics_order_no'] = $request->phq_logistics_order_no;
            $vehicles['date_of_allotment'] = date('Y-m-d', strtotime($request->date_of_allotment));
            $vehicles->save();
            $vehicle_details['vehicle_district'] = $request->vehicle_district;
            $vehicle_details['total_run_km_till_date'] = $request->total_run_km_till_date;
            $vehicle_details['attached_for_duty'] = $request->attached_for_duty;
            $vehicle_details['vehicle_condition'] = $request->vehicle_condition;
            $vehicle_details['total_repair_cost'] = $request->total_repair_cost;
            $vehicle_details['monthly_fuel_quota'] = $request->monthly_fuel_quota;
            $vehicle_details->save();
            return redirect()->route('vehicles')->with('message', 'Vehicle updated successfully');
        }else{
            $vehicles = new vehicle();
            $vehicle_details = new vehicle_detail();
            $vehicles['registration_number'] = $request->registration_number;
            $vehicles['upp_number'] = $request->upp_number;
            $vehicles['chasis_number'] = $request->chasis_number;
            $vehicles['engine_number'] = $request->engine_number;
            $vehicles['vehicle_make'] = $request->vehicle_make;
            $vehicles['vehicle_color'] = $request->vehicle_color;
            $vehicles['petro_card_number'] = $request->petro_card_number;
            $vehicles['phq_logistics_order_no'] = $request->phq_logistics_order_no;
            $vehicles['date_of_allotment'] = date('Y-m-d', strtotime($request->date_of_allotment));
            $vehicles->save();
            $vehicle_details['vehicle_id'] = $vehicles->id;
            $vehicle_details['vehicle_district'] = $request->vehicle_district;
            $vehicle_details['total_run_km_till_date'] = $request->total_run_km_till_date;
            $vehicle_details['attached_for_duty'] = $request->attached_for_duty;
            $vehicle_details['vehicle_condition'] = $request->vehicle_condition;
            $vehicle_details['total_repair_cost'] = $request->total_repair_cost;
            $vehicle_details['monthly_fuel_quota'] = $request->monthly_fuel_quota;
            $vehicle_details->save();
            return redirect()->route('vehicles')->with('message', 'Vehicle added successfully');
        }
    }
    public function vehicles(Request $request){
        if ($request->ajax()) {
            $query = Vehicle::leftJoin('vehicle_details', 'vehicles.id', '=', 'vehicle_details.vehicle_id')
            ->leftJoin('districts', 'vehicle_details.vehicle_district', '=', 'districts.id')
            ->select('vehicles.id', 'vehicles.registration_number', 'vehicles.upp_number', 'vehicles.chasis_number', 'vehicles.engine_number', 'vehicle_details.total_run_km_till_date', 'vehicle_details.attached_for_duty', 'vehicle_details.vehicle_condition', 'vehicle_details.total_repair_cost', 'vehicle_details.monthly_fuel_quota', 'districts.district', 'vehicles.vehicle_make')
            ->where('vehicles.is_disposed', 0)
            ->orderBy('vehicles.id', 'desc')
            ->get();
            foreach ($query as $row) {
                $row->registration_number =  $this->checkVal($row->registration_number);
                $row->upp_number =  $this->checkVal($row->upp_number);
                $row->chasis_number =  $this->checkVal($row->chasis_number);
                $row->engine_number =  $this->checkVal($row->engine_number);
                $row->district =  $this->checkVal($row->district);
            }       
            return DataTables::of($query)
                ->addColumn('action', function ($row) {
                    if(auth()->user()->can('Dispose Vehicle')){
                        $actionBtn='<a href="'.route('disposed', ['vehicle_id' => Crypt::encryptString($row->id)]).'" class="btn btn-danger">Dispose</a>';
                    }
                    if(auth()->user()->can('Edit Vehicle')){
                        $actionBtn .='<a href="'.route('edit_vehicle', ['vehicle_id' => Crypt::encryptString($row->id)]).'" class="btn btn-success">Edit</a>';
                    }

                    if(auth()->user()->can('Remove Vehicle')){
                        $actionBtn .= '<a href="javascript:void(0)" class="delete btn btn-danger" data-id="'.Crypt::encryptString($row->id).'">Delete</a>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboardPages.vehicles.vehicles');
    }
    public function edit_vehicle($vehicle_id){
        $data['vehicle_make'] = VehicleMake::get();
        $data['districts'] = District::get();
        $query = Vehicle::leftJoin('vehicle_details', 'vehicles.id', '=', 'vehicle_details.vehicle_id')
            ->select('vehicles.*','vehicle_details.vehicle_district','vehicle_details.total_run_km_till_date','vehicle_details.attached_for_duty','vehicle_details.vehicle_condition','vehicle_details.total_repair_cost','vehicle_details.monthly_fuel_quota','vehicles.petro_card_number','vehicles.date_of_allotment','vehicles.phq_logistics_order_no')
            ->where('vehicles.id',Crypt::decryptString($vehicle_id))
            ->first();
        $data['vehicle'] = $query;
        return view('dashboardPages.vehicles.edit-vehicle',$data);
    }
    public function remove_vehicle(Request $request){
        if ($request->ajax()) {
            Vehicle::where('id',Crypt::decryptString($request->vehicle_id))->delete();
            return true;
        }
    }
    public function disposed($vehicle_id){
        $vehicle_id = Crypt::decryptString($vehicle_id);
        $vehicles = vehicle::find($vehicle_id);
        $vehicles->is_disposed=1;
        $vehicles->dispose_date=date('Y-m-d');
        $vehicles->dispose_by=auth()->user()->id;
        $vehicles->save();
        return redirect()->route('vehicles')->with('message', 'Vehicle has been disposed.');
    }
    public function vehicle_deployement_list(Request $request){
        if ($request->ajax()) {
            
        $query = VehicleDeployment::join('vehicles', 'vehicle_deployments.vehicle_id', '=', 'vehicles.id')
        ->join('districts', 'vehicle_deployments.deployed_district_id', '=', 'districts.id')
        ->join('users', 'vehicle_deployments.added_by', '=', 'users.id')
        ->select('vehicle_deployments.*','vehicles.registration_number','districts.district','users.name')
        ->orderBy('vehicle_deployments.id', 'desc')->get();    
          return DataTables::of($query)
              ->addColumn('action', function ($row) {
                $actionBtn="";
                if(auth()->user()->can('Edit Vehicle Deployment')){
                    $actionBtn.='<a href="'.route('edit_vehicle_deployement', ['vehicle_deployed_id' => Crypt::encryptString($row->id)]).'" class="btn btn-success">Edit</a>';
                }
                return $actionBtn;
              })
              ->rawColumns(['action'])
              ->make(true);
    }
    return view('dashboardPages.vehicles.vehicle_deployement_list');
    }
    public function add_vehicle_deployement(){
        $data['vehicles'] = Vehicle::where('is_disposed', 0) ->orderBy('id', 'desc') ->select('id', 'registration_number') ->limit(10) ->get();        
        $data['districts'] = District::get();
        return view('dashboardPages.vehicles.add_vehicle_deployement',$data);
    }
    public function create_vehicle_deployement(Request $request){

        $validation = [];
        $validation['vehicle_id'] ='required'; 
        $validation['deployed_district_id'] ='required'; 
        $validation['deployed_date'] ='required'; 
        $request->validate($validation);
        if($request->vehicle_deployement_id){
            $VehicleDeployment = VehicleDeployment::find($request->vehicle_deployement_id);
            $VehicleDeployment['vehicle_id'] = $request->vehicle_id;
            $VehicleDeployment['deployed_district_id'] = $request->deployed_district_id;
            $VehicleDeployment['deployed_date'] = date('Y-m-d',strtotime($request->deployed_date));
            $VehicleDeployment->save();
            return redirect()->route('vehicle_deployement_list')->with('message', 'Vehicle Deployed updated successfully.');
        }else{
            $VehicleDeployment = new VehicleDeployment();
            $VehicleDeployment['vehicle_id'] = $request->vehicle_id;
            $VehicleDeployment['deployed_district_id'] = $request->deployed_district_id;
            $VehicleDeployment['added_by'] = auth()->user()->id;
            $VehicleDeployment['deployed_date'] = date('Y-m-d',strtotime($request->deployed_date));
            $VehicleDeployment->save();
            return redirect()->route('vehicle_deployement_list')->with('message', 'Vehicle Deployed added successfully.');
        }
    }
    public function edit_vehicle_deployement($vehicle_deployed_id){
        $vehicles = Vehicle::where('is_disposed', 0) ->orderBy('id', 'desc') ->select('id', 'registration_number') ->limit(10) ->get();
        $data['districts'] = District::get();
        $query = VehicleDeployment::join('vehicles', 'vehicle_deployments.vehicle_id', '=', 'vehicles.id')
        ->join('districts', 'vehicle_deployments.deployed_district_id', '=', 'districts.id')
        ->select('vehicle_deployments.*','vehicles.registration_number','districts.district')
        ->where('vehicle_deployments.id',Crypt::decryptString($vehicle_deployed_id))->first();
        if(!$vehicles->contains('id',$query->vehicle_id)){
            $additionalVehicle = vehicle::where('id', $query->vehicle_id)->first();
            $vehicles = collect([$additionalVehicle])->merge($vehicles);
        }
        $data['vehicles']=$vehicles;
        $data['vehicle_deployment'] = $query;
        return view('dashboardPages.vehicles.edit_vehicle_deployement',$data);
    }
    public function dispose_vehicle_list(Request $request){
        if ($request->ajax()) {
                $query = Vehicle::leftJoin('users', 'vehicles.dispose_by', '=', 'users.id')
                ->where('vehicles.is_disposed',1)->select('vehicles.registration_number','vehicles.date_of_allotment','vehicles.vehicle_make','vehicles.dispose_date','users.name')
                ->orderBy('vehicles.id', 'desc') 
                ->get();
            return DataTables::of($query)->make(true);
        }
        return view('dashboardPages.vehicles.dispose_vehicle_list');
    }
    public function get_searched_vehicles(Request $request){
        if ($request->ajax()) {
            $vehicles = Vehicle::whereRaw('LOWER(registration_number) like ?', [strtolower($request->q) . '%'])->get();;
            $items=[];
            foreach($vehicles as $key=>$val){
                $items[$key]['id']=$val->id;
                $items[$key]['text']=$val->registration_number;
            }
            $data['items']=$items;
            return json_encode($data);
        }
    }
    public function vehicle_transfer(Request $request){
        if ($request->ajax()) {
            $query = VehicleTransfer::join('vehicles', 'vehicle_transfers.vehicle_id', '=', 'vehicles.id')
            ->join('zones', 'vehicle_transfers.zone_id', '=', 'zones.id')
            ->join('ranges', 'vehicle_transfers.range_id', '=', 'ranges.id')
            ->join('districts', 'vehicle_transfers.district_id', '=', 'districts.id')
            ->join('users', 'vehicle_transfers.added_by', '=', 'users.id')
            ->select('vehicle_transfers.*','vehicles.registration_number','zones.zone','ranges.range','districts.district','users.name')
            ->get();
                foreach ($query as $row) {
                    if($row->from==Null || $row->from==""){
                        $row->from   = "N/A"; 
                    }else{
                        $row->from = date('d-M-Y', strtotime($row->from));
                    }
                    if($row->to==Null || $row->to==""){
                        $row->to   = "N/A"; 
                    }else{
                        $row->to = date('d-M-Y', strtotime($row->to));
                    }
                }   
              return DataTables::of($query)
                  ->addColumn('action', function ($row) {
                    $actionBtn="";
                    if(auth()->user()->can('Edit Vehicle Transfer Data')){
                        $actionBtn.='<a href="'.route('edit_vehicle_transfer', ['vehicle_tranfer_id' => Crypt::encryptString($row->id)]).'" class="btn btn-success">Edit</a>';
                    }
                    return $actionBtn;
                  })
                  ->rawColumns(['action'])
                  ->make(true);
        }
        return view('dashboardPages.vehicles.vehicle_transfer');
    }
    public function add_vehicle_transfer(){
        $data['vehicles'] = Vehicle::where('is_disposed', 0) ->orderBy('id', 'desc') ->select('id', 'registration_number') ->limit(10) ->get();        
        $data['zones'] = Zone::get();
        return view('dashboardPages.vehicles.add_vehicle_transfer',$data);
    }
    public function edit_vehicle_transfer($vehicle_tranfer_id){
        $vehicles = Vehicle::where('is_disposed', 0) ->orderBy('id', 'desc') ->select('id', 'registration_number') ->limit(10) ->get();
        $data['zones'] = Zone::get();
        $query =  VehicleTransfer::join('ranges', 'vehicle_transfers.range_id', '=', 'ranges.id')
            ->join('districts', 'vehicle_transfers.district_id', '=', 'districts.id')
            ->join('users', 'vehicle_transfers.added_by', '=', 'users.id')
            ->select('vehicle_transfers.*','ranges.range','districts.district','users.name')
            ->where('vehicle_transfers.id',Crypt::decryptString($vehicle_tranfer_id))
            ->first();
        if(!$vehicles->contains('id',$query->vehicle_id)){
            $additionalVehicle = vehicle::where('id', $query->vehicle_id)->first();
            $vehicles = collect([$additionalVehicle])->merge($vehicles);
        }
        $data['vehicles']=$vehicles;
        $data['transfer'] = $query;
        $data['ranges'] =  Range::where('zone_id',$query->zone_id)->get();
        $data['districts'] = District::where('range_id',$query->range_id)->get();
        return view('dashboardPages.vehicles.edit_vehicle_transfer',$data);
    }
    public function get_zone_wise_range(Request $request){
        $query =  Range::where('zone_id',$request->zone_id)->get();
        $html = "<option value=''>-- select range -- </option>";
        foreach($query as $range){
        $html.="<option value='".$range->id."'>$range->range</option>";
        }
       return $html;
    }
    public function get_range_wise_district(Request $request){
        $query =  District::where('range_id',$request->range_id)->get();
        $html = "<option value=''>-- select range -- </option>";
        foreach($query as $district){
        $html.="<option value='".$district->id."'>$district->district</option>";
        }
       return $html;
    }
    public function create_vehicle_transfer(Request $request){
        $from=NULL;
        $to=NULL;
        $validation = [];
        $validation['vehicle_id'] ='required'; 
        $validation['zone_id'] ='required'; 
        $validation['range_id'] ='required'; 
        $validation['district_id'] ='required'; 
        $validation['transfer_type'] ='required';
        if($request->transfer_type=="For Duty") {
            $validation['from'] ='required'; 
            $validation['to'] ='required'; 
            $from=date('Y-m-d',strtotime($request->from));
            $to=date('Y-m-d',strtotime($request->to));
        }
        $request->validate($validation);
        if($request->vehicle_transfer_id){
            $VehicleTransfer = VehicleTransfer::find($request->vehicle_transfer_id);
            $VehicleTransfer->vehicle_id = $request->vehicle_id;
            $VehicleTransfer->zone_id = $request->zone_id;
            $VehicleTransfer->range_id = $request->range_id;
            $VehicleTransfer->district_id = $request->district_id;
            $VehicleTransfer->transfer_type = $request->transfer_type;
            $VehicleTransfer->transfer_type = $request->transfer_type;
            $VehicleTransfer->from = $from;
            $VehicleTransfer->to = $to;
            $VehicleTransfer->save();
            return redirect()->route('vehicle_transfer')->with('message', 'Vehicle Transfery updated successfully');            
        }
        $VehicleTransfer = new VehicleTransfer();
        $VehicleTransfer->vehicle_id = $request->vehicle_id;
        $VehicleTransfer->zone_id = $request->zone_id;
        $VehicleTransfer->range_id = $request->range_id;
        $VehicleTransfer->district_id = $request->district_id;
        $VehicleTransfer->transfer_type = $request->transfer_type;
        $VehicleTransfer->transfer_type = $request->transfer_type;
        $VehicleTransfer->from = $from;
        $VehicleTransfer->to = $to;
        $VehicleTransfer->added_by = auth()->user()->id;
        $VehicleTransfer->save();
        return redirect()->route('vehicle_transfer')->with('message', 'Vehicle Transfery added successfully');
    }
    public function checkVal($val){
        if($val){
            return $val;
        }
        return "N/A";
    }
}
