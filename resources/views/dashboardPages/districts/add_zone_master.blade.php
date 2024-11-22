@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Add Zone </h2>
              
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
                            <form name="frm" class="zone_form" method="POST" action="{{route('create_zone_master')}}">
                                @csrf
                                <div class="row clearfix">
                                    <div class="form-group role_main_div col-md-6 col-sm-12"> 
                                        <label>Commissionrate</label>
                                        <div class="form-grouprole_main_div">        
                                            <select class="form-control show-tick ms select2" name="commissionrate" id="commissionrate">
                                                <option value="">Select Commissionrate</option>
                                                @foreach($commissionrates as $key=>$val)
                                                <option value="{{$val->id}}">{{$val->comissionrate_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group role_main_div col-md-6 col-sm-12"> 
                                        <label>Zone</label>
                                        <div class="form-grouprole_main_div">        
                                            <input type="text" class="form-control" placeholder="Zone" name="zone" id="zone" value="{{old('zone')}}" />

                                            @error('zone')
								                <label class="error help-block">{{ $message }}</label>
                			                @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group text-right">  
                                            <button type="submit" class="btn btn-primary">Create Zone</button>
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
    $(".zone_form").validate({
        rules: {
            zone:{
                required: true
            }
        },
        messages: {
            zone: {
                required: "Please enter a valid Zone"
            }
        }
    });
})
</script>
@include('dashboardCommonLayout.footer')