<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Comissionarate;
use DataTables;

class CommisionrateController extends Controller
{
    public function comissionrate(Request $request){
        if ($request->ajax()) {
            $commissionrates = Comissionarate::orderBy('comissionrate_name', 'ASC');
            return DataTables::of($commissionrates)
                            ->addColumn('action', function ($row) {
                                $actionBtn='';
                                
                                if(auth()->user()->can('Edit Commissionrate Master Data')){
                                    $actionBtn='<a href="'.route('edit_commissionrate', ['commissionrate_id' => Crypt::encryptString($row->id)]).'" class="edit btn btn-primary btn-sm">Edit</a>';
                                }

                                if(auth()->user()->can('Remove Commissionrate Master Data')){
                                    $actionBtn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="'.Crypt::encryptString($row->id).'">Delete</a>';
                                }
                                return $actionBtn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }

        return view('dashboardPages.commissionrates.commissionrates');
    }

    public function add_commissionrate(){
        return view('dashboardPages.commissionrates.add_commissionrates');
    }

    public function create_commissionrate(Request $request){
        $validated = $request->validate([
            'commissionrate' => 'required'
        ]);

        $commissionrate=new Comissionarate;
        $commissionrate->comissionrate_name=$request->commissionrate;
        $commissionrate->save();

        return redirect()->route('commissionrate')->with('message', 'Commissionrate added successfully');
    }

    public function edit_commissionrate(Request $request){
        try{
            $commissionrate_information=Comissionarate::find(Crypt::decryptString($request->commissionrate_id));
        
            return view('dashboardPages.commissionrates.edit_commissionrates',compact('commissionrate_information'));
        }
        catch(\Exception $e){
            abort(404);
        }
    }

    public function update_commissionrate(Request $request){
        $validated = $request->validate([
            'commissionrate' => 'required'
        ]);

        $commissionrate=Comissionarate::find(Crypt::decryptString($request->commissionrate_id));
        $commissionrate->comissionrate_name=$request->commissionrate;
        $commissionrate->update();

        return redirect()->route('commissionrate')->with('message', 'Commissionrate added successfully');
    }

    public function remove_commissionrate(Request $request){
        if ($request->ajax()) {
            Comissionarate::where('id',Crypt::decryptString($request->commissionrate_id))->delete();

            return true;
        }
    }
}
