@include('dashboardCommonLayout.sidebar')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Add Commissionrate</h2>
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
                            <form action="{{ url('create_commissionrate') }}" method="POST" class="commissionrate_form">
                                @csrf
                                <div class="row">
                                    <div class="form-group role_main_div col-md-12 col-sm-12">     
                                        <label>Commissionrate</label>                                    
                                        <input type="text" class="form-control" name="commissionrate" placeholder="Enter Commissionrate" value="{{old('commissionrate')}}">

                                        @error('commissionrate')
                                            <label class="error help-block">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group text-right mt-2">  
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
    $(".commissionrate_form").validate({
        rules: {
            commissionrate:{
                required: true
            }
        },
        messages: {
            commissionrate: {
                required: "Please enter a valid Comissionrate"
            }
        }
    });
})
</script>