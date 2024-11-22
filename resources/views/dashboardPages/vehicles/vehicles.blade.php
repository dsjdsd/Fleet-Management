@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Vehicles</h2>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    @can('Add Vehicle')
                        <a href="{{route('create-vehicle')}}"><button class="btn btn-success btn-icon float-right" type="button"><i class="zmdi zmdi-plus"></i></button></a>
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
                                        <th>Registration Number</th>
                                        <th>Upp Number</th>
                                        <th>Chasis Number</th>
                                        <th>Engine Number</th>
                                        <th>Vehicle District</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
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
        "targets": 5,
        "orderable": false
        }],
        processing: true,
        serverSide: true,
        ajax: "{{ route('vehicles') }}",
        columns: [
            {data: 'registration_number', name: 'registration_number'},
            {data: 'upp_number', name: 'upp_number'},
            {data: 'chasis_number', name: 'chasis_number'},
            {data: 'engine_number', name: 'engine_number'},
            {data: 'district', name: 'district'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $(document).on("click",".delete",function(){
        var vehicle_id = $(this).attr('data-id');        
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover the record!",
            icon: "warning",
            buttons: [
                'No, cancel it!',
                'Yes, I am sure!'
            ],
            dangerMode: true
        }).then(function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url : "{{ route('remove_vehicle') }}",
                    data : {"_token": "{{ csrf_token() }}",'vehicle_id':vehicle_id},
                    type : 'POST',
                    success : function(result){
                        table.draw();
                    }
                });
            }
        })
    })
      
  });
</script>