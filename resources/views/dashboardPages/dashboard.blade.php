@include('dashboardCommonLayout.sidebar')
<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Dashboard</h2>
                 
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                            class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card widget_2 traffic">
                        <div class="body d-flex justify-content-between">
                            <div>
                                <h6>Total Users</h6>
                                <h2 class="text_css">20</h2>
                            </div>
                                <i class="fa fa-users" style="font-size:48px; color: #2d3092;" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card widget_2  sales">
                        <div class="body d-flex justify-content-between">
                            <div>
                                <h6>Total Purchased Vehicle</h6>
                                <h2 class="text_css">12</h2>
                            </div>
                                <i class="fa fa-shopping-cart" style="font-size:48px; color: #2d3092;" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card widget_2  email">
                        <div class="body d-flex justify-content-between">
                            <div>
                                <h6>Total Deployed Vehicle</h6>
                                <h2 class="text_css">39</h2>
                            </div>
                                <i class="fa fa-car" style="font-size:48px; color: #2d3092;" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card widget_2  domains">
                        <div class="body d-flex justify-content-between">
                            <div>
                                <h6>Total Disposed Vehicle</h6>
                                <h2 class="text_css">8</h2>
                            </div>
                                <i class="fa fa-trash" style="font-size:48px; color: #2d3092;" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card widget_2  email">
                        <div class="body d-flex justify-content-between">
                            <div>
                                <h6>Fuel Transactions</h6>
                                <h2 class="text_css">39</h2>
                            </div>
                                 <i class="fa-solid fa-credit-card" style="font-size:48px; color: #2d3092;"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card widget_2  domains">
                        <div class="body d-flex justify-content-between">
                            <div>
                            <h6>Fuel Consumptions</h6>
                            <h2 class="text_css">8</h2>
                        </div>
                             <i class='fas fa-gas-pump' style="font-size:48px; color: #2d3092;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <!-- <h2><strong><i class="zmdi zmdi-chart"></i></strong> Report</h2> -->
                        </div>
                        <div class="body mb-2">
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="state_w1 mb-1 mt-1">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5>2,365</h5>
                                                <span><i class='fas fa-gas-pump'></i> Fuel</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="state_w1 mb-1 mt-1">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5>365</h5>
                                                <span><i class="fa fa-gear"></i> Servicing</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="state_w1 mb-1 mt-1">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5>65</h5>
                                                <span><i class="fa fa-wrench" aria-hidden="true"></i> Repairing</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="state_w1 mb-1 mt-1">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5>2,055</h5>
                                                <span><i class="fa fa-shopping-cart" aria-hidden="true"></i> Purchased
                                                    Products</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="header">
                            <h2>Fuel Consumptions</h2>
                        </div>
                        <div class="body">
                            <div id="chart-area-spline-sracked" class="c3_chart d_sales"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix p-2">
                <div class="col-lg-6 col-md-12">
                    <div class="card ">
                        <div class="header">
                            <h2>deployed Vehicles</h2>
                        </div>
                        <div class="body text-center card_height">
                            <div id="chart-pie" class="c3_chart d_distribution"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card ">
                        <div class="header">
                            <h2>Purchased Vehicles</h2>
                        </div>
                        <div class="body card_height">
                            <div id="chart-bar" class="c3_chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('dashboardCommonLayout.footer')