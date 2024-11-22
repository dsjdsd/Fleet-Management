@include('dashboardCommonLayout.sidebar')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Districts</h2>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>                                
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <form action="{{ url('district-post') }}" method="POST" class="district_form">
                                @csrf
                                     <div class="row">
                                         <div class="form-group role_main_div col-md-6 col-sm-12">     
                                        <label>Zone</label>    
                                        <select class="form-control show-tick ms select2" name="zone" id="zone">
                                            <option value="">Select Zone</option>
                                            @foreach($all_zones as $key=>$val)
                                                <option value="{{$val->id}}" {{old('zone')==$val->id ? 'selected' : ($district_detail->zone_id==$val->id ? 'selected' : '')}}>{{$val->zone}}</option>
                                            @endforeach
                                        </select>
                                            @error('zone')
								                <label class="error help-block">{{ $message }}</label>
                			                @enderror
                                        </div>
                                        <div class="form-group role_main_div col-md-6 col-sm-12">     
                                        <label>Range</label>    
                                        <select class=" form-control show-tick ms select2" name="range" id="range">
                                            <option value="">Select Range</option>
                                            @foreach($all_ranges as $key=>$val)
                                            <option value="{{$val->id}}" {{old('range')==$val->id ? 'selected' : ($district_detail->range_id==$val->id ? 'selected' : '')}}>{{$val->range}}</option>
                                            @endforeach
                                        </select>
                                            @error('range')
								                <label class="error help-block">{{ $message }}</label>
                			                @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="form-group make_main_div col-md-6 col-sm-12">
                                    <label>District</label>                                    
                                    <input type="text" class="form-control" name="district" placeholder="Enter District Name" value="{{old('district') ? old('district') : $district_detail->district}}">

                                    @error('district')
                                        <label class="error help-block">{{ $message }}</label>
                                    @enderror
                                    </div>

                                    <div class="form-group make_main_div col-md-6 col-sm-12">
                                    <label>District Code</label>      
                              
                                    <input type="text" class="form-control" name="district_code" placeholder="Enter District Code" value="{{old('district_code') ? old('district_code') : $district_detail->code}}">

                                    @error('district_code')
                                        <label class="error help-block">{{ $message }}</label>
                                    @enderror
                                </div>
                                </div>
                                <div class="form-group make_main_div">
                                    <label>District HeadQuarter</label>      
                                    <input type="text" class="form-control" name="district_headquarter" placeholder="Enter District HeadQuarter" value="{{old('district_headquarter') ? old('district_headquarter') : $district_detail->headquarter}}">
                                    @error('district_headquarter')
                                        <label class="error help-block">{{ $message }}</label>
                                    @enderror
                                </div>

                                <div class="form-group text-right mt-2">  
                                    <input type="hidden" class="form-control" value="{{Crypt::encryptString($district_detail->id)}}" name="id"/>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>                       
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>
@include('dashboardCommonLayout.footer')
<script>
$(function(){
    $(".district_form").validate({
        rules: {
            zone:{
                required: true
            },
            range:{
                required: true
            },
            state:{
                required: true
            },
            district:{
                required: true
            },
            district_code:{
                required: true
            },
            district_headquarter:{
                required: true
            }
        },
        messages: {
            zone: {
                required: "Please select a valid Zone"
            },
            range: {
                required: "Please select a valid Range"
            },
            state: {
                required: "Please enter a valid State"
            },
            district:{
                required: "Please enter a valid District"
            },
            district_code:{
                required: "Please enter a valid District Code"
            },
            district_headquarter:{
                required: "Please enter a valid District Headquarter"
            }
        }
    });

    $("#zone").on("change",function(){
        var zone_id=$(this).val();
        $.ajax({
            url: "{{ route('get_zone_range') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                'zone_id': zone_id
            },
            type: 'POST',
            success: function(result) {
                $('#range').html(result)
            }
        });
    })
})
</script>