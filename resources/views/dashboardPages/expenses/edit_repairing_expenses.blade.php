@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Edit Repair Expenses</h2>
    
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
                            <form name="frm" enctype="multipart/form-data" class="make_form" method="POST" action="{{route('create_repairing_expenses')}}">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <input type="hidden" name="repair_expense_id" value="{{$repair_expense->id}}">
                                    <div class="row">
                                      <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>Vehicle Number</label>
                                            <select name="vehicle_id" id="vehicle_id" class="show-tick ms select2 w-100">
                                            <option value="">Select Vehicle Number</option>
                                            @foreach($vehicles as $vehicle)
                                            <option value="{{$vehicle->id}}" <?php if($repair_expense->vehicle_id==$vehicle->id){echo"selected";}?>>{{$vehicle->registration_number}}</option>
                                            @endforeach
                                            </select>
                                            @error('vehicle_id')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>Driver</label> 
                                            <select name="driver_id" id="driver_id" class="w-100 show-tick ms select2">
                                                <option value="">Select Driver </option>
                                                @foreach($drivers as $driver)
                                                <option value="{{$driver->id}}" <?php if($repair_expense->driver_id==$driver->id){echo"selected";}?>>{{$driver->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('driver_id')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>PNO Number</label>
                                        <input type="text" name="pno_number" readonly class="form-control" placeholder="PNO Number" id="pno_number" value="{{$repair_expense->pno_number}}"> 
                                            @error('pno_number')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group role_main_div col-md-6 col-sm-12">
                                        <label>Cost (In Rupees)</label> 
                                        <input type="number" class="form-control" placeholder="Cost" name="cost" id="cost" value="{{$repair_expense->cost}}" />
                                            @error('cost')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        </div>
                                        <div class="form-group role_main_div">
                                        <label>Repair Date</label> 
                                        <input type="text" class="form-control date_field" placeholder="Repair Date" name="repair_date" id="repair_date" value="{{$repair_expense->repair_date}}" />
                                            @error('repair_date')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group make_main_div">   
                                        <label>Receipt</label>                                 
                                            <input type="file" class="dropify" placeholder="Receipt" name="receipt" id="receipt" accept=".pdf" />

                                            @error('receipt')
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
            driver_id:{
                required: true
            },
            pno_number:{
                required: true
            },
            cost:{
                required: true
            },
            repair_date:{
                required: true
            },
        },
        messages: {
            vehicle_id: {
                required: "Please select a valid vehicle number"
            },
            driver_id: {
                required: "Please select a valid driver name"
            },
            pno_number: {
                required: "Please select a valid pno number"
            },
            cost: {
                required: "Please enter a valid cast"
            },
            repair_date: {
                required: "Please select a valid repair date"
            },
        }
    });

    $('.select2').select2();
    $(".search-select").select2({
        allowClear: true
    });
    $('#driver_id').on('change', function() {
    var driver_id = $(this).val();
    $.ajax({
        url : "{{ route('user_wise_get_pno_number') }}",
        data : {"_token": "{{ csrf_token() }}",'driver_id':driver_id},
        type : 'POST',
        success : function(result){
            $('#pno_number').val(result);
        }
    });
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
