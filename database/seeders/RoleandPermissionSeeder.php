<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Permissions;
use App\Models\RolesPermissions;

class RoleandPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nowDate  = date('Y-m-d H:i:s', time());

        //create role
        $rolecheck=DB::table('roles')->first();
        if ($rolecheck == null) {
            $role_insert = array(
                'name'       => 'Admin',
                'created_by'    =>'1',
                'updated_by'    =>'1',
                'created_at'  =>$nowDate,
                'updated_at'  =>$nowDate
            );
            $create_role=DB::table('roles')->insert($role_insert);
        }       

        $del=RolesPermissions::where('role_id','1')->delete();

        //get permission
        $permission_list = Permissions::all();
        //add role and permission
        foreach ($permission_list as $permission) {
            $addRoleandPermission = array(
                'role_id'       => '1',
                'permission_id' => $permission->id,
                'created_by'    =>'1',
                'updated_by'    =>'1',
                'created_at'  =>$nowDate,
                'updated_at'  =>$nowDate
            );
            $res=RolesPermissions::insert($addRoleandPermission);
        }    
    }
}
