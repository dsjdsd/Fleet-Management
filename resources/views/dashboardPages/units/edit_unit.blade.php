@include('dashboardCommonLayout.sidebar')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Update Unit</h2>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>                                
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <form action="{{ url('update_unit') }}" method="POST" class="unit_form">
                                @csrf
                                <div class="row">
                                    <div class="form-group role_main_div col-md-6 col-sm-12">     
                                        <label>District</label>    
                                        <select class="form-control show-tick ms select2" name="district" id="district">
                                            <option value="">Select District</option>
                                            @foreach($districts as $key=>$val)
                                            <option value="{{$val->id}}" {{$unit_detail->district_id==$val->id ? 'selected' : ''}}>{{$val->district}}</option>
                                            @endforeach
                                        </select>
                                        @error('district')
                                            <label class="error help-block">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="form-group role_main_div col-md-6 col-sm-12">     
                                        <label>Unit</label>                                    
                                        <input type="text" class="form-control" name="unit" placeholder="Enter Unit Name" value="{{old('unit') ? old('unit') : $unit_detail->unit}}">

                                        @error('unit')
                                            <label class="error help-block">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group text-right mt-2">  
                                    <input type="hidden" name="unit_id" value="{{Crypt::encryptString($unit_detail->id)}}"/>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>                       
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>
@include('dashboardCommonLayout.footer')
<script>
$(function(){
    $(".unit_form").validate({
        rules: {
            unit:{
                required: true
            }
        },
        messages: {
            unit: {
                required: "Please enter a valid unit name"
            }
        }
    });
})
</script>