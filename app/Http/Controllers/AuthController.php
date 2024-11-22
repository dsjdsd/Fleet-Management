<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\vehicle;
use App\Models\AssignedVehicle;
use Auth;

class AuthController extends Controller{
    
    public function signedin(Request $request){
        return view('authPages.signin');
    }

    public function forgetPassword(Request $request){
        return view('authPages.forget-password');
    }
  
    public function getloggedin(Request $request){
        $validated = $request->validate([
            'pno_number' => 'required',
            'registration_number' => 'required'
        ]);

        $error=0;

        if(!User::where('pno_number',$request->pno_number)->orWhere('user_name', $request->input('pno_number'))->exists()){
            return redirect()->back()->with('error', 'Invalid PNO number / Username')->withInput();
        }

        if(!vehicle::where('registration_number',$request->registration_number)->exists()){
            $credentials['user_name']=$request->pno_number;
            $credentials['password']=$request->registration_number;

            if (Auth::attempt($credentials)) {
                return redirect()->route('dashboard');
            }
            else{
                return redirect()->back()->with('error', 'Invalid Vehicle Number / Password')->withInput();
            }
        }

        $user_id=User::where('pno_number',$request->pno_number)->value('id');
        $vehicle_id=vehicle::where('registration_number',$request->registration_number)->value('id');

        if(!AssignedVehicle::where('vehicle_id',$vehicle_id)->where('user_id',$user_id)->WhereNull('released_on')->exists()){
            return redirect()->back()->with('error', 'You have not been assigned to the vehicle. Please contact administrator')->withInput();
        }

        Auth::loginUsingId($user_id);
        
        return redirect()->route('dashboard');
    }
}
