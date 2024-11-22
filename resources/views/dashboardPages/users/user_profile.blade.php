@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Profile</h2>
    
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
                            <form name="frm" class="user_form" method="POST" action="{{route('update_user_profile')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                    <div class="row">
                                        <div class="form-group make_main_div col-md-6 col-sm-12">  
                                        <label>Name</label>                                   
                                            <input type="text" class="form-control" placeholder="Name" name="name" id="name" value="{{old('name') ? old('name') : auth()->user()->name}}" />

                                            @error('name')
								                <label class="error help-block">{{ $message }}</label>
                			                @enderror
                                        </div>
                                        <div class="form-group make_main_div col-md-6 col-sm-12">  
                                        <label>Pno Number</label>                                   
                                            <input type="number" class="form-control" placeholder="Pno Number" name="pno_number" id="pno_number" value="{{old('pno_number') ? old('pno_number') : auth()->user()->pno_number}}" maxlength="9"/>

                                            @error('pno_number')
								                <label class="error help-block">{{ $message }}</label>
                			                @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group make_main_div col-md-6 col-sm-12">  
                                        <label>D.O.B.</label>                                   
                                            <input type="text" class="form-control" placeholder="D.O.B." name="dob" id="dob" value="{{old('dob') ? old('dob') : \Carbon\Carbon::parse(auth()->user()->dob)->format('d-M-Y')}}" />

                                            @error('dob')
								                <label class="error help-block">{{ $message }}</label>
                			                @enderror
                                        </div>
                                        <div class="form-group make_main_div col-md-6 col-sm-12">   
                                        <label>Contact Number</label>                                  
                                            <input type="text" class="form-control" placeholder="Contact Number" name="contact_number" id="contact_number" value="{{old('contact_number') ? old('contact_number') : auth()->user()->contact_number}}" />
                                            @error('contact_number')
								                <label class="error help-block">{{ $message }}</label>
                			                @enderror
                                        </div>
                                        </div>
                                        <div class="form-group role_main_div">
                                        <label>District Posted</label> 
                                            <select name="district" id="district" class=" form-control show-tick ms select2">
                                                <option value="">Select District</option>
                                                @foreach($districts as $key=>$val)
                                                    <option value="{{$val->id}}" {{old('district')==$val->id ? 'selected': (auth()->user()->district==$val->id ? 'selected' : '')}}>{{$val->district}}</option>
                                                @endforeach
                                            </select>
                                            @error('district')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                  
                                        <div class="form-group make_main_div">   
                                        <label>Profile Image</label>                                 
                                            <input type="file" class="dropify" placeholder="Profile" name="profile_image" id="profile_image" accept="image/*"/>

                                            @error('profile_image')
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
    $(".edit_user_form").validate({
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
</script>
@include('dashboardCommonLayout.footer')