@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Add Vehicle Inventory</h2>
    
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
                            <form name="frm" class="make_form" method="POST" action="{{route('create_vehicle_inventory')}}">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                    <div class="row">
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>Modal</label> 
                                        <select name="modal_id" id="modal_id" class="form-control show-tick ms select2">
                                            <option value="">-- select modal --</option>
                                            @foreach($vehicle_make as $vehicle_make)
                                            <option value="{{$vehicle_make->id}}">{{$vehicle_make->make}}</option>
                                            @endforeach
                                        </select>
                                            @error('modal_id')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>Modal Color</label> 
                                            <select name="color_name" id="color_name" class="form-control show-tick ms select2">
                                               <option value="">-- select modal color --</option>
                                               <option value="Blue">Blue</option>
                                               <option value="Black">Black</option>
                                               <option value="White">White</option>
                                               <option value="Smoke Grey">Smoke Grey</option>
                                               <option value="Yellow">Yellow</option>
                                               <option value="Gray">Gray</option>
                                               <option value="Khaki">Khaki</option>
                                               <option value="Red">Red</option>
                                               <option value="Green">Green</option>
                                               <option value="Dolphine">Dolphine</option>
                                               <option value="Neptune Blue">Neptune Blue</option>
                                               <option value="Fawn Beige">Fawn Beige</option>
                                            </select>
                                            @error('color_name')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>Vehicle Type</label> 
                                            <select name="vehicle_type" id="vehicle_type" class="form-control show-tick ms select2">
                                            <option value="">Select Vehicle Type</option>
                                                <option value="Patrol Cars">Patrol Cars</option>
                                                <option value="Jeep">Jeep</option>
                                                <option value="SUV">SUV</option>
                                            </select>
                                            @error('vehicle_type')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>Number of Vehicle</label> 
                                        <input type="text" class="form-control" placeholder="Number of Vehicle" name="vehicle_numbers" id="vehicle_numbers" value="{{old('vehicle_numbers')}}" />
                                            @error('vehicle_numbers')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                        <div class="form-group role_main_div">
                                        <label>Deployed District</label> 
                                        <select name="deployed_districts" id="deployed_districts" class="form-control form-control show-tick ms select2">
                                            <option value="">-- select vehicle district --</option>
                                            @foreach($districts as $district)
                                            <option value="{{$district->id}}">{{$district->district}}</option>
                                            @endforeach
                                        </select>
                                            @error('deployed_districts')
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
            modal_id:{
                required: true
            },
            color_name:{
                required: true
            },
            deployed_districts:{
                required: true
            },
            vehicle_type:{
                required: true
            },
            vehicle_numbers:{
                required: true
            },
        },
        messages: {
            modal_id: {
                required: "Please select a modal name"
            },
            color_name: {
                required: "Please select a color name"
            },
            deployed_districts: {
                required: "Please select a deployed districts name"
            },
            vehicle_type: {
                required: "Please select a vehicle type"
            },
            vehicle_numbers: {
                required: "Please enter a vehicle numbers"
            },
        }
    });
})
</script>
@include('dashboardCommonLayout.footer')