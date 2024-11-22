@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Manage Make/Model</h2>
                    
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <h2 class="card-inside-title">Edit Make/Model</h2>
                            <form name="frm" class="make_form" method="POST" action="{{route('update_make')}}">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                    <div class="row">
                                        <div class="form-group role_main_div col-md-6 col-sm-12">   
                                        <label>Make</label>                                  
                                            <input type="text" class="form-control" placeholder="Make" name="make" id="make" value="{{old('make') ? old('make') : $make->make}}" />

                                            @error('make')
								                <label class="error help-block">{{ $message }}</label>
                			                @enderror
                                        </div>
                                        
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>Vehicle</label> 
                                            <select name="vehicle_type" id="vehicle_type" class=" form-control show-tick ms select2">
                                                <option value="">Select Vehicle Type</option>
                                                <option value="Cars" {{old('vehicle_type')=='Cars' ? 'selected' : ($make->vehicle_type=='Cars' ? 'selected' : '')}}>Cars</option>
                                                <option value="Jeep" {{old('vehicle_type')=='Jeep' ? 'selected' : ($make->vehicle_type=='Jeep' ? 'selected' : '')}}>Jeep</option>
                                                <option value="Van" {{old('vehicle_type')=='Van' ? 'selected' : ($make->vehicle_type=='Van' ? 'selected' : '')}}>Van</option>
                                                <option value="Trucks" {{old('vehicle_type')=='Trucks' ? 'selected' : ($make->vehicle_type=='Trucks' ? 'selected' : '')}}>Trucks</option>
                                                <option value="Two Wheelers" {{old('vehicle_type')=='Two Wheelers' ? 'selected' : ($make->vehicle_type=='Two Wheelers' ? 'selected' : '')}}>Two Wheelers</option>
                                                <option value="Tractors" {{old('vehicle_type')=='Tractors' ? 'selected' : ($make->vehicle_type=='Tractors' ? 'selected' : '')}}>Tractors</option>
                                                <option value="Special Purpose Vehicles" {{old('vehicle_type')=='Special Purpose Vehicles' ? 'selected' : ($make->vehicle_type=='Special Purpose Vehicles' ? 'selected' : '')}}>Special Purpose Vehicles</option>
                                            </select>
                                            @error('vehicle_type')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                        <div class="form-group role_main_div" id="special_purpose_vehicles">
                                        <label >Special Purpose Vehicle</label>
                                            <select name="special_purpose_vehicles"  class=" form-control show-tick ms select2">
                                                <option value="">Select Special Purpose Vehicle</option>
                                                <option value="Mob Control Vehicle" {{$make->special_purpose_vehicle=='Mob Control Vehicle' ? 'selected' : ''}}>Mob Control Vehicle</option>
                                                <option value="Fire Tender" {{$make->special_purpose_vehicle=='Fire Tender' ? 'selected' : ''}}>Fire Tender</option>
                                                <option value="Ambulance" {{$make->special_purpose_vehicle=='Ambulance' ? 'selected' : ''}}>Ambulance</option>
                                                <option value="Morchery Van" {{$make->special_purpose_vehicle=='Morchery Van' ? 'selected' : ''}}>Morchery Van</option>
                                                <option value="Dog Van" {{$make->special_purpose_vehicle=='Dog Van' ? 'selected' : ''}}>Dog Van</option>
                                            </select>
                                            @error('special_purpose_vehicles')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>

                                        <div class="form-group text-right">  
                                            <input type="hidden" name="make_id" value="{{$make_id}}"/>
                                            <button type="submit" class="btn btn-primary">Create Make/Model</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
$(function(){
    var selected_vehicle_type="{{old('vehicle_type') ? old('vehicle_type') : $make->vehicle_type}}";
    if(selected_vehicle_type=='Special Purpose Vehicles'){
        $("#special_purpose_vehicles").show();
    }
    else{
        $("#special_purpose_vehicles").hide();
    }

    $(".make_form").validate({
        rules: {
            make:{
                required: true
            },
            vehicle_type:{
                required: true
            },
            special_purpose_vehicles: {
                required: "Special purpose vehicles are mandatory when the vehicle type is 'Special Purpose Vehicles'"
            }
        },
        messages: {
            make: {
                required: "Please enter a valid make"
            },
            vehicle_type:{
                required: "Please enter a valid vehicle type"
            },
            special_purpose_vehicles: {
                required: "Special purpose vehicles are mandatory when the vehicle type is 'Special Purpose Vehicles'"
            }
        }
    });

    $("#vehicle_type").change(function(){
        if($(this).val()=='Special Purpose Vehicles'){
            $("#special_purpose_vehicles").show();
        }
        else{
            $("#special_purpose_vehicles").val("");
            $("#special_purpose_vehicles").hide();
        }
    })
})
</script>
@include('dashboardCommonLayout.footer')