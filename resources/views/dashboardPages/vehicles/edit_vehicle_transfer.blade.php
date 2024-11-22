@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Edit Vehicle transfer </h2>
            
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
                            <form name="frm" class="role_form" method="POST" action="{{route('create_vehicle_transfer')}}">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                    <div class="row">
                                        <div class="form-group role_main_div col-lg-6 col-sm-12">
                                            <input type="hidden" name="vehicle_transfer_id" value="{{$transfer->id}}">     
                                        <label>Vehicle Number</label>    
                                        <select id="vehicle_id" name="vehicle_id" class="  w-100 show-tick ms select2">
                                        <option value="">Select Vehicle Number</option>
                                            @foreach($vehicles as $vehicle)
                                            <option value="{{$vehicle->id}}" <?php if($transfer->vehicle_id==$vehicle->id){echo"selected";}?>>{{$vehicle->registration_number}}</option>
                                            @endforeach
                                        </select>
                                            @error('vehicle_id')
								                <label class="error help-block">{{ $message }}</label>
                			                @enderror
                                        </div>
                                     
                                        <div class="form-group role_main_div col-lg-6 col-sm-12">     
                                        <label>Zone</label>    
                                        <select id="zone_id" name="zone_id"  class=" form-control show-tick ms">
                                            <option value="">Select Zone</option>
                                            @foreach($zones as $zone)
                                            <option value="{{$zone->id}}" <?php if($transfer->zone_id==$zone->id){echo"selected";}?>>{{$zone->zone}}</option>
                                            @endforeach
                                        </select>
                                            @error('zone_id')
								                <label class="error help-block">{{ $message }}</label>
                			                @enderror
                                        </div>
                                   </div>
                                   <div class="row">
                                        <div class="form-group role_main_div col-lg-6 col-sm-12">     
                                        <label>Range</label>    
                                        <select  id="range_id" name="range_id" class=" form-control show-tick ms">
                                            <option value="">Select Range</option>
                                            @foreach($ranges as $range)
                                            <option value="{{$range->id}}" <?php if($transfer->range_id==$range->id){echo"selected";}?>>{{$range->range}}</option>
                                            @endforeach
                                        </select>
                                            @error('range_id')
								                <label class="error help-block">{{ $message }}</label>
                			                @enderror
                                        </div>
                                        <div class="form-group role_main_div col-lg-6 col-sm-12">     
                                        <label>District</label>    
                                        <select  id="district_id" name="district_id" class=" form-control show-tick ms">
                                            <option value="">Select District</option>
                                            @foreach($districts as $district)
                                            <option value="{{$district->id}}" <?php if($transfer->district_id==$district->id){echo"selected";}?>>{{$district->district}}</option>
                                            @endforeach
                                        </select>
                                            @error('district_id')
								                <label class="error help-block">{{ $message }}</label>
                			                @enderror
                                        </div>
                                        <div class="form-group role_main_div col-lg-6 col-sm-12">     
                                        <label>Transfer Type</label>    
                                        <select  id="transfer_type" name="transfer_type" class=" form-control show-tick ms">
                                            <option value="">Select Transfer Typ</option>
                                            <option value="Permanent" <?php if($transfer->transfer_type=="Permanent"){echo "selected";}?>>Permanent</option>
                                            <option value="For Duty" <?php if($transfer->transfer_type=="For Duty"){echo "selected";}?>>For Duty</option>
                                        </select>
                                            @error('transfer_type')
								                <label class="error help-block">{{ $message }}</label>
                			                @enderror
                                        </div>
                                        
                                    </div>
                                    <div class="row transfer_date_range" style="<?php if($transfer->transfer_type=="For Duty"){echo "";}else{echo "display:none; ";}?>">
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                            <label>From Date</label> 
                                            <input type="text" class="form-control date_field" placeholder="From Date" name="from" id="from" value="<?php if($transfer->from){echo date('d-M-Y',strtotime($transfer->from));}else{echo"";} ?>" />
                                                @error('from')
                                                    <label class="error help-block">{{ $message }}</label>
                                                @enderror
                                            </div>
                                                <div class="form-group role_main_div col-md-6 col-sm-12">
                                            <label>To Date</label> 
                                            <input type="text" class="form-control date_field" placeholder="To Date" name="to" id="to" value="<?php if($transfer->to){echo date('d-M-Y',strtotime($transfer->to));}else{echo"";} ?>" />
                                                @error('to')
                                                    <label class="error help-block">{{ $message }}</label>
                                                @enderror
                                            </div>
                                    </div>
                                        <div class="form-group text-right">  
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
    $(".role_form").validate({
        rules: {
            vehicle_id:{
                required: true
            },
            zone_id:{
                required: true
            },
            range_id:{
                required: true
            },
            district_id:{
                required: true
            },
            transfer_type:{
                required: true
            },
        },
        messages: {
            vehicle_id: {
                required: "Please select a valid vehicle number"
            },
            zone_id: {
                required: "Please select a valid zoze"
            },
            range_id: {
                required: "Please select a valid range"
            },
            district_id: {
                required: "Please select a valid district"
            },
            transfer_type: {
                required: "Please select a valid transfer type"
            },
        }
    });

    $('.select2').select2();
    $(".search-select").select2({
        allowClear: true
    });
    $('#zone_id').change(function() {
        var zone_id = $(this).val();
        $.ajax({
                url : "{{ route('get_zone_wise_range') }}",
                data : {"_token": "{{ csrf_token() }}",'zone_id':zone_id},
                type : 'POST',
                success : function(result){
                    $('#range_id').html(result)
                }
        });
    });
    $('#range_id').change(function() {
        var range_id = $(this).val();
        $.ajax({
                url : "{{ route('get_range_wise_district') }}",
                data : {"_token": "{{ csrf_token() }}",'range_id':range_id},
                type : 'POST',
                success : function(result){
                    $('#district_id').html(result)
                }
        });
    });
    $('#transfer_type').change(function() {
       
        var transfer_type = $(this).val();
        if(transfer_type=="For Duty"){
            $('.transfer_date_range').show();
        }else{
            $('.transfer_date_range').hide();
        }
    });
    $('.select2-input').on('input', function() {
    var query = $(this).val();
    $.ajax({
        url: "{{ route('get_searched_vehicles') }}",
        dataType: 'json',
        data: {
            q: query // Send the search query to the server
        },
        success: function(data) {
            $('#vehicle_id').empty();
            $.each(data.items, function(index, item) {
                var option = new Option(item.text, item.id, false, true);
                $('#vehicle_id').append(option);
            }); 

            // Check if there is only one option left
            if ($('#vehicle_id option').length === 1) {
                $('#vehicle_id option').prop('selected', true);
                setTimeout(function() {
                    $('#vehicle_id').trigger('change');
                }, 2000);
            }
        }
    });
});
});
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