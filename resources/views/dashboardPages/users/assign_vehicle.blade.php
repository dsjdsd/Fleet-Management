@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Assign Vehicle</h2>
    
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
                            <form name="frm" class="assign_vehicle" method="POST" action="{{route('allocate_vehicle')}}">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="row">
                                        <div class="form-group role_main_div col-lg-6 col-sm-12">
                                        <label>Users</label> 
                                          <select name="user" id="user" class=" w-100 show-tick ms select2">
                                                <option value="">Select user</option>
                                                @foreach($users_list as $key=>$val)
                                                    <option value="{{$val->id}}">{{$val->name}}</option>
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
                                                    <option value="{{$val->id}}">{{$val->registration_number}}</option>
                                                @endforeach
                                            </select>
                                            @error('registration_number')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
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
    $(".assign_vehicle").validate({
        rules: {
            user:{
                required: true
            },
            registration_number:{
                required: true
            }
        },
        messages: {
            user: {
                required: "Please select user to assign vehicle"
            },
            registration_number:{
                required: "Please select vehicle to assign"
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