@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Edit Vehicle Inventory</h2>
    
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
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <input type="hidden" name="vehicle_inventory_id" value="{{$inventory->id}}">
                                    <div class="row">
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>Modal</label> 
                                        <select name="modal_id" id="modal_id" class="form-control show-tick ms select2">
                                            <option value="">-- select modal --</option>
                                            @foreach($vehicle_make as $vehicle_make)
                                            <option value="{{$vehicle_make->id}}" <?php if($inventory->modal_id==$vehicle_make->id){echo"selected";}?>>{{$vehicle_make->make}}</option>
                                            @endforeach
                                        </select>
                                            @error('modal_id')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>Modal Color</label> 
                                            <select name="color_name" id="color_name" class="form-control show-tick ms select2">
                                                <option value="Blue" <?php if($inventory->color_name=="Blue"){echo"selected";}?>>Blue</option>
                                                <option value="Black" <?php if($inventory->color_name=="Black"){echo"selected";}?>>Black</option>
                                                <option value="White" <?php if($inventory->color_name=="White"){echo"selected";}?>>White</option>
                                                <option value="Smoke Grey" <?php if($inventory->color_name=="Smoke Grey"){echo"selected";}?>>Smoke Grey</option>
                                                <option value="Yellow" <?php if($inventory->color_name=="Yellow"){echo"selected";}?>>Yellow</option>
                                                <option value="Gray" <?php if($inventory->color_name=="Gray"){echo"selected";}?>>Gray</option>
                                                <option value="Khaki" <?php if($inventory->color_name=="Khaki"){echo"selected";}?>>Khaki</option>
                                                <option value="Red" <?php if($inventory->color_name=="Red"){echo"selected";}?>>Red</option>
                                                <option value="Green" <?php if($inventory->color_name=="Green"){echo"selected";}?>>Green</option>
                                                <option value="Dolphine" <?php if($inventory->color_name=="Dolphine"){echo"selected";}?>>Dolphine</option>
                                                <option value="Neptune Blue" <?php if($inventory->color_name=="Neptune Blue"){echo"selected";}?>>Neptune Blue</option>
                                                <option value="Fawn Beige" <?php if($inventory->color_name=="Fawn Beige"){echo"selected";}?>>Fawn Beige</option>
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
                                                <option value="Patrol Cars" <?php if($inventory->vehicle_type=="Patrol Cars"){echo"selected";}?>>Patrol Cars</option>
                                                <option value="Jeep" <?php if($inventory->vehicle_type=="Jeep"){echo"selected";}?>>Jeep</option>
                                                <option value="SUV" <?php if($inventory->vehicle_type=="SUV"){echo"selected";}?>>SUV</option>
                                            </select>
                                            @error('vehicle_type')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>Number of Vehicle</label> 
                                        <input type="text" class="form-control" placeholder="Number of Vehicle" name="vehicle_numbers" id="vehicle_numbers" value="{{$inventory->vehicle_numbers}}" />
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
                                            <option value="{{$district->id}}" <?php if($inventory->deployed_districts==$district->id){echo"selected";}?>>{{$district->district}}</option>
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
            color_id:{
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
            color_id: {
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