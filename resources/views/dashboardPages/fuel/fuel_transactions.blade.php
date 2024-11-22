
@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Fuel Transactions</h2>
                   
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <a href="{{route('add_fuel_transaction')}}"><button class="btn btn-success btn-icon float-right" type="button"><i class="zmdi zmdi-plus"></i></button></a>
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
                                        <th>Vehicle</th>
                                        <th>Fuel Type</th>
                                        <th>Added Staff</th>
                                        <th> Fill Date</th>
                                        <th>Fuel (In Liter)</th>
                                        <th>Amount (In Rs.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>UP 32 T 0000</td> 
                                        <td>Petrol</td>
                                        <td>user</td>
                                        <td>March 29, 2024</td>
                                        <td>1000</td>
                                        <td>15000</td>
                                    </tr>
                                    <tr>
                                        <td>UP 32 T 0000</td> 
                                        <td>Petrol</td>
                                        <td>user</td>
                                        <td>March 29, 2024</td>
                                        <td>1000</td>
                                        <td>15000</td>
                                    </tr>
                                    <tr>
                                        <td>UP 32 T 0000</td> 
                                        <td>Petrol</td>
                                        <td>user</td>
                                        <td>March 29, 2024</td>
                                        <td>1000</td>
                                        <td>15000</td>
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
