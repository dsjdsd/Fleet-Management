
@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>User Transfer</h2>
                   
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <a href="{{route('add_user_transfer')}}"><button class="btn btn-success btn-icon float-right" type="button"><i class="zmdi zmdi-plus"></i></button></a>
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
                                        <th>District Transferred</th>
                                        <th>Transferred On</th>
                                        <th>Action</th>
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
        ajax: "{{ route('user_transfer') }}",
        columns: [
            {data: 'user_name', name: 'user_name'},
            {data: 'district', name: 'district'},
            {data: 'transferred_on', name: 'transferred_on'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
</script>
