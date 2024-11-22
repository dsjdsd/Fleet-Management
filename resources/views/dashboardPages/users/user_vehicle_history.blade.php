@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Users Vehicle History</h2>
                   
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
                                        <th>User Name</th>
                                        <th>PNO Number</th>
                                        <th>Registration Number</th>
                                        <th>Assigned On</th>
                                        <th>Release Date</th>
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
@include('dashboardCommonLayout.footer')

<script type="text/javascript">
    $(function () {
        var table = $('.table').DataTable({
            processing: false,
            serverSide: true,
            ajax: "{{ route('user_vehicle_history') }}",
            columns: [
                {data: 'user_name', name: 'user_name'},
                {data: 'pno_number', name: 'pno_number'},
                {data: 'vehicle_number', name: 'vehicle_number'},
                {data: 'assigned_on', name: 'assigned_on'},
                {data: 'release_date', name: 'release_date'},
            ]
        });
    });
</script>
