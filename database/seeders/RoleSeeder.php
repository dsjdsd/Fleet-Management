<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin','guard_name'=>'web']);
        $userRole = Role::create(['name' => 'Constable Driver','guard_name'=>'web']);
        $userRole = Role::create(['name' => 'Head Constable','guard_name'=>'web']);
        $userRole = Role::create(['name' => 'MT Incharge','guard_name'=>'web']);
        $userRole = Role::create(['name' => 'CO','guard_name'=>'web']);
        $userRole = Role::create(['name' => 'Logistics','guard_name'=>'web']);
        $userRole = Role::create(['name' => 'ADG Logistics','guard_name'=>'web']);
        $userRole = Role::create(['name' => 'SP Logistics','guard_name'=>'web']);
        $userRole = Role::create(['name' => 'Logistics Data Entry','guard_name'=>'web']);
        
        $permissions = Permission::all();

        foreach($permissions as $key=>$val){
            $role = Role::findByName('admin');
            $permission = Permission::findByName($val->name); 
            $role->givePermissionTo($permission);
            $role->save();

            $role = Role::findByName('ADG Logistics');
            $permission = Permission::findByName($val->name); 
            $role->givePermissionTo($permission);
            $role->save();

            $role = Role::findByName('SP Logistics');
            $permission = Permission::findByName($val->name); 
            $role->givePermissionTo($permission);
            $role->save();
        }

        $user = User::find(1);
        $user->assignRole('admin');

        $userId = DB::table('users')->insertGetId([
            'name' => 'ADG Logistics',
            'email' => 'adg_logistics@uppolice.com',
            'pno_number' => '111111111',
            'dob' => date('Y-m-d'),
            'district' => '',
            'contact_number' => '',
            'password' => Hash::make('Adg@Logistics'),
        ]);

        $user = User::find($userId);
        $user->assignRole('ADG Logistics');

        $userId = DB::table('users')->insertGetId([
            'name' => 'SP Logistics',
            'email' => 'sp_logistics@uppolice.com',
            'pno_number' => '222222222',
            'dob' => date('Y-m-d'),
            'district' => '',
            'contact_number' => '',
            'password' => Hash::make('SP@Logistics'),
        ]);

        $user = User::find($userId);
        $user->assignRole('SP Logistics');

        $userId = DB::table('users')->insertGetId([
            'name' => 'Data Entry Logistics',
            'email' => 'data_entry_logistics@uppolice.com',
            'pno_number' => '333333333',
            'dob' => date('Y-m-d'),
            'district' => '',
            'contact_number' => '',
            'password' => Hash::make('DataEntry@Logistics'),
        ]);

        $user = User::find($userId);
        $user->assignRole('Logistics Data Entry');
    }
}
