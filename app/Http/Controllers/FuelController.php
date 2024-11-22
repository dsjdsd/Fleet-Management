<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuelController extends Controller
{
    public function fuel_consumptions(){
        return view('dashboardPages.fuel.fuel_consumptions');
    }
    public function fuel_transactions(){
        return view('dashboardPages.fuel.fuel_transactions');
    }
    public function add_fuel_transaction(){
        return view('dashboardPages.fuel.add_fuel_transaction');
    }
    public function edit_fuel_transaction(){
        return view('dashboardPages.fuel.edit_fuel_transaction');
    }
}
