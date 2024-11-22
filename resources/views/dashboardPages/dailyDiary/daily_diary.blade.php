@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Daily Diary</h2>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>

                    @can('Add Daily Diary')
                        <a href="{{route('add_daily_diary')}}"><button class="btn btn-success btn-icon float-right" type="button"><i class="zmdi zmdi-plus"></i></button></a>
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
                                        <th>Date</th>
                                        <th>Vehicle Type</th>
                                        <th>Chasis Number</th>
                                        <th>Engine Number</th>
                                        <th>Cubic Capacity (CC)</th>
                                        <th>Vehicle Make/Modal</th>
                                        <th>Ability to Sit or Carry</th>
                                        <th>Engine Oil Quantity</th>
                                        <th>Gear Oil Quantity</th>
                                        <th>Date of Purchase</th>
                                        <th>Date Put Into use</th>
                                        <th>Purchase Price</th>
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
        ajax: "{{ route('daily_diary') }}",
        columns: [
            {data: 'registration_number', name: 'registration_number'},
            {data: 'date', name: 'date'},
            {data: 'vehicle_type', name: 'vehicle_type'},
            {data: 'chasis_number', name: 'chasis_number'},
            {data: 'engine_number', name: 'engine_number'},
            {data: 'cubic_capacity', name: 'cubic_capacity'},
            {data: 'vehicle_make', name: 'vehicle_make'},
            {data: 'ability_to_sit', name: 'ability_to_sit'},
            {data: 'engine_oil_quantity', name: 'engine_oil_quantity'},
            {data: 'gear_oil_quantity', name: 'gear_oil_quantity'},
            {data: 'purchase_date', name: 'purchase_date'},
            {data: 'usage_start_date', name: 'usage_start_date'},
            {data: 'purchase_price', name: 'purchase_price'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $(document).on("click",".delete",function(){
        var daily_diary_id=$(this).attr('data-id');
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
                    url : "{{ route('delete_daily_diary_record') }}",
                    data : {"_token": "{{ csrf_token() }}",'daily_diary_id':daily_diary_id},
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