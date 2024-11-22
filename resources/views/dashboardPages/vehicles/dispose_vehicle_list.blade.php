
@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Vehicles Dispose List</h2>
                    
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
                                        <th>SR.No</th>
                                        <th>Registration Number</th>
                                        <th>Date Of Allotment</th>
                                        <th>vehicle Type</th>
                                        <th>Disposed Date</th>
                                        <th>Disposed By</th>
                                    </tr>
                                </thead>
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
          "targets": 5,
          "orderable": false
          }],
          processing: true,
          serverSide: true,
          ajax: "{{ route('dispose_vehicle_list') }}",
          columns: [
              {data: 'index', name: 'index', searchable: false, orderable: false, render: function (data, type, row, meta) {
              return meta.row + 1;
              }},
              {data: 'registration_number', name: 'registration_number'},
              {data: 'date_of_allotment', name: 'date_of_allotment'},
              {data: 'vehicle_make', name: 'vehicle_make'},
              {data: 'dispose_date', name: 'dispose_date'},
              {data: 'name', name: 'name'},
          ]
      });
    });
  </script>
