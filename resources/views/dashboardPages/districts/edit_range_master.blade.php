@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Edit Range </h2>
               
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
                            <form name="frm" class="range_form" method="POST" action="{{route('update_range_master')}}">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                    <div class="row">
                                        <div class="form-group role_main_div col-md-6 col-sm-12">     
                                        <label>Zone</label>    
                                        <select  class=" form-control show-tick ms select2" name="zone">
                                            <option value="">Select Zone</option>
                                            @foreach($all_zones as $key=>$val)
                                            <option value="{{$val->id}}" {{old('zone')==$val->id ? 'selected' : ($range_information->zone_id==$val->id ? 'selected' : '')}}>{{$val->zone}}</option>
                                            @endforeach
                                        </select>
                                            @error('zone')
								                <label class="error help-block">{{ $message }}</label>
                			                @enderror
                                        </div>
                                     
                                        <div class="form-group role_main_div col-md-6 col-sm-12">     
                                        <label>Range</label>                              
                                            <input type="text" class="form-control" placeholder="Range" name="range" id="range" value="{{old('range') ? old('range') : $range_information->range}}" />

                                            @error('range')
								                <label class="error help-block">{{ $message }}</label>
                			                @enderror
                                        </div>
                                    </div>
                                        <div class="form-group text-right">  
                                            <input type="hidden" name="range_id" value="<?php echo Crypt::encryptString($range_information->id); ?>"/>
                                            <button type="submit" class="btn btn-primary">Edit Range</button>
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
    $(".range_form").validate({
        rules: {
            zone:{
                required: true
            },
            range:{
                required: true
            }
        },
        messages: {
            zone: {
                required: "Please select a valid zone"
            },
            range:{
                required: "Please enter a valid Range"
            }
        }
    });
})
</script>
@include('dashboardCommonLayout.footer')