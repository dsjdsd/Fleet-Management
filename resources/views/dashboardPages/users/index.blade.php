@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>All Users</h2>
                 
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <a href="{{route('new_user')}}"><button class="btn btn-success btn-icon float-right" type="button"><i class="zmdi zmdi-plus"></i></button></a>
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
                                        <th>Name</th>
                                        <th>Pno Number</th>
                                        <th>D.O.B.</th>
                                        <th>Contact Number</th>
                                        <th>Status</th>
                                        <th>District</th>
                                        <th>Role</th>
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
        ajax: "{{ route('all_users') }}",
        columns: [
            {data: 'name', name: 'name'},
            {data: 'pno_number', name: 'pno_number'},
            {data: 'dob', name: 'dob'},
            {data: 'contact_number', name: 'contact_number'},
            {data: 'status', name: 'status'},
            {data: 'district', name: 'district'},
            {data: 'role', name: 'role'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $(document).on("click",".update_status",function(){
        var user_id=$(this).attr('data-id');
        var user_status=$(this).attr('data-status');

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
                    url : "{{ route('update_user_status') }}",
                    data : {"_token": "{{ csrf_token() }}",'user_id':user_id,'user_status':user_status},
                    type : 'POST',
                    success : function(result){
                        table.draw();
                    }
                });
            }
        })
    })

    $(document).on("click",".delete",function(){
        var user_id=$(this).attr('data-id');
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
                    url : "{{ route('remove_user') }}",
                    data : {"_token": "{{ csrf_token() }}",'user_id':user_id},
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