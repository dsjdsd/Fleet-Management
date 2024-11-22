
@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Vehicles Inventory</h2>
                
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    @can('Add Vehicle Inventory')
                    <a href="{{route('add_vehicle_inventory')}}"><button class="btn btn-success btn-icon float-right" type="button"><i class="zmdi zmdi-plus"></i></button></a>
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
                                        <th>Modal</th>
                                        <th>Color</th>
                                        <th>Vehicle Type</th>
                                        <th>No. of Vehicle</th>
                                        <th>Deployed District</th>
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
        ajax: "{{ route('vehicles_inventory') }}",
        columns: [
            {data: 'make', name: 'make'},
            {data: 'color_name', name: 'color_name'},
            {data: 'vehicle_type', name: 'vehicle_type'},
            {data: 'vehicle_numbers', name: 'vehicle_numbers'},
            {data: 'district', name: 'district'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $(document).on("click",".delete",function(){
        var vehicle_inventory_id = $(this).attr('data-id');
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
                    url : "{{ route('remove_vehicle_inventory') }}",
                    data : {"_token": "{{ csrf_token() }}",'vehicle_inventory_id':vehicle_inventory_id},
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
