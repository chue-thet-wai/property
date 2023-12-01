<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//use Spatie\Permission\Models\Permission;
use App\Models\Permissions;
use Illuminate\Support\Facades\DB;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nowDate  = date('Y-m-d H:i:s', time());
        //property sale
        $permissions = [
            array(//property sale
                'main_menu' =>"Property",
                "sub_menu"  =>"Sale",
                "action"    =>"list",
                "method"    =>"PropertyController@index"
            ),
            array(
                'main_menu' =>"Property",
                "sub_menu"  =>"Sale",
                "action"    =>"create",
                "method"    =>"PropertyController@create"
            ),
            array(
                'main_menu' =>"Property",
                "sub_menu"  =>"Sale",
                "action"    =>"view",
                "method"    =>"PropertyController@show"
            ),
            array(
                'main_menu' =>"Property",
                "sub_menu"  =>"Sale",
                "action"    =>"edit",
                "method"    =>"PropertyController@edit"
            ),
            array(
                'main_menu' =>"Property",
                "sub_menu"  =>"Sale",
                "action"    =>"delete",
                "method"    =>"PropertyController@delete"
            ),
            array(//property rent
                'main_menu' =>"Property",
                "sub_menu"  =>"Rent",
                "action"    =>"list",
                "method"    =>"PropertyRentController@index"
            ),
            array(
                'main_menu' =>"Property",
                "sub_menu"  =>"Rent",
                "action"    =>"create",
                "method"    =>"PropertyRentController@create"
            ),
            array(
                'main_menu' =>"Property",
                "sub_menu"  =>"Rent",
                "action"    =>"view",
                "method"    =>"PropertyRentController@show"
            ),
            array(
                'main_menu' =>"Property",
                "sub_menu"  =>"Rent",
                "action"    =>"edit",
                "method"    =>"PropertyRentController@edit"
            ),
            array(
                'main_menu' =>"Property",
                "sub_menu"  =>"Rent",
                "action"    =>"delete",
                "method"    =>"PropertyRentController@delete"
            ),
            array(//Invoice
                'main_menu' =>"Invoice",
                "sub_menu"  =>"Invoice",
                "action"    =>"list",
                "method"    =>"InvoiceController@index"
            ),
            array(
                'main_menu' =>"Invoice",
                "sub_menu"  =>"Invoice",
                "action"    =>"create",
                "method"    =>"InvoiceController@create"
            ),
            array(
                'main_menu' =>"Invoice",
                "sub_menu"  =>"Invoice",
                "action"    =>"view",
                "method"    =>"InvoiceController@show"
            ),
            array(
                'main_menu' =>"Invoice",
                "sub_menu"  =>"Invoice",
                "action"    =>"edit",
                "method"    =>"InvoiceController@edit"
            ),
            array(
                'main_menu' =>"Invoice",
                "sub_menu"  =>"Invoice",
                "action"    =>"delete",
                "method"    =>"InvoiceController@delete"
            ),
            array(//contacts
                'main_menu' =>"Contacts",
                "sub_menu"  =>"Contacts",
                "action"    =>"list",
                "method"    =>"OwnerController@index"
            ),
            array(
                'main_menu' =>"Contacts",
                "sub_menu"  =>"Contacts",
                "action"    =>"create",
                "method"    =>"OwnerController@create"
            ),
            array(
                'main_menu' =>"Contacts",
                "sub_menu"  =>"Contacts",
                "action"    =>"view",
                "method"    =>"OwnerController@show"
            ),
            array(
                'main_menu' =>"Contacts",
                "sub_menu"  =>"Contacts",
                "action"    =>"edit",
                "method"    =>"OwnerController@edit"
            ),
            array(
                'main_menu' =>"Contacts",
                "sub_menu"  =>"Contacts",
                "action"    =>"delete",
                "method"    =>"OwnerController@delete"
            ),
            array(//user
                'main_menu' =>"Users",
                "sub_menu"  =>"Users",
                "action"    =>"list",
                "method"    =>"UserController@index"
            ),
            array(
                'main_menu' =>"Users",
                "sub_menu"  =>"Users",
                "action"    =>"create",
                "method"    =>"UserController@create"
            ),
            array(
                'main_menu' =>"Users",
                "sub_menu"  =>"Users",
                "action"    =>"view",
                "method"    =>"UserController@show"
            ),
            array(
                'main_menu' =>"Users",
                "sub_menu"  =>"Users",
                "action"    =>"edit",
                "method"    =>"UserController@edit"
            ),
            array(
                'main_menu' =>"Users",
                "sub_menu"  =>"Users",
                "action"    =>"delete",
                "method"    =>"UserController@delete"
            ),
            array(//agent
                'main_menu' =>"Agents",
                "sub_menu"  =>"Agents",
                "action"    =>"list",
                "method"    =>"AgentController@index"
            ),
            array(
                'main_menu' =>"Agents",
                "sub_menu"  =>"Agents",
                "action"    =>"create",
                "method"    =>"AgentController@create"
            ),
            array(
                'main_menu' =>"Agents",
                "sub_menu"  =>"Agents",
                "action"    =>"view",
                "method"    =>"AgentController@show"
            ),
            array(
                'main_menu' =>"Agents",
                "sub_menu"  =>"Agents",
                "action"    =>"edit",
                "method"    =>"AgentController@edit"
            ),
            array(
                'main_menu' =>"Agents",
                "sub_menu"  =>"Agents",
                "action"    =>"delete",
                "method"    =>"AgentController@delete"
            ),
            array(//role and permission
                'main_menu' =>"Roles & Permission",
                "sub_menu"  =>"Roles & Permission",
                "action"    =>"list",
                "method"    =>"RoleController@index"
            ),
            array(
                'main_menu' =>"Roles & Permission",
                "sub_menu"  =>"Roles & Permission",
                "action"    =>"create",
                "method"    =>"RoleController@create"
            ),
            array(
                'main_menu' =>"Roles & Permission",
                "sub_menu"  =>"Roles & Permission",
                "action"    =>"view",
                "method"    =>"RoleController@show"
            ),
            array(
                'main_menu' =>"Roles & Permission",
                "sub_menu"  =>"Roles & Permission",
                "action"    =>"edit",
                "method"    =>"RoleController@edit"
            ),
            array(
                'main_menu' =>"Roles & Permission",
                "sub_menu"  =>"Roles & Permission",
                "action"    =>"delete",
                "method"    =>"RoleController@delete"
            ),
            array(//division
                'main_menu' =>"Setup",
                "sub_menu"  =>"Division",
                "action"    =>"list",
                "method"    =>"DivisionController@index"
            ),
            array(
                'main_menu' =>"Setup",
                "sub_menu"  =>"Division",
                "action"    =>"create",
                "method"    =>"DivisionController@create"
            ),
            array(
                'main_menu' =>"Setup",
                "sub_menu"  =>"Division",
                "action"    =>"edit",
                "method"    =>"DivisionController@show"
            ),
            array(//township
                'main_menu' =>"Setup",
                "sub_menu"  =>"Township",
                "action"    =>"list",
                "method"    =>"TownshipController@index"
            ),
            array(
                'main_menu' =>"Setup",
                "sub_menu"  =>"Township",
                "action"    =>"create",
                "method"    =>"TownshipController@create"
            ),
            array(
                'main_menu' =>"Setup",
                "sub_menu"  =>"Township",
                "action"    =>"edit",
                "method"    =>"TownshipController@show"
            ),
            array(//ward
                'main_menu' =>"Setup",
                "sub_menu"  =>"Ward",
                "action"    =>"list",
                "method"    =>"WardController@index"
            ),
            array(
                'main_menu' =>"Setup",
                "sub_menu"  =>"Ward",
                "action"    =>"create",
                "method"    =>"WardController@create"
            ),
            array(
                'main_menu' =>"Setup",
                "sub_menu"  =>"Ward",
                "action"    =>"edit",
                "method"    =>"WardController@show"
            ),
            array(//Tenure Property
                'main_menu' =>"Setup",
                "sub_menu"  =>"Tenure Property",
                "action"    =>"list",
                "method"    =>"TenureController@index"
            ),
            array(
                'main_menu' =>"Setup",
                "sub_menu"  =>"Tenure Property",
                "action"    =>"create",
                "method"    =>"TenureController@create"
            ),
            array(
                'main_menu' =>"Setup",
                "sub_menu"  =>"Tenure Property",
                "action"    =>"edit",
                "method"    =>"TenureController@show"
            ),
            array(//Property Type
                'main_menu' =>"Setup",
                "sub_menu"  =>"Property Type",
                "action"    =>"list",
                "method"    =>"PropertyTypeController@index"
            ),
            array(
                'main_menu' =>"Setup",
                "sub_menu"  =>"Property Type",
                "action"    =>"create",
                "method"    =>"PropertyTypeController@create"
            ),
            array(
                'main_menu' =>"Setup",
                "sub_menu"  =>"Property Type",
                "action"    =>"edit",
                "method"    =>"PropertyTypeController@show"
            ),
            array(//Floor
                'main_menu' =>"Setup",
                "sub_menu"  =>"Floor",
                "action"    =>"list",
                "method"    =>"FloorController@index"
            ),
            array(
                'main_menu' =>"Setup",
                "sub_menu"  =>"Floor",
                "action"    =>"create",
                "method"    =>"FloorController@create"
            ),
            array(
                'main_menu' =>"Setup",
                "sub_menu"  =>"Floor",
                "action"    =>"edit",
                "method"    =>"FloorController@show"
            ),            
        ];
    
        foreach ($permissions as $permission) {
            //check and insert sub_menu
            $menu_id = DB::table('menu')
                        ->where(['main_menu' => $permission['main_menu'], 'sub_menu' => $permission['sub_menu']])
                        ->value('id');
        
            if ($menu_id == null) {
                $menu_insert = array(
                    'main_menu'     => $permission['main_menu'],
                    'sub_menu'      => $permission['sub_menu'],
                    'created_by'    =>'1',
                    'updated_by'    =>'1',
                    'created_at'    =>$nowDate,
                    'updated_at'    =>$nowDate
                );
                $menu_id=DB::table('menu')->insertGetId($menu_insert);
            }    

            $chkPermission = Permissions::where(['menu_id'=>$menu_id,'action'=> $permission['action']])->first();
            if (!empty($chkPermission)) {
                Permissions::where(['menu_id'=>$menu_id,'action'=> $permission['action']])
                ->update(
                    [
                        'menu_id'            => $menu_id,
                        'action'             => $permission['action'],
                        'controller_method'  => $permission['method'],
                        'created_by'         =>'1',
                        'updated_by'         =>'1'
                    ]
                );
            } else {
                Permissions::create(
                    [
                        'menu_id'            => $menu_id,
                        'action'             => $permission['action'],
                        'controller_method'  => $permission['method'],
                        'created_by'         =>'1',
                        'updated_by'         =>'1',
                        'created_at'         =>$nowDate,
                        'updated_at'         =>$nowDate
                    ]
                );
            }
        }
    }
}