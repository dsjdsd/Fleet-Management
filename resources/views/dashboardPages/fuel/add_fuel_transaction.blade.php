@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Add Fuel Transactions</h2>
    
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
                            <!-- <h2 class="card-inside-title">New Make/Model</h2> -->
                            <form name="frm" class="make_form" method="POST" action="{{route('create_make')}}">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                    <div class="row">
                                      <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>Vehicle</label> 
                                         <select name="vehicle_number" id="vehicle_number" class="w-100 show-tick ms select2">
                                            <option value="">Select Vehicle</option>
                                                <option value="Patrol Cars">UP 32 GK 0000</option>
                                                <option value="Jeep">UP 32 GK 0000</option>
                                                <option value="SUV">UP 32 GK 0000</option>
                                            </select>
                                            @error('vehicle_number')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>Fuel Type</label> 
                                            <select name="fuel_type " id="fuel_type" class="form-control show-tick ms">
                                                <option value="">Select Fuel Type </option>
                                                <option value="Patrol Cars">Petrol</option>
                                                <option value="Jeep">Diesel</option>
                                            </select>
                                            @error('fuel_type')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>Added Staff</label> 
                                            <select name="staff " id="staff" class=" form-control show-tick ms">
                                                <option value="">Select Added Staff </option>
                                                <option value="Patrol Cars">Driver 1</option>
                                                <option value="Jeep">Driver 2</option>
                                                <option value="SUV">Driver 3</option>
                                            </select>
                                            @error('staff')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                   
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>Fill Date</label> 
                                        <input type="text" class="form-control date_field" placeholder="Fill Date" name="fill_date" id="fill_date" value="{{old('make')}}" />
                                            @error('fill_date')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>Fuel (in liter)</label> 
                                        <input type="number" class="form-control" placeholder="Fuel (in liter)" name="fuel" id="fuel" value="{{old('make')}}" />
                                            @error('fuel')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>    
                                         <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>Amount</label> 
                                        <input type="number" class="form-control" placeholder="Amount" name="amount" id="amount" value="{{old('make')}}" />
                                            @error('amount')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        </div>

                                        <div class="form-group role_main_div ">
                                
                                        <input type="checkbox" class=""  name="expense" id="expense" value="{{old('make')}}" />
                                            
                                        <label>Need to add in expense?</label> 
                                        @error('expense')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group text-right mt-2">  
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
    $(".make_form").validate({
        rules: {
            make:{
                required: true
            }
        },
        messages: {
            make: {
                required: "Please enter a valid make"
            }
        }
    });
    $('.select2').select2();
    $(".search-select").select2({
        allowClear: true
    });
})
$(".date_field").datepicker({
    dateFormat: 'dd-M-yy',
    changeMonth: true,
    changeYear: true,
    yearRange: "1950:2034",
    beforeShow: function(input, inst) {
        $(input).prop('readonly', true);
    }
});
</script>
@include('dashboardCommonLayout.footer')