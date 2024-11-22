@include('dashboardCommonLayout.sidebar')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Add Daily Diary</h2>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                            class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <form action="{{ url('create_daily_diary_data') }}" method="POST" class="daily_diary_form">
                            <div class="body">
                                <!-- <h2 class="card-inside-title">Add Vehicle</h2> -->
                                    @csrf
                                    <div class="row">
                                        <div class="form-group make_main_div col-md-6 col-sm-12">
                                            <label>Registration Number</label>
                                            <select name="vehicle" id="vehicle" class=" w-100 show-tick ms select2">
                                                <option value="">Select Vehicle Registration Number</option>
                                                @foreach($vehicles as $key=>$val)
                                                    <option value="{{$val->id}}">{{$val->registration_number}}</option>
                                                @endforeach
                                            </select>
                                            @error('vehicle')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                            <label>Date</label>
                                            <input type="text" class="form-control date_field" placeholder="Date" name="date" id="date" value="{{old('date')}}" />
                                            @error('date')
                                            <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group make_main_div col-md-6 col-sm-12">
                                            <label>Vehicle Type</label>
                                            <select name="vehicle_type" id="vehicle_type" class=" form-control show-tick ms">
                                                <option value="">Select Vehicle Type</option>
                                                <option value="Cars" {{old('vehicle_type')=='Cars' ? 'selected' : ''}}>Cars</option>
                                                <option value="Jeep" {{old('vehicle_type')=='Jeep' ? 'selected' : ''}}>Jeep</option>
                                                <option value="Van" {{old('vehicle_type')=='Van' ? 'selected' : ''}}>Van</option>
                                                <option value="Trucks" {{old('vehicle_type')=='Trucks' ? 'selected' : ''}}>Trucks</option>
                                                <option value="Two Wheelers" {{old('vehicle_type')=='Two Wheelers' ? 'selected' : ''}}>Two Wheelers</option>
                                                <option value="Tractors" {{old('vehicle_type')=='Tractors' ? 'selected' : ''}}>Tractors</option>
                                                <option value="Special Purpose Vehicles" {{old('vehicle_type')=='Special Purpose Vehicles' ? 'selected' : ''}}>Special Purpose Vehicles</option>
                                            </select>
                                            @error('vehicle_type')
                                            <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group make_main_div col-md-6 col-sm-12">
                                            <label>Special Purpose Vehicle</label>
                                            <select name="special_purpose_vehicles" class=" form-control show-tick ms" id="special_purpose_vehicles" disabled>
                                                <option value="">Select Special Purpose Vehicle</option>
                                                <option value="Mob Control Vehicle">Mob Control Vehicle</option>
                                                <option value="Fire Tender">Fire Tender</option>
                                                <option value="Ambulance">Ambulance</option>
                                                <option value="Morchery Van">Morchery Van</option>
                                                <option value="Dog Van">Dog Van</option>
                                            </select>
                                            @error('special_purpose_vehicles')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="form-group make_main_div col-md-6 col-sm-12">
                                            <label>Chasis Number</label>
                                            <input type="text" class="form-control" id="chasis_number" name="chasis_number" placeholder="Chasis Number" value="{{old('chasis_number')}}"/>
                                            @error('chasis_number')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group make_main_div col-md-6 col-sm-12">
                                             <label>Engine Number</label>
                                            <input type="text" class="form-control" id="engine_number" name="engine_number" placeholder="Engine Number" value="{{old('engine_number')}}"/>
                                            @error('engine_number')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group make_main_div col-md-6 col-sm-12">
                                            <label>Cubic Capacity (CC)</label>
                                            <input type="number" class="form-control" id="cubic_capacity" name="cubic_capacity" placeholder="Cubic Capacity (CC)" value="{{old('cubic_capacity')}}"/>
                                            @error('cubic_capacity')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group make_main_div col-md-6 col-sm-12">
                                            <label>No of Cylinder </label>
                                            <input type="number" class="form-control" id="num_cylinders" name="num_cylinders" placeholder="Number Of Cylinders" value="{{old('num_cylinders')}}"/>
                                            @error('num_cylinders')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group make_main_div col-md-6 col-sm-12">
                                            <label>Vehicle Make/Modal</label>
                                            <select name="vehicle_make" id="vehicle_make" class=" form-control show-tick ms">
                                                <option value="">-- Select Vehicle Make --</option>
                                                @foreach($vehicle_makes as $key=>$val)
                                                <option value="{{$val->make}}" {{old('vehile_make')==$val->make ? 'selected' : ''}}>{{$val->make}}</option>
                                                @endforeach
                                            </select>
                                            @error('vehicle_make')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>

                                        <div class="form-group make_main_div col-md-6 col-sm-12">
                                            <label>Ability to Sit or Carry</label>
                                            <select name="ability_sit" id="ability_sit" class=" form-control show-tick ms">
                                                <option value="">Select Ability To Sit/Carry</option>
                                                <option value="Sit">Sit</option>
                                                <option value="Carry">Carry</option>
                                                <option value="Both">Both</option>
                                            </select>
                                            @error('ability_sit')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group make_main_div col-md-6 col-sm-12">
                                            <label>Engine Oil Quantity</label>
                                            <input type="number" class="form-control" id="engine_oil_quantity" name="engine_oil_quantity" placeholder="Engine Oil Quantity" value="{{old('engine_oil_quantity')}}"/>
                                            @error('engine_oil_quantity')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group make_main_div col-md-6 col-sm-12">
                                            <label> Gear Oil Quantity </label>
                                            <input type="number" class="form-control" id="gear_oil_quantity" name="gear_oil_quantity" placeholder="Gear Oil Quantity" value="{{old('gear_oil_quantity')}}"/>
                                            @error('gear_oil_quantity')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group make_main_div col-md-6 col-sm-12">
                                            <label>Average Expense P.D.</label>
                                            <input type="number" class="form-control" id="average_expence" name="average_expence" placeholder="Average Expense P.D." value="{{old('average_expence')}}"/>
                                            @error('average_expence')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group make_main_div col-md-6 col-sm-12">
                                            <label>Date of Purchase</label>
                                            <input type="text" class="form-control date_field" id="purchase_date" name="purchase_date" placeholder="Purchase Date" value="{{old('purchase_date')}}"/>
                                            @error('purchase_date')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group make_main_div col-md-6 col-sm-12">
                                            <label>Date Put Into use</label>
                                            <input type="text" class="form-control date_field" id="usage_date" name="usage_date" placeholder="Use Date" value="{{old('usage_date')}}"/>
                                            @error('usage_date')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>

                                        <div class="form-group make_main_div col-md-6 col-sm-12">
                                            <label>Purchase Price</label>
                                            <input type="number" class="form-control" id="purchase_price" name="purchase_price" placeholder="Purchase Price" value="{{old('purchase_price')}}"/>
                                            @error('purchase_price')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group text-right mt-2">
                                        <input type="submit" name="Submit" value="Submit" class="btn btn-primary"/>
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
$(".date_field").datepicker({
    dateFormat: 'dd-M-yy',
    changeMonth: true,
    changeYear: true,
    yearRange: "1950:2034",
    beforeShow: function(input, inst) {
        $(input).prop('readonly', true);
    }
});

$(function(){
    $("#vehicle_type").change(function(){
        if($(this).val()=='Special Purpose Vehicles'){
            $("#special_purpose_vehicles").prop("disabled", false);
        }
        else{
            $("#special_purpose_vehicles").prop("disabled", true);
        }
    })
})
</script>
@include('dashboardCommonLayout.footer')

<script>
$(function() {
    $(".daily_diary_form").validate({
        rules: {
            date:{
                required: true
            },
            vehicle_type:{
                required: true
            },
            chasis_number:{
                required: true
            },
            engine_number:{
                required: true
            },
            num_cylinders:{
                required: true
            },
            vehicle_make:{
                required: true
            },
            ability_sit:{
                required: true
            },
            engine_oil_quantity:{
                required: true
            },
            gear_oil_quantity:{
                required: true
            },
            average_expence:{
                required: true
            },
            purchase_date:{
                required: true
            },
            usage_date:{
                required: true
            },
            purchase_price:{
                required: true
            }
        },
        messages: {
            date:{
                required: "Please select date"
            },
            vehicle_type:{
                required: "Please select Vehicle Type"
            },
            chasis_number:{
                required: "Please enter chasis number"
            },
            engine_number:{
                required: "Please enter Engine Number"
            },
            num_cylinders:{
                required: "Please enter number of cylinders"
            },
            vehicle_make:{
                required: "Please select vehicle make"
            },
            ability_sit:{
                required: "Please enter ability to sit"
            },
            engine_oil_quantity:{
                required: "Please enter Engine Oil Quantity"
            },
            gear_oil_quantity:{
                required: "Please enter Gear Oil Quantity"
            },
            average_expence:{
                required: "Please enter Average Expenses"
            },
            purchase_date:{
                required: "Please select Purchase Date"
            },
            usage_date:{
                required: "Please select Usage Date"
            },
            purchase_price:{
                required: "Please slect Purchase Price"
            }
        }
    });
})

$('.select2').select2();
    
$('.select2-input').on('input', function() {
    var query = $(this).val();
    $.ajax({
        url: "{{ route('get_diary_vehicle_list') }}",
        dataType: 'json',
        data: {
            q: query // Send the search query to the server
        },
        success: function(data) {
            $('#vehicle').empty();
            $.each(data.items, function(index, item) {
                var option = new Option(item.text, item.id, false, true);
                $('#vehicle').append(option);
            }); 

            // Check if there is only one option left
            if ($('#vehicle option').length === 1) {
                $('#vehicle option').prop('selected', true);
                setTimeout(function() {
                    $('#vehicle').trigger('change');
                }, 2000);
            }
        }
    });
});

$(document).on('change',"#vehicle",function(){
    var selectedOption = $(this).find('option:selected').val();
    $.ajax({
            url : "{{ route('get_diary_vehicle_details') }}",
            data : {"_token": "{{ csrf_token() }}",'vehicle_id':selectedOption},
            type : 'POST',
            dataType: 'json',
            success : function(result){
                $("#chasis_number").val(result.chassis_number);
                $("#engine_number").val(result.engine_number);
                $("#vehicle_make option[value='"+result.make+"']").prop("selected", true);
            }
        });
})
</script>