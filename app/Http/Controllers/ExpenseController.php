<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\vehicle;
use App\Models\ServiceExpense;
use App\Models\RepairingExpense;
use App\Models\PurchaseExpense;
use DataTables;
use Illuminate\Support\Facades\Crypt;


class ExpenseController extends Controller
{
    public function fuel(){
        return view('dashboardPages.expenses.fuel');
    }
    public function add_fuel(){


        return view('dashboardPages.expenses.add_fuel');
    }
    public function edit_fuel(){
        return view('dashboardPages.expenses.edit_fuel');
    }
    public function service_expenses(Request $request){        
        if ($request->ajax()) {
            $query = ServiceExpense::join('vehicles', 'service_expenses.vehicle_id', '=', 'vehicles.id')
            ->join('users', 'service_expenses.driver_id', '=', 'users.id')
            ->select('service_expenses.*','vehicles.registration_number','users.name','users.pno_number')
            ->orderBy('service_expenses.id', 'desc') 
            ->get();
                foreach ($query as $row) {
                    $row->service_date = date('d-M-Y', strtotime($row->service_date));
                    if ($row->receipt) {
                        // Provide a route to download the receipt file
                        $row->receipt = "<a href='".asset('storage/service_expenses_pdf/' . $row->receipt)."' target='_blank'>Download</a>";
                    } else {
                        $row->receipt = "N/A";
                    }
                }   
              return DataTables::of($query)
                  ->addColumn('action', function ($row) {
                    $actionBtn="";
                    if(auth()->user()->can('Edit Service Expenses')){
                        $actionBtn.='<a href="'.route('edit_service_expenses', ['service_expense_id' => Crypt::encryptString($row->id)]).'" class="btn btn-success">Edit</a>';
                    }
                    return $actionBtn;
                  })
                  ->rawColumns(['action','receipt'])
                  ->make(true);
        }
        return view('dashboardPages.expenses.service_expenses');
    }
    public function add_service_expenses(){
        $data['vehicles'] = Vehicle::where('is_disposed', 0) ->orderBy('id', 'desc') ->select('id', 'registration_number') ->offset(0)->limit(10) ->get();        
        $data['drivers'] = User::where('id','!=',1)->orderBy('id', 'desc') ->select('id','name') ->offset(0)->limit(10)->get();
        return view('dashboardPages.expenses.add_service_expenses',$data);
    }
    public function create_service_expenses(Request $request){
        $validation = [];
        $validation['vehicle_id'] ='required'; 
        $validation['driver_id'] ='required'; 
        $validation['pno_number'] ='required'; 
        $validation['cost'] ='required';
        $validation['service_date'] ='required'; 
        if(isset($request->receipt)){
            $validation['receipt'] ='required|file|mimes:pdf'; 
        } 
        $request->validate($validation);
        if($request->service_expense_id){
            $ServiceExpense =  ServiceExpense::find($request->service_expense_id);
            if (!is_null($request->file('receipt')) && $request->file('receipt')->isValid()) {
                $receipt_pdf = time() . '_' . date('d-m-Y').".".$request->file('receipt')->getClientOriginalExtension(); 
                $path = $request->file('receipt')->storeAs('public/service_expenses_pdf', $receipt_pdf);
                $ServiceExpense->receipt = $receipt_pdf;
            }
            $ServiceExpense->vehicle_id = $request->vehicle_id;
            $ServiceExpense->driver_id = $request->driver_id;
            $ServiceExpense->cost = $request->cost;
            $ServiceExpense->service_date = $request->service_date;
            $ServiceExpense->save();
            return redirect()->route('service_expenses')->with('message', 'service expenses updated successfully');
        }
        $ServiceExpense = new ServiceExpense();
        if (!is_null($request->file('receipt')) && $request->file('receipt')->isValid()) {
            $receipt_pdf = time() . '_' . date('d-m-Y').".".$request->file('receipt')->getClientOriginalExtension(); 
            $path = $request->file('receipt')->storeAs('public/service_expenses_pdf', $receipt_pdf);
            $ServiceExpense->receipt = $receipt_pdf;
        }
       
        $ServiceExpense->vehicle_id = $request->vehicle_id;
        $ServiceExpense->driver_id = $request->driver_id;
        $ServiceExpense->cost = $request->cost;
        $ServiceExpense->service_date = $request->service_date;
        $ServiceExpense->save();
        return redirect()->route('service_expenses')->with('message', 'service expenses added successfully');

    }
    public function user_wise_get_pno_number(Request $request){
        $pno_number = User::where('id',$request->driver_id)->select('pno_number')->first();
        if(isset($pno_number->pno_number)){
            return $pno_number->pno_number;
        }
        return "";
    }
    public function edit_service_expenses($service_expense_id){
        $vehicles= Vehicle::where('is_disposed', 0) ->orderBy('id', 'desc') ->select('id', 'registration_number') ->offset(0)->limit(10) ->get();
        $data['drivers'] = User::where('id','!=',1)->get();
        $query = ServiceExpense::join('vehicles', 'service_expenses.vehicle_id', '=', 'vehicles.id')
            ->join('users', 'service_expenses.driver_id', '=', 'users.id')
            ->where('service_expenses.id',Crypt::decryptString($service_expense_id))
            ->select('service_expenses.*','vehicles.registration_number','users.name','users.pno_number')
            ->first();
        if(!$vehicles->contains('id',$query->vehicle_id)){
            $additionalVehicle = vehicle::where('id', $query->vehicle_id)->first();
            $vehicles = collect([$additionalVehicle])->merge($vehicles);
        }
        $data['vehicles']=$vehicles;    
        $data['service_expense'] = $query;
        return view('dashboardPages.expenses.edit_service_expenses',$data);
    }
    public function repairing_expenses(Request $request){
        if ($request->ajax()) {
            $query = RepairingExpense::join('vehicles', 'repairing_expenses.vehicle_id', '=', 'vehicles.id')
            ->join('users', 'repairing_expenses.driver_id', '=', 'users.id')
            ->select('repairing_expenses.*','vehicles.registration_number','users.name','users.pno_number')
            ->orderBy('repairing_expenses.id', 'desc') 
            ->get();
                foreach ($query as $row) {
                    $row->repair_date = date('d-M-Y', strtotime($row->repair_date));
                    if ($row->receipt) {
                        // Provide a route to download the receipt file
                        $row->receipt = "<a href='".asset('storage/repair_expenses_pdf/' . $row->receipt)."' target='_blank'>Download</a>";
                    } else {
                        $row->receipt = "N/A";
                    }
                }   
              return DataTables::of($query)
                  ->addColumn('action', function ($row) {
                    $actionBtn="";
                    if(auth()->user()->can('Edit Repairing Expenses')){
                        $actionBtn.='<a href="'.route('edit_repairing_expenses', ['repair_expense_id' => Crypt::encryptString($row->id)]).'" class="btn btn-success">Edit</a>';
                    }
                    return $actionBtn;
                  })
                  ->rawColumns(['action','receipt'])
                  ->make(true);
        }
        return view('dashboardPages.expenses.repairing_expenses');
    }
    public function add_repairing_expenses(){
        $data['vehicles'] = Vehicle::where('is_disposed', 0) ->orderBy('id', 'desc') ->select('id', 'registration_number') ->offset(0)->limit(10) ->get();        
        $data['drivers'] = User::where('id','!=',1)->get();
        return view('dashboardPages.expenses.add_repairing_expenses',$data);
    }
    public function create_repairing_expenses(Request $request){
        $validation = [];
        $validation['vehicle_id'] ='required'; 
        $validation['driver_id'] ='required'; 
        $validation['pno_number'] ='required'; 
        $validation['cost'] ='required';
        $validation['repair_date'] ='required'; 
        if(isset($request->receipt)){
            $validation['receipt'] ='required|file|mimes:pdf'; 
        } 
        $request->validate($validation);
        if($request->repair_expense_id){
            $RepairingExpense =  RepairingExpense::find($request->repair_expense_id);
            if (!is_null($request->file('receipt')) && $request->file('receipt')->isValid()) {
                $receipt_pdf = time() . '_' . date('d-m-Y').".".$request->file('receipt')->getClientOriginalExtension(); 
                $path = $request->file('receipt')->storeAs('public/repair_expenses_pdf', $receipt_pdf);
                $RepairingExpense->receipt = $receipt_pdf;
            }
            $RepairingExpense->vehicle_id = $request->vehicle_id;
            $RepairingExpense->driver_id = $request->driver_id;
            $RepairingExpense->cost = $request->cost;
            $RepairingExpense->repair_date = $request->repair_date;
            $RepairingExpense->save();
            return redirect()->route('repairing_expenses')->with('message', 'repairing expenses updated successfully');
        }
        $RepairingExpense = new RepairingExpense();
        if (!is_null($request->file('receipt')) && $request->file('receipt')->isValid()) {
            $receipt_pdf = time() . '_' . date('d-m-Y').".".$request->file('receipt')->getClientOriginalExtension(); 
            $path = $request->file('receipt')->storeAs('public/repair_expenses_pdf', $receipt_pdf);
            $RepairingExpense->receipt = $receipt_pdf;
        }
        $RepairingExpense->vehicle_id = $request->vehicle_id;
        $RepairingExpense->driver_id = $request->driver_id;
        $RepairingExpense->cost = $request->cost;
        $RepairingExpense->repair_date = $request->repair_date;
        $RepairingExpense->save();
        return redirect()->route('repairing_expenses')->with('message', 'repairing expenses added successfully');
    }
    public function edit_repairing_expenses($repair_expense_id){
        $vehicles = Vehicle::where('is_disposed', 0) ->orderBy('id', 'desc') ->select('id', 'registration_number') ->offset(0)->limit(10) ->get();
        $data['drivers'] = User::where('id','!=',1)->get();
        $query = RepairingExpense::join('vehicles', 'repairing_expenses.vehicle_id', '=', 'vehicles.id')
            ->join('users', 'repairing_expenses.driver_id', '=', 'users.id')
            ->where('repairing_expenses.id',Crypt::decryptString($repair_expense_id))
            ->select('repairing_expenses.*','vehicles.registration_number','users.name','users.pno_number')
            ->first();
        if(!$vehicles->contains('id',$query->vehicle_id)){
            $additionalVehicle = vehicle::where('id', $query->vehicle_id)->first();
            $vehicles = collect([$additionalVehicle])->merge($vehicles);
        }
        $data['vehicles']=$vehicles;
        $data['repair_expense'] = $query;
        return view('dashboardPages.expenses.edit_repairing_expenses',$data);
    }
    public function purchased_products(Request $request){
        if ($request->ajax()) {
            $query = PurchaseExpense::join('vehicles', 'purchase_expenses.vehicle_id', '=', 'vehicles.id')
            ->join('users', 'purchase_expenses.driver_id', '=', 'users.id')
            ->select('purchase_expenses.*','vehicles.registration_number','users.name','users.pno_number')
            ->orderBy('purchase_expenses.id', 'desc') 
            ->get();
                foreach ($query as $row) {
                    $row->purchase_date = date('d-M-Y', strtotime($row->purchase_date));
                    if ($row->receipt) {
                        // Provide a route to download the receipt file
                        $row->receipt = "<a href='".asset('storage/purchase_expenses_pdf/' . $row->receipt)."' target='_blank'>Download</a>";
                    } else {
                        $row->receipt = "N/A";
                    }
                }   
              return DataTables::of($query)
                  ->addColumn('action', function ($row) {
                    $actionBtn="";
                    if(auth()->user()->can('Edit Purchased Products Expenses')){
                        $actionBtn.='<a href="'.route('edit_purchased_products', ['purchase_expense_id' => Crypt::encryptString($row->id)]).'" class="btn btn-success">Edit</a>';
                    }
                    return $actionBtn;
                  })
                  ->rawColumns(['action','receipt'])
                  ->make(true);
        }
        return view('dashboardPages.expenses.purchased_products');
    }
    public function add_purchased_products(){
        $data['vehicles'] = Vehicle::where('is_disposed', 0) ->orderBy('id', 'desc') ->select('id', 'registration_number') ->offset(0)->limit(10) ->get();        
        $data['drivers'] = User::where('id','!=',1)->get();
        return view('dashboardPages.expenses.add_purchased_products',$data);
    }
    public function create_purchased_products(Request $request){
        $validation = [];
        $validation['vehicle_id'] ='required'; 
        $validation['driver_id'] ='required'; 
        $validation['pno_number'] ='required'; 
        $validation['cost'] ='required';
        $validation['purchase_date'] ='required'; 
        $validation['purchase_item'] ='required'; 
        if(isset($request->receipt)){
            $validation['receipt'] ='required|file|mimes:pdf'; 
        } 
        $request->validate($validation);
        if($request->purchase_expense_id){
            $PurchaseExpense =  PurchaseExpense::find($request->purchase_expense_id);
            if (!is_null($request->file('receipt')) && $request->file('receipt')->isValid()) {
                $receipt_pdf = time() . '_' . date('d-m-Y').".".$request->file('receipt')->getClientOriginalExtension(); 
                $path = $request->file('receipt')->storeAs('public/purchase_expenses_pdf', $receipt_pdf);
                $PurchaseExpense->receipt = $receipt_pdf;
            }
            $PurchaseExpense->vehicle_id = $request->vehicle_id;
            $PurchaseExpense->driver_id = $request->driver_id;
            $PurchaseExpense->cost = $request->cost;
            $PurchaseExpense->purchase_date = $request->purchase_date;
            $PurchaseExpense->purchase_item = $request->purchase_item;
            $PurchaseExpense->save();
            return redirect()->route('purchased_products')->with('message', 'purchase product expenses updated successfully');
        }
        $PurchaseExpense = new PurchaseExpense();
        if (!is_null($request->file('receipt')) && $request->file('receipt')->isValid()) {
            $receipt_pdf = time() . '_' . date('d-m-Y').".".$request->file('receipt')->getClientOriginalExtension(); 
            $path = $request->file('receipt')->storeAs('public/purchase_expenses_pdf', $receipt_pdf);
            $PurchaseExpense->receipt = $receipt_pdf;
        }
        $PurchaseExpense->vehicle_id = $request->vehicle_id;
        $PurchaseExpense->driver_id = $request->driver_id;
        $PurchaseExpense->cost = $request->cost;
        $PurchaseExpense->purchase_date = $request->purchase_date;
        $PurchaseExpense->purchase_item = $request->purchase_item;
        $PurchaseExpense->save();
        return redirect()->route('purchased_products')->with('message', 'purchase product expenses added successfully');
    }
    public function edit_purchased_products($purchase_expense_id){
        $vehicles = Vehicle::where('is_disposed', 0) ->orderBy('id', 'desc') ->select('id', 'registration_number') ->offset(0)->limit(10) ->get();
        $data['drivers'] = User::where('id','!=',1)->get();
        $query = PurchaseExpense::join('vehicles', 'purchase_expenses.vehicle_id', '=', 'vehicles.id')
            ->join('users', 'purchase_expenses.driver_id', '=', 'users.id')
            ->where('purchase_expenses.id',Crypt::decryptString($purchase_expense_id))
            ->select('purchase_expenses.*','vehicles.registration_number','users.name','users.pno_number')
            ->first();
        if(!$vehicles->contains('id',$query->vehicle_id)){
            $additionalVehicle = vehicle::where('id', $query->vehicle_id)->first();
            $vehicles = collect([$additionalVehicle])->merge($vehicles);
        }
        $data['vehicles']=$vehicles;
        $data['purchase_expense'] = $query;
        return view('dashboardPages.expenses.edit_purchased_products',$data);
    }
}
