@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Manage Roles</h2>
                  
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <h2 class="card-inside-title">New Role</h2>
                            <form name="frm" class="role_form" method="POST" action="{{route('new_role')}}">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group role_main_div">                                    
                                            <input type="text" class="form-control" placeholder="Role" name="role" id="role" value="{{old('role')}}" />

                                            @error('role')
								                <label class="error help-block">{{ $message }}</label>
                			                @enderror
                                        </div>
                                        <div class="form-group row mx-0 permission_main_div mx-2">                                   
                                            @foreach($all_permissions as $key=>$val)
                                                <div class="col-sm-4">
                                                    <input class="form-check-input" type="checkbox" name="assigned_permissions[]" value="{{$val['name']}}" id="{{$val['id']}}" />{{$val['name']}}
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="form-group text-right">  
                                            <button type="submit" class="btn btn-primary">Create Role</button>
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
$(function(){
    $(".role_form").validate({
        rules: {
            role:{
                required: true
            }
        },
        messages: {
            role: {
                required: "Please enter a valid role"
            }
        }
    });
})
</script>
@include('dashboardCommonLayout.footer')