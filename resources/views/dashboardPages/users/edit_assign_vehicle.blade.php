@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Edit Assign Vehicle</h2>
    
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
                            <form name="frm" class="edit_assign_vehicle" method="POST" action="{{route('update_assigned_vehicle')}}">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="row">
                                        <div class="form-group role_main_div col-lg-6 col-sm-12">
                                        <label>Users</label> 
                                            <select name="user" id="user" class=" show-tick ms select2 w-100" disabled>
                                                <option value="">Select user</option>
                                                @foreach($users_list as $key=>$val)
                                                    <option value="{{$val->id}}" {{old('user')==$val->id ? 'selected' : ($assigned_vehicle_info->user_id==$val->id ? 'selected' : '')}}>{{$val->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('user')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group role_main_div col-lg-6 col-sm-12">
                                        <label>Vehicle Registration Number</label> 
                                           <select name="registration_number" id="registration_number" class=" w-100 show-tick ms select2">
                                                <option value="">Select Vehicle Registration Number</option>
                                                @foreach($vehicles_list as $key=>$val)
                                                    <option value="{{$val->id}}" {{old('registration_number')==$val->id ? 'selected' : ($assigned_vehicle_info->vehicle_id==$val->id ? 'selected' : '')}}>{{$val->registration_number}}</option>
                                                @endforeach
                                            </select>
                                            @error('registration_number')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                      </div>
                                        <div class="form-group text-right mt-2">  
                                            <input type="hidden" name="assigned_vehicle_id" value="{{$encryptedAssignedId}}"/>
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
    $(".edit_assign_vehicle").validate({
        rules: {
            registration_number:{
                required: true
            }
        },
        messages: {
            registration_number: {
                required: "Please select a valid registration number"
            }
        }
    });
    $('.select2').select2();
    $(".search-select").select2({
        allowClear: true
    });
})
</script>
@include('dashboardCommonLayout.footer')