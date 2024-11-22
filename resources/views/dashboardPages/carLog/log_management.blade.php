@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Log Management</h2>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    @can('Add Car Log Book')
                    <a href="{{route('add_log')}}"><button class="btn btn-success btn-icon float-right" type="button"><i class="zmdi zmdi-plus"></i></button></a>
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
                                        <th>Sr.No.</th>                                   
                                        <th>Date</th>                                   
                                        <th>Vehicle</th>
                                        <th>Driver</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Distance (Km)</th>
                                        <th>Comments</th>
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
        ajax: "{{ route('log_management') }}",
        columns: [
            {data: 'index', name: 'index', searchable: false, orderable: false, render: function (data, type, row, meta) {
            return meta.row + 1;
            }},
            {data: 'log_date', name: 'log_date'},
            {data: 'registration_number', name: 'registration_number'},
            {data: 'name', name: 'name'},
            {data: 'from', name: 'from'},
            {data: 'to', name: 'to'},
            {data: 'distance', name: 'distance'},
            {data: 'comment', name: 'comment'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $(document).on("click",".delete",function(){
        var add_log_id = $(this).attr('data-id');
        
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
                    url : "{{ route('remove_log') }}",
                    data : {"_token": "{{ csrf_token() }}",'add_log_id':add_log_id},
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
