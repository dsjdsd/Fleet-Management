
@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Fuel Consumptions</h2>
               
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
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
                                        <th> Date</th>
                                        <th>Fuel Quantity (in liter)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>UP 32 T 0000</td> 
                                        <td>March 29, 2014</td>
                                        <td>100</td>
                                    </tr>
                                    <tr>
                                        <td>UP 32 T 0000</td> 
                                        <td>March 29, 2014</td>
                                        <td>100</td>
                                    </tr>
                                    <tr>
                                        <td>UP 32 T 0000</td> 
                                        <td>March 29, 2014</td>
                                        <td>100</td>
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
       
    }); 
  });
</script>
