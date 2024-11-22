
@include('dashboardCommonLayout.sidebar')
<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Vehicles Inventory</h2>
                  
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <a href=""><button class="btn btn-success btn-icon float-right" type="button"><i class="fa fa-file-excel-o"></i></button></a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="row ">
                <div class="form-group role_main_div col-md-2 col-sm-12">
                                        <label>Modal</label> 
                                            <select name="modal" id="modal" class=" form-control show-tick ms select2">
                                                <option value="">Select Vehicle Modal</option>
                                                <option value="Patrol Cars">2020</option>
                                                <option value="Jeep">2021</option>
                                                <option value="SUV">2023</option>
                                            
                                            </select>
                                            @error('modal')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group role_main_div col-md-2 col-sm-12">
                                        <label>Color</label> 
                                            <select name="color" id="color" class=" form-control show-tick ms select2">
                                                <option value="">Select Color</option>
                                                <option value="Patrol Cars">Black</option>
                                                <option value="Jeep">White</option>
                                                <option value="SUV">Red</option>
                                            </select>
                                            @error('color')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group role_main_div col-md-2 col-sm-12">
                                        <label>Vehicle Type</label> 
                                            <select name="vehicle_type" id="vehicle_type" class=" form-control show-tick ms select2">
                                            <option value="">Select Vehicle Type</option>
                                                <option value="Patrol Cars">Patrol Cars</option>
                                                <option value="Jeep">Jeep</option>
                                                <option value="SUV">SUV</option>
                                            </select>
                                            @error('vehicle_number')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group role_main_div col-md-2 col-sm-12">
                                        <label>Number of Vehicle</label> 
                                        <input type="text" class="form-control" placeholder="Number of Vehicle" name="no_of_vehicle" id="no_of_vehicle" value="{{old('make')}}" />
                                             
                                            @error('no_of_vehicle')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group role_main_div col-md-2 col-sm-12">
                                        <label>Deployed District</label> 
                                            <select name="color" id="color" class=" form-control show-tick ms select2">
                                                <option value="">Select Deployed District</option>
                                                <option value="Patrol Cars">Lucknow</option>
                                                <option value="Jeep">Lakhimpur</option>
                                                <option value="SUV">Sitapur</option>
                                            </select>
                                            @error('color')
                                                <label class="error help-block">{{ $message }}</label>
                                            @enderror
                                        </div>
                    </div>
                    <div class="card project_list">
                        <div class="table-responsive">
                            <table class="table table-hover c_table theme-color">
                                <thead>
                                    <tr>                                       
                                    
                                        <th>Modal</th>
                                        <th>Color</th>
                                        <th>Vehicle Type</th>
                                        <th>No. of Vehicle</th>
                                        <th>Deployed District</th>
                                     
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                       
                                        <td>2027</td>
                                        <td>Black</td>
                                        <td>Jeep</td>
                                        <td>5</td>
                                        <td>Lucknow</td>
                                   
                                    </tr>
                                </tbody>
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
        "targets": 4,
        "orderable": false
        }],
        searching: false
    }); 
  });
</script>
