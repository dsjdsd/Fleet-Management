<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Unit;
use App\Models\District;
use DataTables;

class UnitController extends Controller
{
    public function units(Request $request){
        if ($request->ajax()) {
            $units = Unit::orderBy('unit', 'ASC');
            return DataTables::of($units)
                            ->addColumn('district', function ($row) {
                                if(empty($row->district_id) || is_null($row->district_id)){
                                    return 'NA';
                                }
                                else{
                                    return getDistrictName($row->district_id);
                                }
                            })
                            ->addColumn('action', function ($row) {
                                $actionBtn='';
                                
                                //if(auth()->user()->can('Edit Districts')){
                                    $actionBtn='<a href="'.route('edit_unit', ['unit_id' => Crypt::encryptString($row->id)]).'" class="edit btn btn-primary btn-sm">Edit</a>';
                                //}

                                //if(auth()->user()->can('Remove Districts')){
                                    $actionBtn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="'.Crypt::encryptString($row->id).'">Delete</a>';
                                //}
                                return $actionBtn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }

        return view('dashboardPages.units.units');
    }

    public function add_unit(){
        $districts=District::orderBy('district','ASC')->get();
        return view('dashboardPages.units.add_unit',compact('districts'));
    }

    public function create_unit(Request $request){
        $validated = $request->validate([
            'unit' => 'required'
        ]);

        $unit=new Unit;
        $unit->district_id=$request->district;
        $unit->unit=$request->unit;
        $unit->save();

        return redirect()->route('units')->with('message', 'Unit added successfully');
    }

    public function edit_unit(Request $request){
        try{
            $districts=District::orderBy('district','ASC')->get();
            $unit_detail=Unit::where('id',Crypt::decryptString($request->unit_id))->first();

            return view('dashboardPages.units.edit_unit',compact('districts','unit_detail'));
        }
        catch(\Exception $e){
            abort(404);
        }
    }

    public function update_unit(Request $request){
        $validated = $request->validate([
            'unit' => 'required'
        ]);

        $unit=Unit::find(Crypt::decryptString($request->unit_id));
        $unit->district_id=$request->district;
        $unit->unit=$request->unit;
        $unit->update();

        return redirect()->route('units')->with('message', 'Unit added successfully');
    }

    public function remove_unit(Request $request){
        if ($request->ajax()) {
            Unit::where('id',Crypt::decryptString($request->unit_id))->delete();

            return true;
        }
    }
}
