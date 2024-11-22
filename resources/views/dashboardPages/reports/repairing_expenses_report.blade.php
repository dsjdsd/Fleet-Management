@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Repairing Expenses Report</h2>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <a href="{{route('download_repairing_expense_report')}}"><button class="btn btn-success btn-icon float-right" type="button"><i class="fa fa-file-excel-o"></i></button></a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row ">
                        <div class="form-group role_main_div col-md-4 col-sm-12">
                            <label>Vehicle Number</label>
                            <select name="vehicle" id="vehicle" class=" w-100 show-tick ms select2">
                            <option value="">Select Vehicle Registration Number</option>
                            @foreach($vehicles as $key=>$val)
                                <option value="{{$val->id}}">{{$val->registration_number}}</option>
                            @endforeach
                        </select>
                        </div>
                        
                        <div class="form-group role_main_div  col-md-2 col-sm-12">
                            <label>Minimum Cost</label>
                            <input type="number" class="form-control" placeholder="Minimum Cost" name="minimum_cost" id="minimum_cost" value="{{old('minimum_cost')}}" />
                        </div>

                        <div class="form-group role_main_div  col-md-2 col-sm-12">
                            <label>Maximum Cost</label>
                            <input type="number" class="form-control" placeholder="Maximum Cost" name="maximum_cost" id="maximum_cost" value="{{old('maximum_cost')}}" />
                        </div>

                        <div class="form-group role_main_div  col-md-2 col-sm-12">
                            <label>Repair Date From</label>
                            <input type="text" class="form-control date_field" placeholder="Repair Date From" name="repair_date_from" id="repair_date_from" value="{{old('repair_date_from')}}" />
                        </div>

                        <div class="form-group role_main_div  col-md-2 col-sm-12">
                            <label>Repair Date To</label>
                            <input type="text" class="form-control date_field" placeholder="Repair Date To" name="repair_date_to" id="repair_date_to" value="{{old('repair_date_to')}}" />
                        </div>
                    </div>
                    <div class="card project_list">
                        <div class="table-responsive">
                            <table class="table table-hover c_table theme-color">
                                <thead>
                                    <tr>                                       
                                        <th>Vehicle Number</th>
                                        <th>Driver</th>
                                        <th>PNO Number</th>
                                        <th>Cost</th>
                                        <th>Repair Date</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
$(function () {
    var table = $('.table').DataTable({
        processing: false,
        serverSide: true,
        bFilter: false,
        searching: true,
        ajax: {
            url: "{{ route('repairing_expenses_report') }}",
            data: function (d) {
                d.vehicle = $('#vehicle').val();
                d.minimum_cost = $('#minimum_cost').val();
                d.maximum_cost = $('#maximum_cost').val();
                d.repair_date_from = $('#repair_date_from').val();
                d.repair_date_to = $('#repair_date_to').val();
            }
        },
        columns: [
            {data: 'vehicle_number', name: 'vehicle_number'},
            {data: 'driver', name: 'driver'},
            {data: 'pno_number', name: 'pno_number'},
            {data: 'cost', name: 'cost'},
            {data: 'repair_date', name: 'repair_date'}
        ]
    });

    $('#vehicle, #minimum_cost, #maximum_cost, #repair_date_from, #repair_date_to').on('change', function () {
        table.ajax.reload();
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

<script type="text/javascript">
$(function(){
    $('.select2').select2();
        
    $('.select2-input').on('input', function() {
        var query = $(this).val();
        $.ajax({
            url: "{{ route('get_diary_vehicle_list') }}",
            dataType: 'json',
            data: {
                q: query // Send the search query to the server
            },
            success: function(data) {
                $('#vehicle').empty();
                $.each(data.items, function(index, item) {
                    var option = new Option(item.text, item.id, false, true);
                    $('#vehicle').append(option);
                }); 

                // Check if there is only one option left
                if ($('#vehicle option').length === 1) {
                    $('#vehicle option').prop('selected', true);
                    setTimeout(function() {
                        $('#vehicle').trigger('change');
                    }, 2000);
                }
            }
        });
    });
})
</script>