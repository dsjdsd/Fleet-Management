<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleTransfer;
use App\Models\Vehicle;
use App\Models\RepairingExpense;
use App\Models\User;
use App\Exports\RepairingExpensesExport;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;

class ReportController extends Controller
{
    public function fuel_report(){
        return view('dashboardPages.reports.fuel_report');
    }

    public function service_expenses_report(){
        return view('dashboardPages.reports.service_expenses_report');
    }

    public function repairing_expenses_report(Request $request){
        if ($request->ajax()) {
            $repairing_expenses_data = RepairingExpense::orderBy('id', 'DESC');
            return DataTables::of($repairing_expenses_data)
                ->addColumn('vehicle_number', function ($row) {
                    return getVehicleRegstrationId($row->vehicle_id);
                })
                ->addColumn('driver', function ($row) {
                    return getUserName($row->driver_id);
                })
                ->addColumn('pno_number', function ($row) {
                    return getUserPnoNumber($row->driver_id);
                })
                ->addColumn('cost', function ($row) {
                    return 'Rs. ' . number_format($row->cost, 2);
                })
                ->filter(function ($query) use ($request) {
                    if(!empty($request->input('vehicle'))){
                        $query->where('vehicle_id', $request->input('vehicle'));
                    }

                    if(!empty($request->input('minimum_cost'))){
                        $query->where('cost', '>=', $request->input('minimum_cost'));
                    }

                    if(!empty($request->input('maximum_cost'))){
                        $query->where('cost', '<=', $request->input('maximum_cost'));
                    }

                    if(!empty($request->input('repair_date_from'))){
                        $query->where('repair_date', '>=', $request->input('repair_date_from'));
                    }

                    if(!empty($request->input('repair_date_to'))){
                        $query->where('repair_date', '<=', $request->input('repair_date_from'));
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $vehicles=vehicle::orderBy('id', 'DESC')->offset(0)->limit(10)->get();

        return view('dashboardPages.reports.repairing_expenses_report',compact('vehicles'));
    }

    public function download_repairing_expense_report(){
        return Excel::download(new RepairingExpensesExport, 'repairing_expenses.xlsx');
    }

    public function purchased_products_report(){
        return view('dashboardPages.reports.purchased_products_report');
    }

    public function fuel_consumptions_report(){
        return view('dashboardPages.reports.fuel_consumptions_report');
    }

    public function vehicles_inventory_report(){
        return view('dashboardPages.reports.vehicles_inventory_report');
    }

    public function dispose_vehicle_list_report(){
        return view('dashboardPages.reports.dispose_vehicle_list_report');
    }

    public function vehicle_deployement_list_report(){
        return view('dashboardPages.reports.vehicle_deployement_list_report');
    }
    public function vehicle_transfer_list_report(Request $request){
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
                  
                 
                  ->make(true);
        }
        $data['vehicles'] = Vehicle::where('is_disposed', 0) ->orderBy('id', 'desc') ->select('id', 'registration_number') ->limit(10) ->get();        
        return view('dashboardPages.reports.vehicle_transfer_list_report',$data);
    }
}
