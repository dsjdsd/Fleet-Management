@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Add User</h2>
    
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
                            <form name="frm" class="user_form" method="POST" action="{{route('add_new_user')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="form-group make_main_div col-md-6 col-sm-12">  
                                                <label>Name</label>                                   
                                                <input type="text" class="form-control" placeholder="Name" name="name" id="name" value="{{old('name')}}" />

                                                @error('name')
                                                    <label class="error help-block">{{ $message }}</label>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group make_main_div col-md-6 col-sm-12">  
                                                <label>PNO Number</label>    

                                                <input type="number" class="form-control" placeholder="PNO Number" name="pno_number" id="pno_number" value="{{old('pno_number')}}" maxlength="9"/>

                                                @error('pno_number')
                                                    <label class="error help-block">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="form-group make_main_div col-md-6 col-sm-12">  
                                        <label>D.O.B.</label>                                   
                                            <input type="text" class="form-control" placeholder="D.O.B." name="dob" id="dob" value="{{old('dob')}}" />

                                            @error('dob')
								                <label class="error help-block">{{ $message }}</label>
                			                @enderror
                                        </div>
          
                     
                                        <div class="form-group make_main_div col-md-6 col-sm-12">   
                                        <label>Contact Number</label>                                  
                                            <input type="text" class="form-control" placeholder="Contact Number" name="contact_number" id="contact_number" value="{{old('contact_number')}}" />

                                            @error('contact_number')
								                <label class="error help-block">{{ $message }}</label>
                			                @enderror
                                        </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="form-group role_main_div col-md-6 col-sm-12">
                                            <label>District Posted</label> 
                                                <select name="district" id="district" class="form-control show-tick ms select2" data-placeholder="Select">
                                                    <option value="">Select District</option>
                                                    @foreach($districts as $key=>$val)
                                                        <option value="{{$val->id}}" {{old('district')==$val->id ? 'selected': ''}}>{{$val->district}}</option>
                                                    @endforeach()
                                                </select>
                                                @error('district')
                                                    <label class="error help-block">{{ $message }}</label>
                                                @enderror
                                            </div>
                                            <div class="form-group role_main_div col-md-6 col-sm-12">
                                            <label>Role</label> 
                                                <select name="role" id="role" class="form-control show-tick ms select2">
                                                    <option value="">Select Role</option>
                                                    @foreach($roles as $key=>$val)
                                                        <option value="{{$val->name}}" {{old('role')==$val->name ? 'selected' : ''}}>{{ucfirst($val->name)}}</option>
                                                    @endforeach
                                                </select>
                                                @error('role')
                                                    <label class="error help-block">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group make_main_div col-md-6 col-sm-12">  
                                                <label>Father Name</label>                                   
                                                <input type="text" class="form-control" placeholder="Father Name" name="father_name" id="father_name" value="{{old('father_name')}}" />

                                                @error('name')
                                                    <label class="error help-block">{{ $message }}</label>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group make_main_div col-md-6 col-sm-12">  
                                                <label>Caste</label>    

                                                <input type="text" class="form-control" placeholder="Caste" name="caste" id="caste" value="{{old('caste')}}"/>

                                                @error('caste')
                                                    <label class="error help-block">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group make_main_div col-md-6 col-sm-12">  
                                                <label>Job Joining Date</label>    

                                                <input type="text" class="form-control" placeholder="Joining Date" name="joining_date" id="joining_date" value="{{old('joining_date')}}" />

                                                @error('joining_date')
                                                    <label class="error help-block">{{ $message }}</label>
                                                @enderror
                                            </div>

                                            <div class="form-group make_main_div col-md-6 col-sm-12">  
                                                <label>Home Town</label>    

                                                <input type="text" class="form-control" placeholder="Home Town" name="home_town" id="home_town" value="{{old('home_town')}}" />

                                                @error('home_town')
                                                    <label class="error help-block">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group make_main_div col-md-6 col-sm-12">  
                                                <label>Joining date As Reserve Driver</label>                                   
                                                <input type="text" class="form-control" placeholder="Joining date As Reserve Driver" name="reserve_driver_joining_date" id="reserve_driver_joining_date" value="{{old('reserve_driver_joining_date')}}" />

                                                @error('name')
                                                    <label class="error help-block">{{ $message }}</label>
                                                @enderror
                                            </div>

                                            <div class="form-group make_main_div col-md-6 col-sm-12">  
                                                <label>Joining date As Main Reserve Driver</label>    

                                                <input type="text" class="form-control" placeholder="Joining date As Main Reserve Driver" name="main_reserve_driver_joining_date" id="main_reserve_driver_joining_date" value="{{old('main_reserve_driver_joining_date')}}"/>

                                                @error('pno_number')
                                                    <label class="error help-block">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group make_main_div col-md-6 col-sm-12">  
                                                <label>Current District Joining Date</label>                                   
                                                <input type="text" class="form-control" placeholder="Current District Joining Date" name="current_distrtict_joining_date" id="current_distrtict_joining_date" value="{{old('current_distrtict_joining_date')}}" />

                                                @error('current_distrtict_joining_date')
                                                    <label class="error help-block">{{ $message }}</label>
                                                @enderror
                                            </div>

                                            <div class="form-group make_main_div col-md-6 col-sm-12">  
                                                <label>Remark</label>    

                                                <input type="text" class="form-control" placeholder="Remark" name="other_comments" id="other_comments" value="{{old('other_comments')}}" />

                                                @error('other_comments')
                                                    <label class="error help-block">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group make_main_div">   
                                        <label>Profile Image</label>                                 
                                            <input type="file" class="dropify" placeholder="Profile" name="profile_image" id="profile_image" accept="image/*"/>

                                            @error('profile_image')
								                <label class="error help-block">{{ $message }}</label>
                			                @enderror
                                        </div>
                                        <div class="form-group text-right mt-2">  
                                            <button type="submit" class="btn btn-primary">Create  User Account</button>
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
    $(".user_form").validate({
        rules: {
            name:{
                required: true
            },
            pno_number:{
                required: true
            },
            dob:{
                required: true
            },
            contact_number:{
                required: true
            },
            district:{
                required: true
            },
            role:{
                required: true
            },
            father_name:{
                required: true
            },
            caste:{
                required: true
            },
            joining_date:{
                required: true
            },
            home_town:{
                required: true
            },
            reserve_driver_joining_date:{
                required: true
            },
            main_reserve_driver_joining_date:{
                required: true
            },
            current_distrtict_joining_date:{
                required: true
            }
        },
        messages: {
            name:{
                required: "Please enter a valid name"
            },
            pno_number:{
                required: "Please enter a valid PNO number"
            },
            dob:{
                required: "Please select a valid dob"
            },
            contact_number:{
                required: "Please enter a valid contact number"
            },
            district:{
                required: "Please enter a valid district"
            },
            role:{
                required: "Please enter a valid role"
            },
            father_name:{
                required: "Please enter a father name"
            },
            caste:{
                required: "Please enter caste"
            },
            joining_date:{
                required: "Please select joining date"
            },
            home_town:{
                required: "Please select home town"
            },
            reserve_driver_joining_date:{
                required: "Reserve Driver Joining Date"
            },
            main_reserve_driver_joining_date:{
                required: "Select Main Reserve Joining Date"
            },
            current_distrtict_joining_date:{
                required: "Current District Joining Date"
            }
        }
    });
})

var maxBirthdayDate = new Date();
maxBirthdayDate.setFullYear( maxBirthdayDate.getFullYear() - 18,11,31);

$("#dob").datepicker({
    dateFormat: 'dd-M-yy',
    changeMonth: true,
    changeYear: true,
    maxDate: maxBirthdayDate,
    yearRange: '1950:'+maxBirthdayDate.getFullYear(),
    beforeShow: function(input, inst) {
        $(input).prop('readonly', true);
    }
});

var currentYear = new Date().getFullYear();

$("#joining_date").datepicker({
    dateFormat: 'dd-M-yy',
    changeMonth: true,
    changeYear: true,
    yearRange: '1950:'+currentYear,
    beforeShow: function(input, inst) {
        $(input).prop('readonly', true);
    }
});

$("#reserve_driver_joining_date").datepicker({
    dateFormat: 'dd-M-yy',
    changeMonth: true,
    changeYear: true,
    yearRange: '1950:'+currentYear,
    beforeShow: function(input, inst) {
        $(input).prop('readonly', true);
    }
});

$("#main_reserve_driver_joining_date").datepicker({
    dateFormat: 'dd-M-yy',
    changeMonth: true,
    changeYear: true,
    yearRange: '1950:'+currentYear,
    beforeShow: function(input, inst) {
        $(input).prop('readonly', true);
    }
});

$("#current_distrtict_joining_date").datepicker({
    dateFormat: 'dd-M-yy',
    changeMonth: true,
    changeYear: true,
    yearRange: '1950:'+currentYear,
    beforeShow: function(input, inst) {
        $(input).prop('readonly', true);
    }
});
</script>
@include('dashboardCommonLayout.footer')