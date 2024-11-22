@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Zone Master</h2>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>

                    @can('Add Zones')
                        <a href="{{route('add_zone_master')}}"><button class="btn btn-success btn-icon float-right" type="button"><i class="zmdi zmdi-plus"></i></button></a>
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
                                        <th>Commissionrate</th>
                                        <th>Zone</th>
                                        <th class="w-25">Action</th>
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
        ajax: "{{ route('zone_master') }}",
        columns: [
            {data: 'commissionrate', name: 'commissionrate'},
            {data: 'zone', name: 'zone'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });  

    $(document).on("click",".delete",function(){
        var zone_id=$(this).attr('data-id');
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
                    url : "{{ route('delete_zone_master') }}",
                    data : {"_token": "{{ csrf_token() }}",'zone_id':zone_id},
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