@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Add Vehicle Deployment</h2>
    
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
                            <form name="frm" class="make_form" method="POST" action="{{route('create_vehicle_deployement')}}">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                    <div class="row">
                                      <div class="form-group role_main_div col-lg-6 col-sm-12">
                                        <label>Vehicle Number</label>
                                        <select name="vehicle_id" id="vehicle_id" class="w-100 show-tick ms select2">
                                            <option value="">Select Vehicle Number</option>
                                            @foreach($vehicles as $vehicle)
                                            <option value="{{$vehicle->id}}">{{$vehicle->registration_number}}</option>
                                            @endforeach
                                        </select>
                                        @error('vehicle_id')
                                            <label class="error help-block">{{ $message }}</label>
                                        @enderror
                                        </div>
                                        <div class="form-group role_main_div col-lg-6 col-sm-12">
                                        <label>Deployed District</label> 
                                            <select name="deployed_district_id" id="deployed_district_id" class=" form-control show-tick ms">
                                                <option value="">Select Deployed District</option>
                                                @foreach($districts as $district)
                                                <option value="{{$district->id}}">{{$district->district}}</option>
                                                @endforeach
                                            </select>
                                            @error('deployed_district_id')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                        <div class="form-group role_main_div">
                                        <label>Deployed Date</label> 
                                        <input type="text" class="form-control date_field" placeholder="Deployed Date" name="deployed_date" id="deployed_date" value="{{old('deployed_date')}}" />
                                            @error('deployed_date')
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
            vehicle_id:{
                required: true
            },
            deployed_district_id:{
                required: true
            },
            deployed_date:{
                required: true
            },
        },
        messages: {
            vehicle_id: {
                required: "Please select a valid vehicle number"
            },
            deployed_district_id: {
                required: "Please select a valid deployed district"
            },
            deployed_date: {
                required: "Please select a valid deployed date"
            },
        }
    });
    $('.select2').select2();
    $(".search-select").select2({
        allowClear: true
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