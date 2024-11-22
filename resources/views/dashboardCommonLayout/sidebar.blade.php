@include('dashboardCommonLayout.header')
@php
    // Get the current route's action using Laravel's helper function
    $routeAction = Route::currentRouteAction();

    // Extract controller and method from the action
    list($controller, $method) = explode('@', $routeAction);
@endphp
<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="{{ route('dashboard') }}"><img src="{{ asset('dashboard-assets/logo/up_police_logo.png') }}" width="25" alt=""><span class="m-l-10">Fleet Management</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    @if(empty(auth()->user()->photo) || is_null(auth()->user()->photo))
                        <a class="image" href="javascript:void(0);"><img src="{{ asset('dashboard-assets/images/profile_av.jpg') }}" alt="User"></a>
                    @else
                        <a class="image" href="javascript:void(0);"><img src="<?php echo asset('storage/profile_image/' . auth()->user()->photo) ?>" alt="User"></a>
                    @endif
                    <div class="detail">
                        <h4>{{auth()->user()->name}}</h4>
                        <small>PNO: {{auth()->user()->pno_number}}</small>                        
                    </div>
                </div>
            </li>
            <li class="{{$method=='dashboard' ? 'active open' : ''}}"><a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>
            
            @canany(['View Roles', 'Add Role', 'Edit Role', 'Remove Role','View Model/Make','View Districts','Add Districts','Edit Districts','Remove Districts','View Vehicle Color','Add Vehicle Color','Edit Vehicle Color','Delete Vehicle Color','Add Model/Make','Edit Model/Make','Remove Model/Make','View Zones','Add Zones','Edit Zones','Remove Zones','View Ranges','Add Ranges','Edit Ranges','Remove Ranges','View Commissionrate Master Data','Add Commissionrate Master Data', 'Edit Commissionrate Master Data','Remove Commissionrate Master Data','View Units Master Data','Add Units Master Data', 'Edit Units Master Data','Remove Units Master Data'])
            <li class="{{($method=='roles' || $method=='make' || $method=='districts' || $method=='zone_master' || $method=='range_master' || $method=='units' || $method=='comissionrate') ? 'active open' : ''}}"><a href="javascript:void(0);" class="menu-toggle"><i class='fas fa-user-friends'></i><span>Masters</span></a>
                <ul class="ml-menu">
                    @canany(['View Roles','Add Role', 'Edit Role', 'Remove Role'])
                        <li class="{{$method=='roles' ? 'active' : ''}}"><a href="{{route('roles')}}">User Roles</a></li>
                    @endcanany

                    @canany(['View Model/Make','Add Model/Make', 'Edit Model/Make','Remove Model/Make'])
                        <li class="{{$method=='make' ? 'active' : ''}}"><a href="{{route('make')}}">Vehicle Model/Make</a></li>
                    @endcanany
                    
                    @canany(['View Commissionrate Master Data','Add Commissionrate Master Data', 'Edit Commissionrate Master Data','Remove Commissionrate Master Data'])
                        <li class="{{$method=='comissionrate' ? 'active' : ''}}"><a href="{{route('commissionrate')}}">Commissionrate Master</a></li>
                    @endcanany

                    @canany(['View Zones','Add Zones','Edit Zones','Remove Zones'])
                        <li class="{{$method=='zone_master' ? 'active' : ''}}"><a href="{{route('zone_master')}}">Zone Master</a></li>
                    @endcanany

                    @canany(['View Ranges','Add Ranges','Edit Ranges','Remove Ranges'])
                        <li class="{{$method=='range_master' ? 'active' : ''}}"><a href="{{route('range_master')}}">Range Master</a></li>  
                    @endcanany

                    @canany(['View Districts','Add Districts','Edit Districts','Remove Districts'])
                        <li class="{{$method=='districts' ? 'active' : ''}}"><a href="{{route('districts')}}">District Master</a></li>                  
                    @endcanany

                    @canany(['View Units Master Data','Add Units Master Data', 'Edit Units Master Data','Remove Units Master Data'])
                        <li class="{{$method=='units' ? 'active' : ''}}"><a href="{{route('units')}}">Units Master</a></li>  
                    @endcanany
                </ul>
            </li>
            @endcanany

            @canany(['View Users', 'Add Users', 'Edit User', 'Remove User','User Status','Assign Vehicle','View Assign Vehicle','View Vehicle History','View Assigned Tasks','Add Assigned Tasks','Edit Assigned Tasks','View User Transfer','New User Transfer','Edit User Transfer'])

            <li class="{{($method=='new_user' || $method=='all_users' || $method=='assign_vehicle' || $method=='user_assign_vehicle' || $method=='user_vehicle_history' || $method=='assign_task'  || $method=='user_transfer') ? 'active open' : ''}}"><a href="javascript:void(0);" class="menu-toggle"><i class="fa fa-users" aria-hidden="true"></i><span>Users</span></a>
                <ul class="ml-menu">
                    @can('Add Users')
                        <li class="{{$method=='new_user' ? 'active' : ''}}"><a href="{{route('new_user')}}">Add/Register Users</a></li>
                    @endcan

                    @canany(['View Users', 'Add Users', 'Edit User', 'Remove User','User Status'])
                        <li class="{{$method=='all_users' ? 'active' : ''}}"><a href="{{route('all_users')}}">All Users List</a></li>
                    @endcanany

                    @can('Assign Vehicle')
                        <li class="{{$method=='assign_vehicle' ? 'active' : ''}}"><a href="{{route('assign_vehicle')}}">Assign Vehicle</a></li>
                    @endcan

                    @canany(['Assign Vehicle','View Assign Vehicle','Edit Assign Vehicle'])
                        <li class="{{$method=='user_assign_vehicle' ? 'active' : ''}}"><a href="{{route('user_assign_vehicle')}}">User Assign Vehicle</a></li>
                    @endcanany

                    @can('View Vehicle History')
                        <li class="{{$method=='user_vehicle_history' ? 'active' : ''}}"><a href="{{route('user_vehicle_history')}}">User Vehicle History</a></li>
                    @endcan

                    @canany(['View Assigned Tasks','Add Assigned Tasks','Edit Assigned Tasks'])
                        <li class="{{$method=='assign_task' ? 'active' : ''}}"><a href="{{route('assign_task')}}">Assign & Track Task</a></li>
                    @endcanany
                    
                    @canany(['View User Transfer','New User Transfer','Edit User Transfer'])
                        <li class="{{$method=='user_transfer' ? 'active' : ''}}"><a href="{{route('user_transfer')}}">User Transfer</a></li>
                    @endcanany
                </ul>
            </li>
            @endcanany
            
            @canany(['View Vehicles', 'Add Vehicle', 'Edit Vehicle', 'Remove Vehicle','Dispose Vehicle','View Disposed Vehicle','View Vehicle Inventory','Add Vehicle Inventory','Edit Vehicle Inventory','View Vehicle Deployment','Add Vehicle Deployment','Edit Vehicle Deployment','Transfer Vehicle','View Vehicle Transfer Data','Add Vehicle Transfer Data','Edit Vehicle Transfer Data','Remove Vehicle Transfer Data'])
            <li class="{{($method=='create_vehicle' || $method=='vehicles' || $method=='vehicles_inventory' || $method=='add_vehicle_deployement' || $method=='vehicle_deployement_list' || $method=='dispose_vehicle_list' || $method=='vehicle_transfer') ? 'active open' : ''}}"> <a href="javascript:void(0);" class="menu-toggle"><i class="fas fa-car-side"></i><span>Vehicle</span></a>
                <ul class="ml-menu">
                    @can('Add Vehicle')
                        <li class="{{$method=='create_vehicle' ? 'active' : ''}}"><a href="{{ route('create-vehicle') }}">Add/Register Vehicles</a></li>
                    @endcan

                    @canany(['View Vehicles', 'Add Vehicle', 'Edit Vehicle', 'Remove Vehicle','Dispose Vehicle'])
                        <li class="{{$method=='vehicles' ? 'active' : ''}}"><a href="{{ route('vehicles') }}">Registered Vehicle List</a></li>
                    @endcanany

                    @canany(['View Vehicle Inventory','Add Vehicle Inventory','Edit Vehicle Inventory'])
                        <li class="{{$method=='vehicles_inventory' ? 'active' : ''}}"><a href="{{ route('vehicles_inventory') }}">Vehicle Inventory</a></li>
                    @endcanany

                    @can('Add Vehicle Deployment')
                        <li class="{{$method=='add_vehicle_deployement' ? 'active' : ''}}"><a href="{{ route('add_vehicle_deployement') }}">Schedule Vehicle Deployment</a></li>
                    @endcan
                    
                    @canany(['View Vehicle Deployment','Add Vehicle Deployment','Edit Vehicle Deployment'])
                        <li class="{{$method=='vehicle_deployement_list' ? 'active' : ''}}"><a href="{{ route('vehicle_deployement_list') }}">Vehicle Deployment List</a></li>
                    @endcanany

                    @canany(['Dispose Vehicle','View Disposed Vehicle'])
                        <li class="{{$method=='dispose_vehicle_list' ? 'active' : ''}}"><a href="{{ route('dispose_vehicle_list') }}">Disposed Vehicle List</a></li>
                    @endcanany

                    @canany(['View Vehicle Transfer Data','Add Vehicle Transfer Data','Edit Vehicle Transfer Data','Remove Vehicle Transfer Data'])
                    <li class="{{$method=='vehicle_transfer' ? 'active' : ''}}"><a href="{{ route('vehicle_transfer') }}">Vehicle Transfer</a></li>
                    @endcanany
                </ul>
            </li>
            @endcanany

            @canany(['View Fuel Transcation', 'Add Fuel Transcation', 'View Fuel Consumption'])
            <li class="{{($method=='fuel_consumptions' || $method=='fuel_transactions') ? 'active open' : ''}}"> <a href="javascript:void(0);" class="menu-toggle"><i class='fas fa-gas-pump'></i><span>Fuel</span></a>
                <ul class="ml-menu">
                    @canany(['View Fuel Transcation', 'Add Fuel Transcation'])
                        <li class="{{$method=='fuel_transactions' ? 'active' : ''}}"><a href="{{ route('fuel_transactions') }}">Fuel Transactions</a></li>
                    @endcanany

                    @can('View Fuel Consumption')
                        <li class="{{$method=='fuel_consumptions' ? 'active' : ''}}"><a href="{{ route('fuel_consumptions') }}">Fuel Consumptions</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany

            @canany(['View Fuel Expenses', 'Add Fuel Expenses', 'Edit Fuel Expenses', 'Delete Fuel Expenses','View Service Expenses','Add Service Expenses','Edit Service Expenses','Delete Service Expenses','View Repairing Expenses','Add Repairing Expenses','Edit Repairing Expenses','Delete Repairing Expenses','View Purchased Products Expenses','Add Purchased Products Expenses','Edit Purchased Products Expenses','Delete Purchased Products Expenses'])
            <li class="{{($method=='fuel' || $method=='service_expenses' || $method=='repairing_expenses' || $method=='purchased_products') ? 'active open' : ''}}"><a href="javascript:void(0);" class="menu-toggle"><i class="fa fa-inr" aria-hidden="true"></i><span>Expenses</span></a>
                <ul class="ml-menu">
                    @canany(['View Fuel Expenses', 'Add Fuel Expenses', 'Edit Fuel Expenses', 'Delete Fuel Expenses'])
                        <li class="{{$method=='fuel' ? 'active' : ''}}"><a href="{{ route('fuel') }}">Fuel</a></li>
                    @endcanany

                    @canany(['View Service Expenses','Add Service Expenses','Edit Service Expenses','Delete Service Expenses'])
                        <li class="{{$method=='service_expenses' ? 'active' : ''}}"><a href="{{ route('service_expenses') }}">Servicing</a></li>
                    @endcanany

                    @canany(['View Repairing Expenses','Add Repairing Expenses','Edit Repairing Expenses','Delete Repairing Expenses'])
                     <li class="{{$method=='repairing_expenses' ? 'active' : ''}}"><a href="{{ route('repairing_expenses') }}">Repairing</a></li>
                    @endcanany

                    @canany(['View Purchased Products Expenses','Add Purchased Products Expenses','Edit Purchased Products Expenses','Delete Purchased Products Expenses'])
                        <li class="{{$method=='purchased_products' ? 'active' : ''}}"><a href="{{ route('purchased_products') }}">Purchased Products</a></li>
                    @endcanany
                </ul>
            </li>
            @endcanany
            
            @canany(['View Car Log Book', 'Add Car Log Book', 'Edit Car Log Book', 'Delete Car Log Book'])
            <li class="{{($method=='log_management' || $method=='add_log') ? 'active open' : ''}}"><a href="javascript:void(0);" class="menu-toggle"><i class="fas fa-car"></i><span>Car Log Book</span></a>
                <ul class="ml-menu">
                    @canany(['View Car Log Book', 'Add Car Log Book', 'Edit Car Log Book', 'Delete Car Log Book'])
                    <li class="{{$method=='log_management' ? 'active' : ''}}"><a href="{{ route('log_management') }}">Log Management</a></li>
                    @endcanany

                    @can('Add Car Log Book')
                        <li class="{{$method=='add_log' ? 'active' : ''}}"><a href="{{ route('add_log') }}">Add Log</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany

            @canany(['View Daily Diary', 'Add Daily Diary', 'Edit Daily Diary', 'Remove Daily Diary'])
            <li class="{{($method=='daily_diary' || $method=='add_daily_diary') ? 'active open' : ''}}"><a href="javascript:void(0);" class="menu-toggle"><i class="fa-solid fa-book"></i><span>Daily Diary Data</span></a>
                <ul class="ml-menu">
                    @canany(['View Daily Diary', 'Add Daily Diary', 'Edit Daily Diary', 'Remove Daily Diary'])
                        <li class="{{$method=='daily_diary' ? 'active' : ''}}"><a href="{{ route('daily_diary') }}">View Daily Diary</a></li>
                    @endcanany

                    @can('Add Daily Diary')
                        <li class="{{$method=='add_daily_diary' ? 'active' : ''}}"><a href="{{ route('add_daily_diary') }}">Add Daily Diary</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany

            @canany(['View Fuel Consuptions Report', 'View Repairing Report', 'View Servicing Report', 'View Purchased Purchases Report','View Fuel Purchased Report','View Vehicle Inventory Report','View Disposed Vehicle Report','View Transfered Vehicle Report'])
            <li class="{{($method=='fuel_consumptions_report' || $method=='repairing_expenses_report' || $method=='service_expenses_report' || $method=='purchased_products_report' || $method=='fuel_report' || $method=='vehicles_inventory_report' || $method=='dispose_vehicle_list_report' || $method=='vehicle_deployement_list_report') ? 'active open' : ''}}"><a href="javascript:void(0);" class="menu-toggle"><i class="fa fa-file-text"></i><span>Reports</span></a>
                <ul class="ml-menu">
                    @can('View Fuel Consuptions Report')
                     <li class="{{$method=='fuel_consumptions_report' ? 'active' : ''}}"><a href="{{ route('fuel_consumptions_report') }}">Fuel Consumptions</a></li>  
                    @endcan

                    @can('View Repairing Report')
                        <li class="{{$method=='repairing_expenses_report' ? 'active' : ''}}"><a href="{{ route('repairing_expenses_report') }}">Repairing</a></li>    
                    @endcan                

                    @can('View Servicing Report')
                        <li class="{{$method=='service_expenses_report' ? 'active' : ''}}"><a href="{{ route('service_expenses_report') }}">Servicing</a></li>
                    @endcan

                    @can('View Purchased Purchases Report')
                        <li class="{{$method=='purchased_products_report' ? 'active' : ''}}"><a href="{{ route('purchased_products_report') }}">Product Purchase</a></li>
                    @endcan
                    
                    @can('View Fuel Purchased Report')
                        <li class="{{$method=='fuel_report' ? 'active' : ''}}"><a href="{{ route('fuel_report') }}">Fuel Purchased</a></li>                    
                    @endcan

                    @can('View Vehicle Inventory Report')
                        <li class="{{$method=='vehicles_inventory_report' ? 'active' : ''}}"><a href="{{ route('vehicles_inventory_report') }}">Vehicle Inventory</a></li>
                    @endcan

                    @can('View Disposed Vehicle Report')
                        <li class="{{$method=='dispose_vehicle_list_report' ? 'active' : ''}}"><a href="{{ route('dispose_vehicle_list_report') }}">Disposed Vehicle</a></li>
                    @endcan

                    @can('View Transfered Vehicle Report')
                    <li class="{{$method=='vehicle_transfer_list_report' ? 'active' : ''}}"><a href="{{ route('vehicle_transfer_list_report') }}">Transfered Vehicles</a></li>    
                    @endcan 
                </ul>
            </li>
            @endcanany
        </ul>
    </div>
</aside>