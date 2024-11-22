<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\VehiclesInventoryController;
use App\Http\Controllers\LogManagementController;
use App\Http\Controllers\DailyDiaryController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\CommisionrateController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['login_status'])->group(function () {
    Route::get('/', [AuthController::class, 'signedin'])->name('Signin');
    
    Route::get('/', [AuthController::class, 'signedin'])->name('login');
    
    Route::post('getloggedin', [AuthController::class, 'getloggedin'])->name('getloggedin');
    
    Route::get('forget-password', [AuthController::class, 'forgetPassword'])->name('forgetPassword');
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('roles', [UserController::class, 'roles'])->name('roles')->middleware('checkPermissions:View Roles,Add Role,Edit Role,Remove Role');

    Route::get('create_role', [UserController::class, 'create_role'])->name('create_role')->middleware('checkPermissions:Add Role');

    Route::post('new_role', [UserController::class, 'new_role'])->name('new_role');

    Route::get('edit_role/{role_id}', [UserController::class, 'edit_role'])->name('edit_role')->middleware('checkPermissions:Edit Role');

    Route::post('update_role', [UserController::class, 'update_role'])->name('update_role');

    Route::post('remove_role', [UserController::class, 'remove_role'])->name('remove_role');

    Route::get('make', [VehicleController::class, 'make'])->name('make')->middleware('checkPermissions:View Model/Make, Add Model/Make, Edit Model/Make,Remove Model/Make');

    Route::get('new_make', [VehicleController::class, 'new_make'])->name('new_make')->middleware('checkPermissions:Add Model/Make');

    Route::post('create_make', [VehicleController::class, 'create_make'])->name('create_make');

    Route::get('edit_make/{make_id}', [VehicleController::class, 'edit_make'])->name('edit_make')->middleware('checkPermissions:Add Model/Make');

    Route::post('update_make', [VehicleController::class, 'update_make'])->name('update_make');

    Route::get('create-vehicle', [VehicleController::class, 'create_vehicle'])->name('create-vehicle')->middleware('checkPermissions:Add Vehicle');

    Route::post('new-vehicle', [VehicleController::class, 'new_vehicle'])->name('new-vehicle');

    // Route::post('get_vehicle_make_color', [VehicleController::class, 'get_vehicle_make_color']);

    Route::get('vehicles', [VehicleController::class, 'vehicles'])->name('vehicles')->middleware('checkPermissions:View Vehicles, Add Vehicle, Edit Vehicle, Remove Vehicle,Dispose Vehicle');

    Route::get('edit_vehicle/{vehicle_id}', [VehicleController::class, 'edit_vehicle'])->name('edit_vehicle')->middleware('checkPermissions:Edit Vehicle');

    Route::get('disposed/{vehicle_id}', [VehicleController::class, 'disposed'])->name('disposed');

    Route::post('remove_vehicle', [VehicleController::class, 'remove_vehicle'])->name('remove_vehicle');

    Route::get('add_vehicle_inventory', [VehiclesInventoryController::class, 'add_vehicle_inventory'])->name('add_vehicle_inventory')->middleware('checkPermissions:Add Vehicle Inventory');

    Route::post('create_vehicle_inventory', [VehiclesInventoryController::class, 'create_vehicle_inventory'])->name('create_vehicle_inventory');

    Route::get('vehicles_inventory', [VehiclesInventoryController::class, 'vehicles_inventory'])->name('vehicles_inventory')->middleware('checkPermissions:View Vehicle Inventory,Add Vehicle Inventory,Edit Vehicle Inventory');

    Route::get('edit_vehicle_inventory/{vehicle_inventory_id}', [VehiclesInventoryController::class, 'edit_vehicle_inventory'])->name('edit_vehicle_inventory')->middleware('checkPermissions:Edit Vehicle Inventory');

    Route::post('remove_vehicle_inventory', [VehiclesInventoryController::class, 'remove_vehicle_inventory'])->name('remove_vehicle_inventory');

    Route::get('vehicle_deployement_list', [VehicleController::class, 'vehicle_deployement_list'])->name('vehicle_deployement_list')->middleware('checkPermissions:View Vehicle Deployment,Add Vehicle Deployment,Edit Vehicle Deployment');

    Route::get('add_vehicle_deployement', [VehicleController::class, 'add_vehicle_deployement'])->name('add_vehicle_deployement')->middleware('checkPermissions:Add Vehicle Deployment');
    
    Route::post('create_vehicle_deployement', [VehicleController::class, 'create_vehicle_deployement'])->name('create_vehicle_deployement');
    
    Route::get('edit_vehicle_deployement/{vehicle_deployed_id}', [VehicleController::class, 'edit_vehicle_deployement'])->name('edit_vehicle_deployement')->middleware('checkPermissions:Edit Vehicle Deployment');

    Route::get('dispose_vehicle_list', [VehicleController::class, 'dispose_vehicle_list'])->name('dispose_vehicle_list')->middleware('checkPermissions:Dispose Vehicle,View Disposed Vehicle');

    Route::get('vehicle_transfer', [VehicleController::class, 'vehicle_transfer'])->name('vehicle_transfer')->middleware('checkPermissions:View Vehicle Transfer Data,Add Vehicle Transfer Data,Edit Vehicle Transfer Data,Remove Vehicle Transfer Data');

    Route::get('add_vehicle_transfer', [VehicleController::class, 'add_vehicle_transfer'])->name('add_vehicle_transfer')->middleware('checkPermissions:Add Vehicle Transfer Data');
    
    Route::post('create_vehicle_transfer', [VehicleController::class, 'create_vehicle_transfer'])->name('create_vehicle_transfer')->middleware('checkPermissions:Add Vehicle Transfer Data');

    Route::get('edit_vehicle_transfer/{vehicle_tranfer_id}', [VehicleController::class, 'edit_vehicle_transfer'])->name('edit_vehicle_transfer')->middleware('checkPermissions:Edit Vehicle Transfer Data');
    
    Route::get('get_searched_vehicles', [VehicleController::class, 'get_searched_vehicles'])->name('get_searched_vehicles');
    
    Route::post('get_zone_wise_range', [VehicleController::class, 'get_zone_wise_range'])->name('get_zone_wise_range');
    
    Route::post('get_range_wise_district', [VehicleController::class, 'get_range_wise_district'])->name('get_range_wise_district');

    //report routes
    Route::get('fuel_report', [ReportController::class, 'fuel_report'])->name('fuel_report')->middleware('checkPermissions:View Fuel Purchased Report');

    Route::get('service_expenses_report', [ReportController::class, 'service_expenses_report'])->name('service_expenses_report')->middleware('checkPermissions:View Servicing Report');

    Route::get('repairing_expenses_report', [ReportController::class, 'repairing_expenses_report'])->name('repairing_expenses_report')->middleware('checkPermissions:View Repairing Report');

    Route::get('purchased_products_report', [ReportController::class, 'purchased_products_report'])->name('purchased_products_report')->middleware('checkPermissions:View Purchased Purchases Report');

    Route::get('vehicles_inventory_report', [ReportController::class, 'vehicles_inventory_report'])->name('vehicles_inventory_report')->middleware('checkPermissions:View Vehicle Inventory Report');

    Route::get('dispose_vehicle_list_report', [ReportController::class, 'dispose_vehicle_list_report'])->name('dispose_vehicle_list_report')->middleware('checkPermissions:View Disposed Vehicle Report');

    Route::get('fuel_consumptions_report', [ReportController::class, 'fuel_consumptions_report'])->name('fuel_consumptions_report')->middleware('checkPermissions:View Fuel Consuptions Report');

    Route::get('vehicle_deployement_list_report', [ReportController::class, 'vehicle_deployement_list_report'])->name('vehicle_deployement_list_report')->middleware('checkPermissions:View Transfered Vehicle Report');;
    
    Route::get('vehicle_transfer_list_report', [ReportController::class, 'vehicle_transfer_list_report'])->name('vehicle_transfer_list_report')->middleware('checkPermissions:View Transfered Vehicle Report');;
    
    //Fuel route
    Route::get('fuel_consumptions', [FuelController::class, 'fuel_consumptions'])->name('fuel_consumptions')->middleware('checkPermissions:View Fuel Consumption');

    Route::get('fuel_transactions', [FuelController::class, 'fuel_transactions'])->name('fuel_transactions')->middleware('checkPermissions:View Fuel Transcation, Add Fuel Transcation');

    Route::get('add_fuel_transaction', [FuelController::class, 'add_fuel_transaction'])->name('add_fuel_transaction')->middleware('checkPermissions:Add Fuel Transcation');

    Route::get('edit_fuel_transaction', [FuelController::class, 'edit_fuel_transaction'])->name('edit_fuel_transaction');
    
    Route::get('fuel', [ExpenseController::class, 'fuel'])->name('fuel')->middleware('checkPermissions:View Fuel Expenses, Add Fuel Expenses, Edit Fuel Expenses, Delete Fuel Expenses');

    Route::get('add_fuel', [ExpenseController::class, 'add_fuel'])->name('add_fuel')->middleware('checkPermissions:Add Fuel Expenses');

    Route::get('edit_fuel', [ExpenseController::class, 'edit_fuel'])->name('edit_fuel')->middleware('checkPermissions:Edit Fuel Expenses');

    Route::get('service_expenses', [ExpenseController::class, 'service_expenses'])->name('service_expenses')->middleware('checkPermissions:View Service Expenses,Add Service Expenses,Edit Service Expenses,Delete Service Expenses');

    Route::get('add_service_expenses', [ExpenseController::class, 'add_service_expenses'])->name('add_service_expenses')->middleware('checkPermissions:Add Service Expenses');
    
    Route::post('user_wise_get_pno_number', [ExpenseController::class, 'user_wise_get_pno_number'])->name('user_wise_get_pno_number')->middleware('checkPermissions:Add Service Expenses');

    Route::post('create_service_expenses', [ExpenseController::class, 'create_service_expenses'])->name('create_service_expenses')->middleware('checkPermissions:Add Service Expenses');

    Route::get('edit_service_expenses/{service_expense_id}', [ExpenseController::class, 'edit_service_expenses'])->name('edit_service_expenses')->middleware('checkPermissions:Edit Service Expenses');

    Route::get('repairing_expenses', [ExpenseController::class, 'repairing_expenses'])->name('repairing_expenses')->middleware('checkPermissions:View Repairing Expenses,Add Repairing Expenses,Edit Repairing Expenses,Delete Repairing Expenses');

    Route::get('add_repairing_expenses', [ExpenseController::class, 'add_repairing_expenses'])->name('add_repairing_expenses')->middleware('checkPermissions:Add Repairing Expenses');
    
    Route::post('create_repairing_expenses', [ExpenseController::class, 'create_repairing_expenses'])->name('create_repairing_expenses')->middleware('checkPermissions:Add Repairing Expenses');

    Route::get('edit_repairing_expenses/{repair_expense_id}', [ExpenseController::class, 'edit_repairing_expenses'])->name('edit_repairing_expenses')->middleware('checkPermissions:Edit Repairing Expenses');

    Route::get('purchased_products', [ExpenseController::class, 'purchased_products'])->name('purchased_products')->middleware('checkPermissions:View Purchased Products Expenses,Add Purchased Products Expenses,Edit Purchased Products Expenses,Delete Purchased Products Expenses');

    Route::get('add_purchased_products', [ExpenseController::class, 'add_purchased_products'])->name('add_purchased_products')->middleware('checkPermissions:Add Purchased Products Expenses');
    
    Route::post('create_purchased_products', [ExpenseController::class, 'create_purchased_products'])->name('create_purchased_products')->middleware('checkPermissions:Add Purchased Products Expenses');

    Route::get('edit_purchased_products/{purchase_expense_id}', [ExpenseController::class, 'edit_purchased_products'])->name('edit_purchased_products')->middleware('checkPermissions:Edit Purchased Products Expenses');

    //district routes
    Route::get('districts', [DistrictController::class, 'districts'])->name('districts')->middleware('checkPermissions:View Districts,Add Districts,Edit Districts,Remove Districts');

    Route::get('add-district', [DistrictController::class, 'add_district'])->name('add-district')->middleware('checkPermissions:Add Districts');

    Route::get('edit-district/{district_id}', [DistrictController::class, 'edit_district'])->name('edit-district')->middleware('checkPermissions:Edit Districts');

    Route::post('district-post', [DistrictController::class, 'district_post'])->name('district-post');

    Route::post('remove_district', [DistrictController::class, 'remove_district'])->name('remove_district');

    //Unit Routes
        Route::get('units', [UnitController::class, 'units'])->name('units')->middleware('checkPermissions:View Units Master Data,Add Units Master Data,Edit Units Master Data,Remove Units Master Data');

        Route::get('add_unit', [UnitController::class, 'add_unit'])->name('add_unit')->middleware('checkPermissions:Add Units Master Data');

        Route::post('create_unit', [UnitController::class, 'create_unit'])->name('create_unit');

        Route::get('edit_unit/{unit_id}', [UnitController::class, 'edit_unit'])->name('edit_unit')->middleware('checkPermissions:Edit Units Master Data');

        Route::post('update_unit', [UnitController::class, 'update_unit'])->name('update_unit');

        Route::post('remove_unit', [UnitController::class, 'remove_unit'])->name('remove_unit');
    //Unit Routes Ends Here

    //Commissionrate Routes
        Route::get('commissionrate', [CommisionrateController::class, 'comissionrate'])->name('commissionrate')->middleware('checkPermissions:View Commissionrate Master Data,Add Commissionrate Master Data,Edit Commissionrate Master Data,Remove Commissionrate Master Data');

        Route::get('add_commissionrate', [CommisionrateController::class, 'add_commissionrate'])->name('add_commissionrate')->middleware('checkPermissions:Add Commissionrate Master Data');

        Route::post('create_commissionrate', [CommisionrateController::class, 'create_commissionrate'])->name('create_commissionrate');

        Route::get('edit_commissionrate/{commissionrate_id}', [CommisionrateController::class, 'edit_commissionrate'])->name('edit_commissionrate')->middleware('checkPermissions:Edit Commissionrate Master Data');

        Route::post('update_commissionrate', [CommisionrateController::class, 'update_commissionrate'])->name('update_commissionrate');

        Route::post('remove_commissionrate', [CommisionrateController::class, 'remove_commissionrate'])->name('remove_commissionrate');
    //Commissionrate Routes Ends Here

    Route::get('zone_master', [DistrictController::class, 'zone_master'])->name('zone_master')->middleware('checkPermissions:View Zones,Add Zones,Edit Zones,Remove Zones');

    Route::get('add_zone_master', [DistrictController::class, 'add_zone_master'])->name('add_zone_master')->middleware('checkPermissions:Add Zones');

    Route::post('create_zone_master', [DistrictController::class, 'create_zone_master'])->name('create_zone_master');

    Route::get('edit_zone_master/{zone_id}', [DistrictController::class, 'edit_zone_master'])->name('edit_zone_master')->middleware('checkPermissions:Edit Zones');

    Route::post('update_zone_master', [DistrictController::class, 'update_zone_master'])->name('update_zone_master');

    Route::post('delete_zone_master', [DistrictController::class, 'delete_zone_master'])->name('delete_zone_master');

    Route::get('range_master', [DistrictController::class, 'range_master'])->name('range_master')->middleware('checkPermissions:View Ranges,Add Ranges,Edit Ranges,Remove Ranges');

    Route::get('add_range_master', [DistrictController::class, 'add_range_master'])->name('add_range_master')->middleware('checkPermissions:Add Ranges');

    Route::post('create_range_master', [DistrictController::class, 'create_range_master'])->name('create_range_master');

    Route::get('edit_range_master/{range_id}', [DistrictController::class, 'edit_range_master'])->name('edit_range_master')->middleware('checkPermissions:Edit Ranges');

    Route::post('update_range_master', [DistrictController::class, 'update_range_master'])->name('update_range_master');

    Route::post('get_zone_range', [DistrictController::class, 'get_zone_range'])->name('get_zone_range');

    Route::post('delete_range_master', [DistrictController::class, 'delete_range_master'])->name('delete_range_master');

    //notification routes
    Route::get('notification', [NotificationController::class, 'notification'])->name('notification');

    // log routes
    Route::get('log_management', [LogManagementController::class, 'log_management'])->name('log_management')->middleware('checkPermissions:View Car Log Book, Add Car Log Book, Edit Car Log Book, Delete Car Log Book');

    Route::get('add_log', [LogManagementController::class, 'add_log'])->name('add_log')->middleware('checkPermissions:Add Car Log Book');

    Route::post('create_log', [LogManagementController::class, 'create_log'])->name('create_log');

    Route::post('get_vehicle_wise_driver', [LogManagementController::class, 'get_vehicle_wise_driver'])->name('get_vehicle_wise_driver');

    Route::post('remove_log', [LogManagementController::class, 'remove_log'])->name('remove_log');

    Route::get('edit_log/{add_log_id}', [LogManagementController::class, 'edit_log'])->name('edit_log')->middleware('checkPermissions:Edit Car Log Book');

    //notification routes
    Route::get('notification', [NotificationController::class, 'notification'])->name('notification');

     //dailydiary routes
    Route::get('daily_diary', [DailyDiaryController::class, 'daily_diary'])->name('daily_diary')->middleware('checkPermissions:View Daily Diary, Add Daily Diary, Edit Daily Diary, Remove Daily Diary');
    
    Route::get('add_daily_diary', [DailyDiaryController::class, 'add_daily_diary'])->name('add_daily_diary')->middleware('checkPermissions:Add Daily Diary');

    Route::post('create_daily_diary_data', [DailyDiaryController::class, 'create_daily_diary_data'])->name('create_daily_diary_data');
    
    Route::get('edit_daily_diary/{daily_diary_id}', [DailyDiaryController::class, 'edit_daily_diary'])->name('edit_daily_diary')->middleware('checkPermissions:Edit Daily Diary');

    Route::post('update_daily_diary_data', [DailyDiaryController::class, 'update_daily_diary_data'])->name('update_daily_diary_data');

    Route::get('get_diary_vehicle_list', [DailyDiaryController::class, 'get_diary_vehicle_list'])->name('get_diary_vehicle_list');

    Route::post('get_diary_vehicle_details', [DailyDiaryController::class, 'get_diary_vehicle_details'])->name('get_diary_vehicle_details');

    Route::post('delete_daily_diary_record', [DailyDiaryController::class, 'delete_daily_diary_record'])->name('delete_daily_diary_record');

    //users routes
    Route::get('all_users', [UserController::class, 'all_users'])->name('all_users')->middleware('checkPermissions:View Users, Add Users, Edit User, Remove User,User Status');
    
    Route::get('new_user', [UserController::class, 'new_user'])->name('new_user')->middleware('checkPermissions:Add Users');
    
    Route::post('add_new_user', [UserController::class, 'add_new_user'])->name('add_new_user');
    
    Route::get('edit_user/{user_id}', [UserController::class, 'edit_user'])->name('edit_user')->middleware('checkPermissions:Edit User');
    
    Route::post('update_user', [UserController::class, 'update_user'])->name('update_user');
    
    Route::post('remove_user', [UserController::class, 'remove_user'])->name('remove_user');
    
    Route::post('update_user_status', [UserController::class, 'update_user_status'])->name('update_user_status');
    
    Route::get('user_profile', [UserController::class, 'user_profile'])->name('user_profile');

    Route::get('assign_vehicle', [UserController::class, 'assign_vehicle'])->name('assign_vehicle')->middleware('checkPermissions:Assign Vehicle');
    
    Route::post('allocate_vehicle', [UserController::class, 'allocate_vehicle'])->name('allocate_vehicle');
    
    Route::get('user_assign_vehicle', [UserController::class, 'user_assign_vehicle'])->name('user_assign_vehicle')->middleware('checkPermissions:Assign Vehicle,View Assign Vehicle,Edit Assign Vehicle');
    
    Route::get('edit_assign_vehicle/{assigned_id}', [UserController::class, 'edit_assign_vehicle'])->name('edit_assign_vehicle')->middleware('checkPermissions:Edit Assign Vehicle');
    
    Route::post('update_assigned_vehicle', [UserController::class, 'update_assigned_vehicle'])->name('update_assigned_vehicle');

    Route::get('user_transfer', [UserController::class, 'user_transfer'])->name('user_transfer')->middleware('checkPermissions:View User Transfer,New User Transfer,Edit User Transfer');
    
    Route::get('add_user_transfer', [UserController::class, 'add_user_transfer'])->name('add_user_transfer')->middleware('checkPermissions:New User Transfer');

    Route::post('create_user_transfer', [UserController::class, 'create_user_transfer'])->name('create_user_transfer');
    
    Route::get('edit_user_transfer/{transfer_id}', [UserController::class, 'edit_user_transfer'])->name('edit_user_transfer')->middleware('checkPermissions:Edit User Transfer');

    Route::post('update_user_transfer', [UserController::class, 'update_user_transfer'])->name('update_user_transfer');

    Route::get('add_task', [UserController::class, 'add_task'])->name('add_task')->middleware('checkPermissions:Add Assigned Tasks');

    Route::post('create_task', [UserController::class, 'create_task'])->name('create_task');

    Route::get('get_searched_users', [UserController::class, 'get_searched_users'])->name('get_searched_users');

    Route::get('assign_task', [UserController::class, 'assign_task'])->name('assign_task')->middleware('checkPermissions:View Assigned Tasks,Add Assigned Tasks,Edit Assigned Tasks');
    
    Route::get('edit_task/{task_id}', [UserController::class, 'edit_task'])->name('edit_task')->middleware('checkPermissions:Edit Assigned Tasks');

    Route::post('update_task', [UserController::class, 'update_task'])->name('update_task');

    Route::post('update_task_status', [UserController::class, 'update_task_status'])->name('update_task_status');

    Route::post('remove_make', [VehicleController::class, 'remove_make'])->name('remove_make');
    
    Route::get('vehicle_color', [VehicleController::class, 'vehicle_color'])->name('vehicle_color')->middleware('checkPermissions:View Vehicle Color,Add Vehicle Color,Edit Vehicle Color,Delete Vehicle Color');

    Route::post('update_user_profile', [UserController::class, 'update_user_profile'])->name('update_user_profile');

    Route::get('user_vehicle_history', [UserController::class, 'user_vehicle_history'])->name('user_vehicle_history')->middleware('checkPermissions:View Vehicle History');

    //xls download code
    Route::get('download_repairing_expense_report', [ReportController::class, 'download_repairing_expense_report'])->name('download_repairing_expense_report');
    
    Route::get('logout', [DashboardController::class, 'logout'])->name('logout');
});
