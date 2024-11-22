<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'View Roles','guard_name'=>'web']);
        Permission::create(['name' => 'Add Role','guard_name'=>'web']);
        Permission::create(['name' => 'Edit Role','guard_name'=>'web']);
        Permission::create(['name' => 'Remove Role','guard_name'=>'web']);
        
        Permission::create(['name' => 'View Model/Make','guard_name'=>'web']);
        Permission::create(['name' => 'Add Model/Make','guard_name'=>'web']);
        Permission::create(['name' => 'Edit Model/Make','guard_name'=>'web']);
        Permission::create(['name' => 'Remove Model/Make','guard_name'=>'web']);

        Permission::create(['name' => 'View Vehicle Color','guard_name'=>'web']);
        Permission::create(['name' => 'Add Vehicle Color','guard_name'=>'web']);
        Permission::create(['name' => 'Edit Vehicle Color','guard_name'=>'web']);
        Permission::create(['name' => 'Delete Vehicle Color','guard_name'=>'web']);

        Permission::create(['name' => 'View Zones','guard_name'=>'web']);
        Permission::create(['name' => 'Add Zones','guard_name'=>'web']);
        Permission::create(['name' => 'Edit Zones','guard_name'=>'web']);
        Permission::create(['name' => 'Remove Zones','guard_name'=>'web']);

        Permission::create(['name' => 'View Ranges','guard_name'=>'web']);
        Permission::create(['name' => 'Add Ranges','guard_name'=>'web']);
        Permission::create(['name' => 'Edit Ranges','guard_name'=>'web']);
        Permission::create(['name' => 'Remove Ranges','guard_name'=>'web']);

        Permission::create(['name' => 'View Districts','guard_name'=>'web']);
        Permission::create(['name' => 'Add Districts','guard_name'=>'web']);
        Permission::create(['name' => 'Edit Districts','guard_name'=>'web']);
        Permission::create(['name' => 'Remove Districts','guard_name'=>'web']);

        Permission::create(['name' => 'View Users','guard_name'=>'web']);
        Permission::create(['name' => 'Add Users','guard_name'=>'web']);
        Permission::create(['name' => 'Edit User','guard_name'=>'web']);
        Permission::create(['name' => 'Remove User','guard_name'=>'web']);
        Permission::create(['name' => 'User Status','guard_name'=>'web']);
        Permission::create(['name' => 'Assign Vehicle','guard_name'=>'web']);
        Permission::create(['name' => 'View Assign Vehicle','guard_name'=>'web']);
        Permission::create(['name' => 'Edit Assign Vehicle','guard_name'=>'web']);
        Permission::create(['name' => 'View Vehicle History','guard_name'=>'web']);
        Permission::create(['name' => 'View Assigned Tasks','guard_name'=>'web']);
        Permission::create(['name' => 'Add Assigned Tasks','guard_name'=>'web']);
        Permission::create(['name' => 'Edit Assigned Tasks','guard_name'=>'web']);

        Permission::create(['name' => 'View User Transfer','guard_name'=>'web']);
        Permission::create(['name' => 'New User Transfer','guard_name'=>'web']);
        Permission::create(['name' => 'Edit User Transfer','guard_name'=>'web']);

        Permission::create(['name' => 'View Vehicles','guard_name'=>'web']);
        Permission::create(['name' => 'Add Vehicle','guard_name'=>'web']);
        Permission::create(['name' => 'Edit Vehicle','guard_name'=>'web']);
        Permission::create(['name' => 'Remove Vehicle','guard_name'=>'web']);
        Permission::create(['name' => 'Dispose Vehicle','guard_name'=>'web']);
        Permission::create(['name' => 'View Disposed Vehicle','guard_name'=>'web']);

        Permission::create(['name' => 'View Vehicle Inventory','guard_name'=>'web']);
        Permission::create(['name' => 'Add Vehicle Inventory','guard_name'=>'web']);
        Permission::create(['name' => 'Edit Vehicle Inventory','guard_name'=>'web']);

        Permission::create(['name' => 'View Vehicle Deployment','guard_name'=>'web']);
        Permission::create(['name' => 'Add Vehicle Deployment','guard_name'=>'web']);
        Permission::create(['name' => 'Edit Vehicle Deployment','guard_name'=>'web']);

        Permission::create(['name' => 'Transfer Vehicle','guard_name'=>'web']);

        Permission::create(['name' => 'View Fuel Transcation','guard_name'=>'web']);
        Permission::create(['name' => 'Add Fuel Transcation','guard_name'=>'web']);

        Permission::create(['name' => 'View Fuel Consumption','guard_name'=>'web']);

        Permission::create(['name' => 'View Fuel Expenses','guard_name'=>'web']);
        Permission::create(['name' => 'Add Fuel Expenses','guard_name'=>'web']);
        Permission::create(['name' => 'Edit Fuel Expenses','guard_name'=>'web']);
        Permission::create(['name' => 'Delete Fuel Expenses','guard_name'=>'web']);

        Permission::create(['name' => 'View Service Expenses','guard_name'=>'web']);
        Permission::create(['name' => 'Add Service Expenses','guard_name'=>'web']);
        Permission::create(['name' => 'Edit Service Expenses','guard_name'=>'web']);
        Permission::create(['name' => 'Delete Service Expenses','guard_name'=>'web']);

        Permission::create(['name' => 'View Repairing Expenses','guard_name'=>'web']);
        Permission::create(['name' => 'Add Repairing Expenses','guard_name'=>'web']);
        Permission::create(['name' => 'Edit Repairing Expenses','guard_name'=>'web']);
        Permission::create(['name' => 'Delete Repairing Expenses','guard_name'=>'web']);

        Permission::create(['name' => 'View Purchased Products Expenses','guard_name'=>'web']);
        Permission::create(['name' => 'Add Purchased Products Expenses','guard_name'=>'web']);
        Permission::create(['name' => 'Edit Purchased Products Expenses','guard_name'=>'web']);
        Permission::create(['name' => 'Delete Purchased Products Expenses','guard_name'=>'web']);

        Permission::create(['name' => 'View Fuel Consuptions Report','guard_name'=>'web']);
        Permission::create(['name' => 'View Repairing Report','guard_name'=>'web']);
        Permission::create(['name' => 'View Servicing Report','guard_name'=>'web']);
        Permission::create(['name' => 'View Purchased Purchases Report','guard_name'=>'web']);
        Permission::create(['name' => 'View Fuel Purchased Report','guard_name'=>'web']);
        Permission::create(['name' => 'View Vehicle Inventory Report','guard_name'=>'web']);
        Permission::create(['name' => 'View Disposed Vehicle Report','guard_name'=>'web']);
        Permission::create(['name' => 'View Transfered Vehicle Report','guard_name'=>'web']);

        Permission::create(['name' => 'View Car Log Book','guard_name'=>'web']);
        Permission::create(['name' => 'Add Car Log Book','guard_name'=>'web']);
        Permission::create(['name' => 'Edit Car Log Book','guard_name'=>'web']);
        Permission::create(['name' => 'Delete Car Log Book','guard_name'=>'web']);

        Permission::create(['name' => 'View Daily Diary','guard_name'=>'web']);
        Permission::create(['name' => 'Add Daily Diary','guard_name'=>'web']);
        Permission::create(['name' => 'Edit Daily Diary','guard_name'=>'web']);
        Permission::create(['name' => 'Remove Daily Diary','guard_name'=>'web']);

        Permission::create(['name' => 'View Vehicle Transfer Data','guard_name'=>'web']);
        Permission::create(['name' => 'Add Vehicle Transfer Data','guard_name'=>'web']);
        Permission::create(['name' => 'Edit Vehicle Transfer Data','guard_name'=>'web']);
        Permission::create(['name' => 'Remove Vehicle Transfer Data','guard_name'=>'web']);

        Permission::create(['name' => 'View Commissionrate Master Data','guard_name'=>'web']);
        Permission::create(['name' => 'Add Commissionrate Master Data','guard_name'=>'web']);
        Permission::create(['name' => 'Edit Commissionrate Master Data','guard_name'=>'web']);
        Permission::create(['name' => 'Remove Commissionrate Master Data','guard_name'=>'web']);

        Permission::create(['name' => 'View Units Master Data','guard_name'=>'web']);
        Permission::create(['name' => 'Add Units Master Data','guard_name'=>'web']);
        Permission::create(['name' => 'Edit Units Master Data','guard_name'=>'web']);
        Permission::create(['name' => 'Remove Units Master Data','guard_name'=>'web']);
    }
}

