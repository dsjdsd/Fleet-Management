<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vehicle;
use App\Models\VehicleMake;
use App\Models\DailyDiary;
use DataTables;
use Illuminate\Support\Facades\Crypt;

class DailyDiaryController extends Controller
{
     public function daily_diary(Request $request){
        if ($request->ajax()) {
            $daily_diary = DailyDiary::orderBy('id', 'DESC');
            return DataTables::of($daily_diary)
                            ->addColumn('registration_number', function ($row) {
                                return getVehicleRegstrationId($row->vehicle_id);
                            })
                            ->addColumn('date', function ($row) {
                                return date('F d, Y',strtotime($row->date));
                            })
                            ->addColumn('purchase_date', function ($row) {
                                return date('F d, Y',strtotime($row->purchase_date));
                            })
                            ->addColumn('usage_start_date', function ($row) {
                                return date('F d, Y',strtotime($row->usage_start_date));
                            })
                            ->addColumn('action', function ($row) {
                                $actionBtn='';
                                
                                if(auth()->user()->can('Edit Daily Diary')){
                                    $actionBtn='<a href="'.route('edit_daily_diary', ['daily_diary_id' => Crypt::encryptString($row->id)]).'" class="edit btn btn-primary btn-sm">Edit</a>';
                                }

                                if(auth()->user()->can('Remove Daily Diary')){
                                    $actionBtn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="'.Crypt::encryptString($row->id).'">Delete</a>';
                                }
                                return $actionBtn;
                            })
                            ->filterColumn('registration_number', function ($query, $keyword) {
                                $query->whereHas('vehicle', function ($subQuery) use ($keyword) {
                                    $subQuery->where('registration_number', 'like', '%' . $keyword . '%');
                                });
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }
        return view('dashboardPages.dailyDiary.daily_diary');
    }

    public function add_daily_diary(){
        $vehicles=vehicle::orderBy('id', 'DESC')->offset(0)->limit(10)->get();
        $vehicle_makes=VehicleMake::get();

        return view('dashboardPages.dailyDiary.add_daily_diary',compact('vehicles','vehicle_makes'));
    }

    public function delete_daily_diary_record(Request $request){
        if ($request->ajax()) {
            DailyDiary::where('id',Crypt::decryptString($request->daily_diary_id))->delete();

            return true;
        }
    }

    public function edit_daily_diary(Request $request){
        try{
            $vehicles=vehicle::orderBy('id', 'DESC')->offset(0)->limit(10)->get();
            $vehicle_makes=VehicleMake::get();
            $daily_diary_information=DailyDiary::find(Crypt::decryptString($request->daily_diary_id));

            if(!$vehicles->contains('id',$daily_diary_information->vehicle_id)){
                $additionalVehicle = vehicle::where('id', $daily_diary_information->vehicle_id)->first();
                $vehicles = collect([$additionalVehicle])->merge($vehicles);
            }

            return view('dashboardPages.dailyDiary.edit_daily_diary',compact('vehicles','vehicle_makes','daily_diary_information'));
        }
        catch(\Exception $e){
            abort(404);
        }
    }

    public function update_daily_diary_data(Request $request){
        $validated = $request->validate([
            'vehicle' => 'required',
            'date' => 'required',
            'vehicle_type' => 'required',
            'chasis_number' => 'required',
            'engine_number' => 'required',
            'num_cylinders' => 'required',
            'vehicle_make' => 'required',
            'ability_sit' => 'required',
            'engine_oil_quantity' => 'required',
            'gear_oil_quantity' => 'required',
            'average_expence' => 'required',
            'purchase_date' => 'required',
            'usage_date' => 'required',
            'purchase_price' => 'required'
        ]);

        $daily_diary=DailyDiary::find(Crypt::decryptString($request->daily_diary_id));
        $daily_diary->vehicle_id=$request->vehicle;
        $daily_diary->date=date('Y-m-d',strtotime($request->date));
        $daily_diary->vehicle_type=$request->vehicle_type;
        $daily_diary->special_purpose_vehicle=isset($request->special_purpose_vehicles) ? $request->special_purpose_vehicles : '';
        $daily_diary->chasis_number=$request->chasis_number;
        $daily_diary->engine_number=$request->engine_number;
        $daily_diary->cubic_capacity=$request->cubic_capacity;
        $daily_diary->num_cylinders=$request->num_cylinders;
        $daily_diary->vehicle_make=$request->vehicle_make;
        $daily_diary->ability_to_sit=$request->ability_sit;
        $daily_diary->engine_oil_quantity=$request->engine_oil_quantity;
        $daily_diary->gear_oil_quantity=$request->gear_oil_quantity;
        $daily_diary->average_expenses=$request->average_expence;
        $daily_diary->purchase_date=date('Y-m-d',strtotime($request->purchase_date));
        $daily_diary->usage_start_date=date('Y-m-d',strtotime($request->usage_date));
        $daily_diary->purchase_price=$request->purchase_price;

        $daily_diary->save();

        return redirect()->route('daily_diary')->with('message', 'Daily Diary entry added successfully');
    }

    public function get_diary_vehicle_list(Request $request){
        if ($request->ajax()) {
            $vehicles = vehicle::whereRaw('LOWER(registration_number) like ?', ['%'.strtolower($request->q).'%'])->get();
            
            $items=[];

            foreach($vehicles as $key=>$val){
                $items[$key]['id']=$val->id;
                $items[$key]['text']=$val->registration_number;
            }

            $data['items']=$items;

            return json_encode($data);
        }
    }

    public function get_diary_vehicle_details(Request $request){
        if ($request->ajax()) {
            $chassis_number=vehicle::where('id',$request->vehicle_id)->value('chasis_number');
            $engine_number=vehicle::where('id',$request->vehicle_id)->value('engine_number');
            $make=vehicle::where('id',$request->vehicle_id)->value('vehicle_make');

            $data = array(
                'chassis_number' => $chassis_number,
                'engine_number' => $engine_number,
                'make' => $make
            );

            // Encode data as JSON
            $jsonResponse = json_encode($data);

            // Set appropriate headers and echo the JSON response
            header('Content-Type: application/json');
            
            return $jsonResponse;
        }
    }

    public function create_daily_diary_data(Request $request){
        $validated = $request->validate([
            'vehicle' => 'required',
            'date' => 'required',
            'vehicle_type' => 'required',
            'chasis_number' => 'required',
            'engine_number' => 'required',
            'num_cylinders' => 'required',
            'vehicle_make' => 'required',
            'ability_sit' => 'required',
            'engine_oil_quantity' => 'required',
            'gear_oil_quantity' => 'required',
            'average_expence' => 'required',
            'purchase_date' => 'required',
            'usage_date' => 'required',
            'purchase_price' => 'required'
        ]);

        $daily_diary=new DailyDiary;
        $daily_diary->vehicle_id=$request->vehicle;
        $daily_diary->date=date('Y-m-d',strtotime($request->date));
        $daily_diary->vehicle_type=$request->vehicle_type;
        $daily_diary->special_purpose_vehicle=isset($request->special_purpose_vehicles) ? $request->special_purpose_vehicles : '';
        $daily_diary->chasis_number=$request->chasis_number;
        $daily_diary->engine_number=$request->engine_number;
        $daily_diary->cubic_capacity=$request->cubic_capacity;
        $daily_diary->num_cylinders=$request->num_cylinders;
        $daily_diary->vehicle_make=$request->vehicle_make;
        $daily_diary->ability_to_sit=$request->ability_sit;
        $daily_diary->engine_oil_quantity=$request->engine_oil_quantity;
        $daily_diary->gear_oil_quantity=$request->gear_oil_quantity;
        $daily_diary->average_expenses=$request->average_expence;
        $daily_diary->purchase_date=date('Y-m-d',strtotime($request->purchase_date));
        $daily_diary->usage_start_date=date('Y-m-d',strtotime($request->usage_date));
        $daily_diary->purchase_price=$request->purchase_price;

        $daily_diary->save();

        return redirect()->route('daily_diary')->with('message', 'Daily Diary entry added successfully');
    }
}
