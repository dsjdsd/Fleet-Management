@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Add User Transfer</h2>

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
                            <form name="frm" class="user_transfer" method="POST" action="{{route('create_user_transfer')}}">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="form-group role_main_div col-lg-6 col-sm-12">
                                                <label>Users</label>
                                                <select name="user" id="user" class="w-100 show-tick ms select2">
                                                    <option value="">Select user</option>
                                                    @foreach($users as $key=>$val)
                                                        <option value="{{$val->id}}">{{$val->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('user')
                                                <label class="error help-block">{{ $message }}</label>
                                                @enderror
                                            </div>
                                            <div class="form-group role_main_div col-lg-6 col-sm-12">
                                                <label>District</label>
                                                <select name="district" id="district" class="form-control show-tick ms">
                                                    <option value="">Select District</option>
                                                    @foreach($districts as $key=>$val)
                                                        <option value="{{$val->id}}">{{$val->district}}</option>
                                                    @endforeach
                                                </select>
                                                @error('district')
                                                <label class="error help-block">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group role_main_div">
                                                <label>Transferred On</label>
                                                <input type="text" class="form-control date_field"
                                                    placeholder="Transferred On" name="transferred_on" id="transferred_on"
                                                    value="{{old('make')}}" />
                                                @error('transferred_on')
                                                <label class="error help-block">{{ $message }}</label>
                                                @enderror
                                        </div>
                                        <div class="form-group text-right mt-2">
                                            <button type="btn" class="btn btn-primary">Submit</button>
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
    $(".user_transfer").validate({
        rules: {
            user: {
                required: true
            },
            district: {
                required: true
            },
            transferred_on: {
                required: true
            }
        },
        messages: {
            user: {
                required: "Please select user to assign vehicle"
            },
            district: {
                required: "Please select a valid district"
            },
            transferred_on: {
                required: "Please select transfer date"
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