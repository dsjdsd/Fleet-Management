<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller {
    
    public function dashboard(Request $request){
        // exit("dashboard");
        return view('dashboardPages.dashboard');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
