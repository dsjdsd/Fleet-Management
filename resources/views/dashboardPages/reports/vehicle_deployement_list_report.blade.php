
@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Vehicles Deployment List</h2>
          
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <a href=""><button class="btn btn-success btn-icon float-right" type="button"><i
                                class="fa fa-file-excel-o"></i></button></a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                    <div class="form-group role_main_div col-md-2 col-sm-12">
                                        <label>Vehicle Number</label> 
                                            <select name="vehicle_number" id="vehicle_number" class=" form-control show-tick ms select2">
                                            <option value="">Select Vehicle Number</option>
                                                <option value="Patrol Cars">UP 32 GK 0000</option>
                                                <option value="Jeep">UP 32 GK 0000</option>
                                                <option value="SUV">UP 32 GK 0000</option>
                                            </select>
                                            @error('vehicle_number')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group role_main_div col-md-2 col-sm-12">
                                        <label>Deployed District</label> 
                                            <select name="color" id="color" class=" form-control show-tick ms select2">
                                                <option value="">Select Deployed District</option>
                                                <option value="Patrol Cars">Lucknow</option>
                                                <option value="Jeep">Lakhimpur</option>
                                                <option value="SUV">Sitapur</option>
                                            </select>
                                            @error('color')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group role_main_div  col-md-2 col-sm-12">
                                        <label>Deployed Date</label> 
                                        <input type="text" class="form-control date_field" placeholder="Deployed Date" name="deployed_date" id="deployed_date" value="{{old('make')}}" />
                                            @error('deployed_date')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group role_main_div  col-md-2 col-sm-12">
                                        <label>Deployed By</label> 
                                        <input type="text" class="form-control" placeholder="Deployed By" name="deployed_by" id="deployed_by" value="{{old('make')}}" />
                                            @error('deployed_by')
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
                                        <th>Deployed District</th>
                                        <th>Deployed Date</th>
                                        <th>Deployed By</th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>UP 32 T 0000</td>
                                        <td>Lucknow</td>
                                        <td>March 29, 2014</td>
                                        <td>Head</td>
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
        "targets": 3,
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


