@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Fuel</h2>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <a href=""><button class="btn btn-success btn-icon float-right" type="button"><i class="fa fa-file-excel-o"></i></button></a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="row ">
                        <div class="form-group role_main_div col-md-2 col-sm-12">
                            <label>Vehicle Number</label>
                            <input type="text" class="form-control" placeholder="Vehicle Number"
                                name="vehicle_number" id="vehicle_number" value="{{old('make')}}" />
                            @error('vehicle_number')
                            <label class="error help-block">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group role_main_div  col-md-2 col-sm-12">
                            <label>Driver</label>
                            <input type="text" class="form-control" placeholder="Driver"
                                name="driver" id="driver" value="{{old('make')}}" />
                            @error('driver')
                            <label class="error help-block">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group role_main_div  col-md-2 col-sm-12">
                            <label>PNO Number</label>
                            <input type="text" class="form-control" placeholder="PNO Number"
                                name="pno_number" id="pno_number" value="{{old('make')}}" />
                            @error('pno_number')
                            <label class="error help-block">{{ $message }}</label>
                            @enderror
                         
                        </div>
                        <div class="form-group role_main_div  col-md-2 col-sm-12">
                            <label>Fuel</label>
                            <input type="text" class="form-control" placeholder="Fuel"
                                name="fuel" id="fuel" value="{{old('make')}}" />
                            @error('fuel')
                            <label class="error help-block">{{ $message }}</label>
                            @enderror
                         
                        </div>
                        <div class="form-group role_main_div  col-md-2 col-sm-12">
                            <label>Cost</label>
                            <input type="text" class="form-control" placeholder="Cost"
                                name="cost" id="cost" value="{{old('make')}}" />
                            @error('cost')
                            <label class="error help-block">{{ $message }}</label>
                            @enderror
                         
                        </div>
                        <div class="form-group role_main_div  col-md-2 col-sm-12">
                            <label>Fuel Date</label>
                            <input type="text" class="form-control date_field" placeholder="Fuel Date"
                                name="fuel_date" id="fuel_date" value="{{old('make')}}" />
                            @error('fuel_date')
                            <label class="error help-block">{{ $message }}</label>
                            @enderror
                         
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
                                        <th>Fuel (in liters)</th>
                                        <th>Cost</th>
                                        <th>Fuel Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>123456789</td>
                                    <td>Sudheer singh</td>
                                    <td>MBJJB8</td>
                                    <td>150</td>
                                    <td>12000</td>
                                    <td>March 23, 2014</td>
                                </tr>
                                <tr>
                                    <td>123456789</td>
                                    <td>Sudheer singh</td>
                                    <td>123456789</td>
                                    <td>150</td>
                                    <td>12000</td>
                                    <td>March 23, 2014</td>
                                </tr>
                                <tr>
                                    <td>123456789</td>
                                    <td>Sudheer singh</td>
                                    <td>MBJJB8</td>
                                    <td>150</td>
                                    <td>12000</td>
                                    <td>March 23, 2014</td>  
                                </tr>
                                </tbody>
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
        "columnDefs": [{
        "targets": 5,
        "orderable": false
        }],
        searching: false
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
