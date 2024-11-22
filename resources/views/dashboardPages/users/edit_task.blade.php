@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Edit Task</h2>

                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                            class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                            class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <!-- <h2 class="card-inside-title">New Make/Model</h2> -->
                            <form name="frm" class="edit_task_form" method="POST" action="{{route('update_task')}}">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="form-group role_main_div col-lg-6 col-sm-12">
                                                <label>Users</label>
                                                <select name="user" id="user" class=" w-100 show-tick ms select2">
                                                    <option value="">Select user</option>
                                                    @foreach($users as $key=>$val)
                                                        <option value="{{$val->id}}" {{$assigned_task_detail->user_id==$val->id ? 'selected' : ''}}>{{$val->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('user')
                                                <label class="error help-block">{{ $message }}</label>
                                                @enderror
                                            </div>

                                            <div class="form-group role_main_div col-lg-6 col-sm-12">
                                                <label>Assigned On</label>
                                                <input type="text" class="form-control date_field"
                                                    placeholder="Assigned On" name="assined_on" id="assined_on"
                                                    value="{{old('assined_on') ? old('assined_on') : date('d-M-Y',strtotime($assigned_task_detail->assigned_on))}}" />
                                                @error('assined_on')
                                                <label class="error help-block">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group role_main_div">
                                            <label>task</label>
                                            <input type="text" class="form-control" placeholder="task" name="task"
                                                id="task" value="{{old('task') ? old('task') : $assigned_task_detail->task_title}}" />
                                            @error('task')
                                            <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group role_main_div">
                                            <label>Description</label>
                                            <input type="text" class="form-control" placeholder="description" name="description" id="description" value="{{old('description') ? old('description') : $assigned_task_detail->task_description}}" />
                                            @error('description')
                                            <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group text-right mt-2">
                                            <input type="hidden" name="task_id" value="{{Crypt::encryptString($assigned_task_detail->id)}}"/>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
$(function() {
    $(".edit_task_form").validate({
        rules: {
            user:{
                required: true
            },
            assined_on:{
                required: true
            },
            task:{
                required: true
            },
            description:{
                required: true
            }
        },
        messages: {
            user: {
                required: "Please enter a valid make"
            },
            assined_on:{
                required: "Please select task assigned date"
            },
            task:{
                required: "Please select task title"
            },
            description:{
                required: "Please select task description"
            }
        }
    });
    
    $('.select2').select2();
    
    $('.select2-input').on('input', function() {
        var query = $(this).val();
        $.ajax({
            url: "{{route('get_searched_users')}}",
            dataType: 'json',
            data: {
                q: query // Send the search query to the server
            },
            success: function(data) {
                $('#user').empty();
                $.each(data.items, function(index, item) {
                    var option = new Option(item.text, item.id, true, true);
                    $('#user').append(option);
                });
            }
        });
    })
})

$(".date_field").datepicker({
    dateFormat: 'dd-M-yy',
    changeMonth: true,
    changeYear: true,
    yearRange: "1950:2034",
    beforeShow: function(input, inst) {
        $(input).prop('readonly', true);
    }
});
</script>
@include('dashboardCommonLayout.footer')