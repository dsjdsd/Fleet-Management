@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Edit Log</h2>
    
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
                            <form name="frm" class="make_form" method="POST" action="{{route('create_log')}}">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                    <div class="row">
                                      <div class="form-group role_main_div col-md-6 col-sm-12">
                                      <input type="hidden" class="form-control"  name="add_log_id" id="add_log_id" value="{{$log_management->id}}" />
                                        <label>Vehicle Number</label> 
                                        <select name="vehicle_id" id="vehicle_id" class=" show-tick ms select2 w-100">
                                                <option value="">Select Vehicle</option>
                                                   @foreach($vehicles as $vehicle)
                                                    <option value="{{$vehicle->id}}" <?php if($log_management->vehicle_id==$vehicle->id){echo"selected";}?>>{{$vehicle->registration_number}}</option>
                                                   @endforeach
                                            </select>
                                            @error('vehicle_id')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group role_main_div col-md-6 col-sm-12 ">
                                        <label>Driver</label> 
                                            <input type="text" class="form-control"  id="driver_name" name="driver_name" readonly value="{{$log_management->name}}" />
                                            <input type="hidden" class="form-control"  name="driver_id" id="driver_id" value="{{$log_management->driver_id}}" />
                                            @error('driver_name')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>Log Date</label> 
                                        <input type="text" class="form-control date_field" placeholder="Log Date" name="log_date" id="log_date" value="{{date('d-M-Y',strtotime($log_management->log_date))}}" />
                                            @error('log_date')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>From</label> 
                                        <input type="text" class="form-control" placeholder="From" name="from" id="from" value="{{$log_management->from}}" />
                                            @error('from')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>To</label> 
                                        <input type="text" class="form-control" placeholder="to" name="to" id="to" value="{{$log_management->to}}" />
                                            @error('to')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>Distance (Km)</label> 
                                        <input type="number" class="form-control" placeholder="Distance" name="distance" id="distance" value="{{$log_management->distance}}" />
                                            @error('distance')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="form-group role_main_div  col-md-6 col-sm-12">
                                        <label>In Litre Fuel</label> 
                                        <input type="number" class="form-control" placeholder="Fuel" name="fuel" id="fuel" value="{{$log_management->fuel}}" />
                                            @error('fuel')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group role_main_div  col-md-6 col-sm-12">
                                        <label>Comment</label> 
                                        <input type="text" class="form-control" placeholder="Comment" name="comment" id="comment" value="{{$log_management->comment}}" />
                                            @error('comment')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                        <div class="form-group text-right mt-2">  
                                            <button type="submit" class="btn btn-primary">Add Log</button>
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
             driver_name:{
             required: true
             },
             log_date:{
             required: true
             },
             from:{
             required: true
             },
            to:{
             required: true
             },
             distance:{
             required: true
             },
             fuel:{
             required: true
             },
             
             comment:{
             required: true
             }
         },
         messages: {
            vehicle_id: {
                 required: "Please enter a valid vehicle name"
             },
             driver_name: {
                 required: "Please enter a valid driver name"
             },
             log_date: {
                 required: "Please enter a valid log date"
             },
             from: {
                 required: "Please enter a valid from"
             },
            to: {
                 required: "Please enter a valid to"
             },
             distance: {
                 required: "Please enter a valid distance"
             },
             fuel: {
                 required: "Please enter a valid fuel"
             },
             
             comment: {
                 required: "Please enter a valid comment"
             }
         }
    });

    $('.select2').select2();
    $(".search-select").select2({
        allowClear: true
    });

})
$(".date_field").datepicker({
    dateFormat: 'dd-M-yy',
    changeMonth: true,
    changeYear: true,
    yearRange: "1950:2034",
    beforeShow: function(input, inst) {
        $(input).prop('readonly', true);
    }
});

$(document).ready(function() {
        // Change event listener for the dropdown
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
        $('#vehicle_id').change(function() {
            var vehicle_id = $(this).val();
            $.ajax({
                    url : "{{ route('get_vehicle_wise_driver') }}",
                    data : {"_token": "{{ csrf_token() }}",'vehicle_id':vehicle_id},
                    type : 'POST',
                    success : function(result){
                        console.log(result.user_id);
                        $('#driver_name').val(result.name);
                        $('#driver_id').val(result.user_id);
                    }
                });
        });
    });
</script>
@include('dashboardCommonLayout.footer')