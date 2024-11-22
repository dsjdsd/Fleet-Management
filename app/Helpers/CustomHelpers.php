<?php
use App\Models\District;
use App\Models\User;
use App\Models\vehicle;
use App\Models\Range;
use App\Models\Zone;
use App\Models\Comissionarate;

function getDistrictName($districtid) {
    return District::where('id',$districtid)->value('district');
}

function getUserName($userid){
    return User::where('id',$userid)->value('name');
}

function getVehicleRegstrationId($vehicleid){
    return vehicle::where('id',$vehicleid)->value('registration_number');
}

function getUserPnoNumber($userid){
    return User::where('id',$userid)->value('pno_number');
}

function getDistrictZone($zoneid){
    return Zone::where('id',$zoneid)->value('zone');
}

function getDistrictRange($rangeid){
    return Range::where('id',$rangeid)->value('range');
}

function getCommissionrateName($commissionrateid){
    return Comissionarate::where('id',$commissionrateid)->value('comissionrate_name');
}