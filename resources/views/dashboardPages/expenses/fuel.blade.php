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
                    <a href="{{route('add_fuel')}}"><button class="btn btn-success btn-icon float-right" type="button"><i class="zmdi zmdi-plus"></i></button></a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12 col-xs-12">
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
                                        <th>Action</th>
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
                                    <td>
                                    <a href="edit_fuel" class="btn btn-success">Edit</a>
                                    <a href="edit_task" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>123456789</td>
                                    <td>Sudheer singh</td>
                                    <td>123456789</td>
                                    <td>150</td>
                                    <td>12000</td>
                                    <td>March 23, 2014</td>
                                    <td>
                                    <a href="edit_fuel" class="btn btn-success">Edit</a>
                                    <a href="edit_task" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>123456789</td>
                                    <td>Sudheer singh</td>
                                    <td>MBJJB8</td>
                                    <td>150</td>
                                    <td>12000</td>
                                    <td>March 23, 2014</td>
                                    <td>
                                    <a href="edit_fuel" class="btn btn-success">Edit</a>
                                    <a href="edit_task" class="btn btn-danger">Delete</a>
                                    </td>
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
@include('dashboardCommonLayout.footer')
<script type="text/javascript">
  $(function () {
    var table = $('.table').DataTable({
        "columnDefs": [{
        "targets": 6,
        "orderable": false
        }]
       
    });
  });
</script>