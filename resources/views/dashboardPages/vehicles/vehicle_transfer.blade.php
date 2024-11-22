@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
       <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Vehicle Transfer</h2>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    @can('Add Vehicle Transfer Data')
                    <a href="{{route('add_vehicle_transfer')}}"><button class="btn btn-success btn-icon float-right" type="button"><i class="zmdi zmdi-plus"></i></button></a>
                    @endcan
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
                                        <th>Zone </th>
                                        <th>Range </th>
                                        <th>District </th>
                                        <th>Transfer Type </th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Transferred By</th>
                                        <th>Action</th>
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
          ajax: "{{ route('vehicle_transfer') }}",
          columns: [
              {data: 'registration_number', name: 'registration_number'},
              {data: 'zone', name: 'zone'},
              {data: 'range', name: 'range'},
              {data: 'district', name: 'district'},
              {data: 'transfer_type', name: 'transfer_type'},
              {data: 'from', name: 'from'},
              {data: 'to', name: 'to'},
              {data: 'name', name: 'name'},
              {data: 'action', name: 'action', orderable: false, searchable: false},

          ]
      });
    });
  </script>