@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Assign Task</h2>
                  
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <a href="{{route('add_task')}}"><button class="btn btn-success btn-icon float-right" type="button"><i class="zmdi zmdi-plus"></i></button></a>
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
                                        <th>Task</th>
                                        <th>Assigned On</th>
                                        <th>Status</th>
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
        ajax: "{{ route('assign_task') }}",
        columns: [
            {data: 'user_name', name: 'user_name'},
            {data: 'task_title', name: 'task_title'},
            {data: 'assigned_on', name: 'assigned_on'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $(document).on("click",".update_status",function(){
        var task_id=$(this).attr('data-id');
        var task_status=$(this).attr('data-status');

        swal({
            title: "Are you sure?",
            text: "Are you sure to update the status?",
            icon: "warning",
            buttons: [
                'No, cancel it!',
                'Yes, I am sure!'
            ],
            dangerMode: true
        }).then(function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url : "{{ route('update_task_status') }}",
                    data : {"_token": "{{ csrf_token() }}",'task_id':task_id,'task_status':task_status},
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
