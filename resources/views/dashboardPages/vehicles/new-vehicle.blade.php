@include('dashboardCommonLayout.sidebar')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Vehicle</h2>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                            class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                            class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <form action="{{ url('new-vehicle') }}" method="POST" class="make_form">
                        <div class="body">
                            @csrf
                                <div class="row">
                                    <div class="form-group make_main_div col-md-6 col-sm-12">
                                        <label>Registration Number</label>
                                        <input type="text" class="form-control" id="registration_number" name="registration_number" placeholder="Registration Number" value="{{old('registration_number')}}">
                                        @error('registration_number')
                                            <label class="error help-block">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="form-group make_main_div col-md-6 col-sm-12">
                                    <label>Upp Number</label>
                                        <input type="text" class="form-control" id="upp_number" name="upp_number" placeholder="UPP Number" value="{{old('upp_number')}}">
                                    @error('upp_number')
                                    <label class="error help-block">{{ $message }}</label>
                                    @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group make_main_div col-md-6 col-sm-12">
                                    <label>Chasis Number</label>
                                    <input type="text" class="form-control" id="chasis_number" name="chasis_number" placeholder="Chasis Number" value="{{old('chasis_number')}}">
                                    @error('chasis_number')
                                    <label class="error help-block">{{ $message }}</label>
                                    @enderror
                                    </div>
                                    <div class="form-group make_main_div col-md-6 col-sm-12">
                                    <label>Engine Number</label>
                                    <input type="text" class="form-control" id="engine_number" name="engine_number" placeholder="Engine Number" value="{{old('engine_number')}}">
                                    @error('engine_number')
                                    <label class="error help-block">{{ $message }}</label>
                                    @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group make_main_div col-md-6 col-sm-12">
                                    <label>Vehicle Make</label>
                                        <select name="vehicle_make" id="vehicle_make" class="form-control show-tick ms select2">
                                            <option value="">-- select vehicle make --</option>
                                            @foreach($vehicle_make as $vehicle_make)
                                            <option value="{{$vehicle_make->make}}" <?php if(old('vehicle_make')==$vehicle_make->make){echo"selected";}?>>{{$vehicle_make->make}}</option>
                                            @endforeach
                                        </select>
                                        @error('vehicle_make')
                                        <label class="error help-block">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="form-group make_main_div col-md-6 col-sm-12">
                                    <label>Vehicle Color</label>
                                        <select name="vehicle_color" id="vehicle_color" class="form-control form-control show-tick ms select2">
                                            <option value="">-- select vehicle color --</option>
                                            <option value="Blue"  <?php if(old('vehicle_color')=="Blue"){echo"selected";}?>>Blue</option>
                                            <option value="Black" <?php if(old('vehicle_color')=="Black"){echo"selected";}?>>Black</option>
                                            <option value="White" <?php if(old('vehicle_color')=="White"){echo"selected";}?>>White</option>
                                            <option value="Smoke Grey" <?php if(old('vehicle_color')=="Smoke Grey"){echo"selected";}?>>Smoke Grey</option>
                                            <option value="Yellow" <?php if(old('vehicle_color')=="Yellow"){echo"selected";}?>>Yellow</option>
                                            <option value="Gray" <?php if(old('vehicle_color')=="Gray"){echo"selected";}?>>Gray</option>
                                            <option value="Khaki" <?php if(old('vehicle_color')=="Khaki"){echo"selected";}?>>Khaki</option>
                                            <option value="Red" <?php if(old('vehicle_color')=="Red"){echo"selected";}?>>Red</option>
                                            <option value="Green" <?php if(old('vehicle_color')=="Green"){echo"selected";}?>>Green</option>
                                            <option value="Dolphine" <?php if(old('vehicle_color')=="Dolphine"){echo"selected";}?>>Dolphine</option>
                                            <option value="Neptune Blue" <?php if(old('vehicle_color')=="Neptune Blue"){echo"selected";}?>>Neptune Blue</option>
                                            <option value="Fawn Beige" <?php if(old('vehicle_color')=="Fawn Beige"){echo"selected";}?>>Fawn Beige</option>
                                        </select>
                                        @error('vehicle_color')
                                        <label class="error help-block">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group make_main_div col-md-6 col-sm-12">
                                    <label> Vehicle District</label>
                                        <select name="vehicle_district" id="vehicle_district" class="form-control form-control show-tick ms select2">
                                            <option value="">-- select vehicle district --</option>
                                            @foreach($districts as $district)
                                            <option value="{{$district->id}}" <?php if(old('vehicle_district')==$district->id){echo"selected";}?>>{{$district->district}}</option>
                                            @endforeach
                                        </select>
                                        @error('vehicle_district')
                                        <label class="error help-block">{{ $message }}</label>
                                        @enderror
                                    </div>
                            
                                    <div class="form-group make_main_div col-md-6 col-sm-12">
                                    <label>Total Run K.M.</label>
                                        <input type="number" class="form-control" id="total_run_km_till_date" name="total_run_km_till_date" placeholder="Total Run KM Till Date" value="{{old('total_run_km_till_date')}}">
                                        @error('total_run_km_till_date')
                                        <label class="error help-block">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group make_main_div col-md-6 col-sm-12">
                                    <label>Attached For Duty</label>
                                        <input type="text" class="form-control" id="attached_for_duty" name="attached_for_duty" placeholder="Attached For Duty" value="{{old('attached_for_duty')}}">
                                        @error('attached_for_duty')
                                        <label class="error help-block">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="form-group make_main_div col-md-6 col-sm-12">
                                        <label>Vehicle Condition</label>
                                        <select name="vehicle_condition" class="form-control show-tick ms select2">
                                            <option value="">-- select vehicle condition --</option>
                                            <option value="Excellent" <?php if(old('vehicle_condition')=="Excellent"){echo"selected";}?>>Excellent</option>
                                            <option value="Satisfactory" <?php if(old('vehicle_condition')=="Satisfactory"){echo"selected";}?>>Satisfactory</option>
                                            <option value="Ready to Condemn" <?php if(old('vehicle_condition')=="Ready to Condemn"){echo"selected";}?>>Ready to Condemn</option>
                                        </select>
                                        @error('vehicle_condition')
                                        <label class="error help-block">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group make_main_div col-md-6 col-sm-12">
                                    <label>Total Repair Cost</label>
                                        <input type="number" class="form-control" id="total_repair_cost" name="total_repair_cost" placeholder="Total Repair Cost" value="{{old('total_repair_cost')}}">
                                        @error('total_repair_cost')
                                        <label class="error help-block">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="form-group make_main_div col-md-6 col-sm-12">
                                    <label>Monthly Fuel Quota</label>
                                        <input type="number" class="form-control" id="monthly_fuel_quota" name="monthly_fuel_quota" placeholder="Monthly Fuel Quota" value="{{old('monthly_fuel_quota')}}">
                                        @error('monthly_fuel_quota')
                                        <label class="error help-block">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group make_main_div col-md-6 col-sm-12">
                                    <label>PHQ Logistics Order No</label>
                                        <input type="text" class="form-control" id="phq_logistics_order_no" name="phq_logistics_order_no" placeholder="PHQ Logistics Order No" value="{{old('phq_logistics_order_no')}}">
                                        @error('phq_logistics_order_no')
                                        <label class="error help-block">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="form-group make_main_div col-md-6 col-sm-12">
                                    <label>Date Of Allotment</label>
                                    <input type="text" class="form-control" placeholder="Date Of Allotment" name="date_of_allotment" id="date_of_allotment" value="{{old('date_of_allotment')}}"/>
                                    @error('date_of_allotment')
                                    <label class="error help-block">{{ $message }}</label>
                                    @enderror
                                </div>
                                </div>
                           
                                    <div class="form-group make_main_div">
                                        <label>Petro Card Number</label>
                                            <input type="text" class="form-control" id="petro_card_number" name="petro_card_number" placeholder="Petro Card Number" value="{{old('petro_card_number')}}">
                                            @error('petro_card_number')
                                            <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                            
                                <div class="form-group text-right mt-2">  
                                    <button class="btn btn-primary" type="submit" >Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(function(){
        $(".make_form").validate({
            rules: {
                registration_number:{
                    required: true
                },
                upp_number:{
                    required: true
                },
                chasis_number:{
                    required: true
                },
                engine_number:{
                    required: true
                },
                vehicle_make:{
                    required: true
                },
                vehicle_color:{
                    required: true
                },
                vehicle_district:{
                    required: true
                },
                total_run_km_till_date:{
                    required: true
                },
                attached_for_duty:{
                    required: true
                },
                vehicle_condition:{
                    required: true
                },
                total_repair_cost:{
                    required: true
                },
                monthly_fuel_quota:{
                    required: true
                },
                petro_card_number:{
                    required: true
                },
                phq_logistics_order_no:{
                    required: true
                },
                date_of_allotment:{
                    required: true
                },
            },
            messages: {
                registration_number: {
                    required: "Please enter a valid registration number"
                },
                upp_number:{
                    required: "Please enter a valid upp number"
                },
                chasis_number:{
                    required: "Please enter a valid chasis number"
                },
                engine_number:{
                    required: "Please enter a valid engine number"
                },
                vehicle_make:{
                    required: "Please enter a valid vehicle make"
                },
                vehicle_color:{
                    required: "Please enter a valid vehicle color"
                },
                vehicle_district:{
                    required: "Please enter a valid vehicle district"
                },
                total_run_km_till_date:{
                    required: "Please enter a valid total run km till date"
                },
                attached_for_duty:{
                    required: "Please enter a valid attached for duty"
                },
                vehicle_condition:{
                    required: "Please enter a valid vehicle condition"
                },
                total_repair_cost:{
                    required: "Please enter a valid total repair cost"
                },
                monthly_fuel_quota:{
                    required: "Please enter a valid monthly fuel quota"
                },
                petro_card_number:{
                    required: "Please enter a valid petro card number"
                },
                phq_logistics_order_no:{
                    required: "Please enter a valid phq logistics order no"
                },
                date_of_allotment:{
                    required: "Please enter a valid date of allotment"
                },
            }
        });
    });
var maxBirthdayDate = new Date();
maxBirthdayDate.setFullYear( maxBirthdayDate.getFullYear() - 00,11,31);

$("#date_of_allotment").datepicker({
    dateFormat: 'dd-M-yy',
    changeMonth: true,
    changeYear: true,
    maxDate: maxBirthdayDate,
    yearRange: '1950:'+maxBirthdayDate.getFullYear(),
    beforeShow: function(input, inst) {
        $(input).prop('readonly', true);
    }
});
    </script>
@include('dashboardCommonLayout.footer')