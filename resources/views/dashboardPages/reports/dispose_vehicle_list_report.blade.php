@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Vehicles Dispose List</h2>
                  
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                            class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                            class="zmdi zmdi-arrow-right"></i></button>
                    <a href=""><button class="btn btn-success btn-icon float-right" type="button"><i
                                class="fa fa-file-excel-o"></i></button></a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="row ">
                        <div class="form-group role_main_div col-md-3 col-sm-12">
                            <label>Registration Number</label>
                            <input type="text" class="form-control" placeholder="Registration Number"
                                name="deployed_date" id="deployed_date" value="{{old('make')}}" />
                            @error('deployed_date')
                            <label class="error help-block">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group role_main_div  col-md-3 col-sm-12">
                            <label>Disposed Date</label>
                            <input type="text" class="form-control date_field" placeholder="Disposed Date"
                                name="deployed_date" id="deployed_date" value="{{old('make')}}" />
                            @error('deployed_date')
                            <label class="error help-block">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group role_main_div  col-md-3 col-sm-12">
                            <label>Disposed By</label>
                            <select name="vehicle_number" id="vehicle_number"  class=" form-control show-tick ms select2">
                                <option value="">Select Disposed By</option>
                                <option value="Patrol Cars">Head</option>
                                <option value="Jeep">Head</option>
                                <option value="SUV">Head</option>
                            </select>
                            @error('vehicle_number')
                            <label class="error help-block">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>

                    <div class="card project_list">
                        <div class="table-responsive">
                            <table class="table table-hover c_table theme-color">
                                <thead>
                                    <tr>
                                        <th>Registration Number</th>
                                        <th>Disposed Date</th>
                                        <th>Disposed By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>UP 32 T 0000</td>
                                        <td>March 29, 2014</td>
                                        <td>Head</td>
                                    </tr>
                                    <tr>
                                        <td>UP 32 T 0000</td>
                                        <td>March 29, 2014</td>
                                        <td>Head</td>
                                    </tr>
                                    <tr>
                                        <td>UP 32 T 0000</td>
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
$(function() {
    var table = $('.table').DataTable({
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

