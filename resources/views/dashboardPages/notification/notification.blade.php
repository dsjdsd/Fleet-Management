@include('dashboardCommonLayout.sidebar')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Notification</h2>
                  
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
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
                                        <th style="width:50px;"></th>
                                        <th class="text-center">User</th>                                      
                                        <th class="text-center">Title</th>
                                        <th class="text-center" style="width:150px;">Description</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td>
                                            <img class="rounded avatar" src="{{ asset('dashboard-assets/logo/up_police_logo.png') }}" alt="">
                                        </td>
                                        <td>
                                            <a class="single-user-name" href="javascript:void(0);">Jonathan Deo</a><br>
                                        </td>
                                        <td>
                                            <strong>Expense</strong><br> 
                                        </td>                                        
                                        <td class="hidden-md-down">Lorem Ipsum is simply dummy text </td>
                                        <td>25 Dec 2023</td>
                                        <td>09:30</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>
                                            <img class="rounded avatar" src="{{ asset('dashboard-assets/logo/up_police_logo.png') }}" alt="">
                                        </td>
                                        <td>
                                            <a class="single-user-name" href="javascript:void(0);">Jonathan Deo</a><br>
                                        </td>
                                        <td>
                                            <strong>Expense</strong><br> 
                                        </td>                                        
                                        <td class="hidden-md-down">Lorem Ipsum is simply dummy text </td>
                                        <td>25 Dec 2023</td>
                                        <td>09:30</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>
                                            <img class="rounded avatar" src="{{ asset('dashboard-assets/logo/up_police_logo.png') }}" alt="">
                                        </td>
                                        <td>
                                            <a class="single-user-name" href="javascript:void(0);">Jonathan Deo</a><br>
                                        </td>
                                        <td>
                                            <strong>Expense</strong><br> 
                                        </td>                                        
                                        <td class="hidden-md-down">Lorem Ipsum is simply dummy text </td>
                                        <td>25 Dec 2023</td>
                                        <td>09:30</td>
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