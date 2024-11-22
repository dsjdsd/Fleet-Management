<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleMake;
use App\Models\District;
use App\Models\VehiclesInventory;
use DataTables;
use Illuminate\Support\Facades\Crypt;


class VehiclesInventoryController extends Controller
{
    public function add_vehicle_inventory(){
        $data['vehicle_make'] = VehicleMake::get();
        $data['districts'] = District::get();
        return view('dashboardPages.vehicle_inventory.add_inventory',$data);
    }
    public function create_vehicle_inventory(Request $request){
        $validation = [];
        $validation['modal_id'] ='required'; 
        $validation['color_name'] ='required'; 
        $validation['vehicle_type'] ='required'; 
        $validation['vehicle_numbers'] ='required'; 
        $validation['deployed_districts'] ='required'; 
        $request->validate($validation);
        if($request->vehicle_inventory_id){
            $VehiclesInventory = VehiclesInventory::find($request->vehicle_inventory_id);
            $VehiclesInventory->modal_id = $request->modal_id;
            $VehiclesInventory->color_name = $request->color_name;
            $VehiclesInventory->vehicle_type = $request->vehicle_type;
            $VehiclesInventory->vehicle_numbers = $request->vehicle_numbers;
            $VehiclesInventory->deployed_districts = $request->deployed_districts;
            $VehiclesInventory->save();
            return redirect()->route('vehicles_inventory')->with('message', 'Vehicles inventory updated successfully');    
        }else{
            $VehiclesInventory = new VehiclesInventory();
            $VehiclesInventory->modal_id = $request->modal_id;
            $VehiclesInventory->color_name = $request->color_name;
            $VehiclesInventory->vehicle_type = $request->vehicle_type;
            $VehiclesInventory->vehicle_numbers = $request->vehicle_numbers;
            $VehiclesInventory->deployed_districts = $request->deployed_districts;
            $VehiclesInventory->save();
            return redirect()->route('vehicles_inventory')->with('message', 'Vehicles inventory added successfully');
        }
    }
    public function vehicles_inventory(Request $request){
        if ($request->ajax()) {
            $query = VehiclesInventory::join('vehicle_makes', 'vehicles_inventories.modal_id', '=', 'vehicle_makes.id')
            ->join('districts', 'vehicles_inventories.deployed_districts', '=', 'districts.id')
            ->select('vehicles_inventories.id','vehicles_inventories.color_name','vehicles_inventories.vehicle_type','vehicles_inventories.vehicle_numbers','vehicle_makes.make','districts.district') 
            ->orderBy('vehicles_inventories.id', 'desc') 
            ->get();  
            return DataTables::of($query)
              ->addColumn('action', function ($row) {
                if(auth()->user()->can('Edit Vehicle Inventory')){
                    $actionBtn='<a href="'.route('edit_vehicle_inventory', ['vehicle_inventory_id' => Crypt::encryptString($row->id)]).'" class="btn btn-success">Edit</a>';
                }
                if(auth()->user()->can('Remove Vehicle Inventory')){
                    $actionBtn .= '<a href="javascript:void(0)" class="delete btn btn-danger" data-id="'.Crypt::encryptString($row->id).'">Delete</a>';
                }
                return $actionBtn;
              })
              ->rawColumns(['action'])
              ->make(true);
        }
        return view('dashboardPages.vehicle_inventory.vehicles_inventory');
    }
    public function edit_vehicle_inventory($vehicle_inventory_id){
        $vehicle_inventory_id = Crypt::decryptString($vehicle_inventory_id);
        $data['vehicle_make'] = VehicleMake::get();
        $data['districts'] = District::get();
        $query = VehiclesInventory::where('vehicles_inventories.id',$vehicle_inventory_id)
        ->first();
        $data['inventory'] = $query;
        return view('dashboardPages.vehicle_inventory.edit_inventory',$data);
    }
    public function remove_vehicle_inventory(Request $request){
        if ($request->ajax()) {
            VehiclesInventory::where('id',Crypt::decryptString($request->vehicle_inventory_id))->delete();
            return true;
        }
    }
}
