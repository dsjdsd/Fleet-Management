@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Edit Fuel</h2>
    
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
                                        <label>Vehicle Number</label> 
                                             <select name="vehicle_number" id="vehicle_number" class="w-100 show-tick ms select2">
                                            <option value="">Select Vehicle Number</option>
                                                <option value="Patrol Cars">UP 32 GK 0000</option>
                                                <option value="Jeep">UP 32 GK 0000</option>
                                                <option value="SUV">UP 32 GK 0000</option>
                                            </select>
                                            @error('vehicle_number')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>Driver</label> 
                                            <select name="driver " id="driver" class="w-100 show-tick ms select2">
                                                <option value="">Select Driver </option>
                                                <option value="Patrol Cars">Driver 1</option>
                                                <option value="Jeep">Driver 2</option>
                                                <option value="SUV">Driver 3</option>
                                            </select>
                                            @error('driver')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>PNO Number</label> 
                                            <select name="pno_number " id="pno_number" class=" form-control show-tick ms">
                                                <option value="">Select PNO Number </option>
                                                <option value="Patrol Cars">123456789</option>
                                                <option value="Jeep">654102789</option>
                                                <option value="SUV">987456789</option>
                                            </select>
                                            @error('pno_number')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>Cost</label> 
                                        <input type="number" class="form-control" placeholder="Cost" name="cost" id="cost" value="{{old('make')}}" />
                                            @error('cost')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        </div>
                                        <div class="form-group role_main_div ">
                                        <label>Service Date</label> 
                                        <input type="text" class="form-control date_field" placeholder="Service Date" name="service_date" id="service_date" value="{{old('make')}}" />
                                            @error('service_date')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group make_main_div">   
                                        <label>Receipt</label>                                 
                                            <input type="file" class="dropify" placeholder="Receipt" name="receipt" id="receipt" />

                                            @error('receipt')
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