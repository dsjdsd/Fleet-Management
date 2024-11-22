<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Zone;
use App\Models\Range;
use App\Models\Comissionarate;
use DataTables;
use Illuminate\Support\Facades\Crypt;
class DistrictController extends Controller
{
    public function districts(Request $request){
        if ($request->ajax()) {
            $districts = District::orderBy('district', 'ASC');
            return DataTables::of($districts)
                            ->addColumn('zone', function ($row) {
                                if(empty($row->zone_id) || is_null($row->zone_id)){
                                    return 'NA';
                                }
                                else{
                                    return getDistrictZone($row->zone_id);
                                }
                            })
                            ->addColumn('range', function ($row) {
                                if(empty($row->zone_id) || is_null($row->zone_id)){
                                    return 'NA';
                                }
                                else{
                                    return getDistrictRange($row->range_id);
                                }
                            })
                            ->addColumn('action', function ($row) {
                                $actionBtn='';
                                
                                if(auth()->user()->can('Edit Districts')){
                                    $actionBtn='<a href="'.route('edit-district', ['district_id' => Crypt::encryptString($row->id)]).'" class="edit btn btn-primary btn-sm">Edit</a>';
                                }

                                if(auth()->user()->can('Remove Districts')){
                                    $actionBtn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="'.Crypt::encryptString($row->id).'">Delete</a>';
                                }
                                return $actionBtn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }

        return view('dashboardPages.districts.district');
    }

    public function edit_district(Request $request){
        try{
            $district_detail = District::find(Crypt::decryptString($request->district_id));

            $all_zones=Zone::get();
            
            $all_ranges=Range::where('zone_id',$district_detail->zone_id)->get();

            return view('dashboardPages.districts.edit-district',compact('district_detail','all_zones','all_ranges'));
        }
        catch(\Exception $e){
            abort(404);
        }
    }
    
    public function add_district(){
        $all_zones=Zone::get();
        return view('dashboardPages.districts.add-district',compact('all_zones'));
    }

    public function get_zone_range(Request $request){
        if ($request->ajax()) {
            $ranges=Range::where('zone_id',$request->zone_id)->get();
            $html='<option value="">Select Range</option>';

            foreach($ranges as $key=>$val){
                $html.="<option value='".$val->id."'>".$val->range."</option>";
            }

            return $html;
        }
    }

    public function district_post(Request $req){
        $validated = $req->validate([
            'zone' => 'required',
            'range' => 'required',
            'district' => 'required',
            'district_code' => 'required',
            'district_headquarter' => 'required'
        ]);

        if($req->id){
            $district_id = Crypt::decryptString($req->id);
            $data = District::find($district_id);
            $data->state = "Uttar Pradesh";
            $data->zone_id = $req->zone;
            $data->range_id = $req->range;
            $data->district = $req->district;
            $data->code = $req->district_code;
            $data->headquarter = $req->district_headquarter;
            $data->save();
            return redirect()->route('districts')->with('message', 'District updated successfully');
        }
        else{
            $data = new District();
            $data->state = "Uttar Pradesh";
            $data->zone_id = $req->zone;
            $data->range_id = $req->range;
            $data->district = $req->district;
            $data->code = $req->district_code;
            $data->headquarter = $req->district_headquarter;
            $data->save();
            return redirect()->route('districts')->with('message', 'District added successfully');
        }
    }

    public function remove_district(Request $request){
        if ($request->ajax()) {
            District::where('id',Crypt::decryptString($request->district_id))->delete();

            return true;
        }
    }
    
    public function zone_master(Request $request){
        if ($request->ajax()) {
            $zones = Zone::orderBy('zone', 'ASC');
            return DataTables::of($zones)
                            ->addColumn('commissionrate', function ($row) {
                                if(empty($row->commissionrate_id) || is_null($row->commissionrate_id)){
                                    return 'NA';
                                }
                                else{
                                    return getCommissionrateName($row->commissionrate_id);
                                }
                            })
                            ->addColumn('action', function ($row) {
                                $actionBtn='';
                                
                                if(auth()->user()->can('Edit Zones')){
                                    $actionBtn='<a href="'.route('edit_zone_master', ['zone_id' => Crypt::encryptString($row->id)]).'" class="edit btn btn-primary btn-sm">Edit</a>';
                                }

                                if(auth()->user()->can('Remove Zones')){
                                    $actionBtn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="'.Crypt::encryptString($row->id).'">Delete</a>';
                                }

                                return $actionBtn;
                            })
                            ->filterColumn('commissionrate', function ($query, $keyword) {
                                $query->whereHas('commissionrate', function ($subQuery) use ($keyword) {
                                    $subQuery->where('comissionrate_name', 'like', '%' . $keyword . '%');
                                });
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }

        return view('dashboardPages.districts.zone_master');
    }

    public function add_zone_master(){
        $commissionrates=Comissionarate::orderBy('comissionrate_name','ASC')->get();
        return view('dashboardPages.districts.add_zone_master',compact('commissionrates'));
    }

    public function create_zone_master(Request $request){
        $validated = $request->validate([
            'zone' => 'required|unique:zones,zone'
        ]);

        $zone=new Zone;
        $zone->commissionrate_id=$request->commissionrate;
        $zone->zone=$request->zone;
        $zone->save();

        return redirect()->route('zone_master')->with('message', 'Zone added successfully');
    }

    public function edit_zone_master(Request $request){
        $zone_data=Zone::find(Crypt::decryptString($request->zone_id));
        $commissionrates=Comissionarate::orderBy('comissionrate_name','ASC')->get();

        return view('dashboardPages.districts.edit_zone_master',compact('zone_data','commissionrates'));
    }

    public function update_zone_master(Request $request){
        $zone_id=Crypt::decryptString($request->zone_id);

        $validated = $request->validate([
            'zone' => 'required|unique:zones,zone,'.$zone_id
        ]);

        $zone=Zone::find(Crypt::decryptString($request->zone_id));
        $zone->zone=$request->zone;
        $zone->commissionrate_id=$request->commissionrate;
        $zone->update();

        return redirect()->route('zone_master')->with('message', 'Zone updated successfully');
    }

    public function delete_zone_master(Request $request){
        if ($request->ajax()) {
            Zone::where('id',Crypt::decryptString($request->zone_id))->delete();

            return true;
        }
    }

    public function delete_range_master(Request $request){
        if ($request->ajax()) {
            Range::where('id',Crypt::decryptString($request->range_id))->delete();

            return true;
        }
    }

    public function range_master(Request $request){
        if ($request->ajax()) {
            $ranges = Range::orderBy('range', 'ASC');
            return DataTables::of($ranges)
                            ->addColumn('zone', function ($row) {
                                return getDistrictZone($row->zone_id);
                            })  
                            ->addColumn('action', function ($row) {
                                $actionBtn='';
                                
                                if(auth()->user()->can('Edit Zones')){
                                    $actionBtn='<a href="'.route('edit_range_master', ['range_id' => Crypt::encryptString($row->id)]).'" class="edit btn btn-primary btn-sm">Edit</a>';
                                }

                                if(auth()->user()->can('Remove Zones')){
                                    $actionBtn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="'.Crypt::encryptString($row->id).'">Delete</a>';
                                }

                                return $actionBtn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }
        return view('dashboardPages.districts.range_master');
    }

    public function add_range_master(){
        $all_zones=Zone::get();
        return view('dashboardPages.districts.add_range_master',compact('all_zones'));
    }

    public function create_range_master(Request $req){
        $validated = $req->validate([
            'zone' => 'required',
            'range' => 'required'
        ]);
        
        $range=new Range;
        $range->zone_id =$req->zone;
        $range->range =$req->range;
        $range->save();

        return redirect()->route('range_master')->with('message', 'Range created successfully');
    }

    public function edit_range_master(Request $request){
        $all_zones=Zone::get();
        $range_information=Range::find(Crypt::decryptString($request->range_id));

        return view('dashboardPages.districts.edit_range_master',compact('all_zones','range_information'));
    }

    public function update_range_master(Request $request){
        $validated = $request->validate([
            'zone' => 'required',
            'range' => 'required'
        ]);
        
        $range=Range::find(Crypt::decryptString($request->range_id));
        $range->zone_id =$request->zone;
        $range->range =$request->range;
        $range->update();

        return redirect()->route('range_master')->with('message', 'Range updated successfully');
    }
}
