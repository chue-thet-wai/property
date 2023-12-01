<?php
    
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;
use App\Models\Permissions;
use App\Models\Roles;
use App\Models\RolesPermissions;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use DB;
    
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        /* $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);*/
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Roles::orderBy('id','DESC')->get();
        return view('roles.index',compact('roles'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu       =  DB::table('menu')->get();

        $permission=[];
        $permissions_list = Permissions::get();
        foreach($permissions_list as $per) {
            $permission[$per->menu_id][$per->action] = $per->id;
        }
       
        return view('roles.create',compact('menu','permission'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $login_id = Auth::user()->id;
        $nowDate  = date('Y-m-d H:i:s', time());
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role_insert = array(
            'name'          => $request->name,
            'created_by'    => $login_id,
            'updated_by'    => $login_id,
            'created_at'    =>$nowDate,
            'updated_at'    =>$nowDate
        );
        $role_id=DB::table('roles')->insertGetId($role_insert);
 
        if ($role_id !== null) {
            $permission = $request->permission;
            for ($i=0;$i<count($permission);$i++) {
                $permission_insert[] = array(
                    'role_id'       =>$role_id,
                    'permission_id' =>$permission[$i],
                    'created_by'    =>$login_id,
                    'updated_by'    =>$login_id,
                    'created_at'    =>$nowDate,
                    'updated_at'    =>$nowDate
                );
            }
            $permission=RolesPermissions::insert($permission_insert);
            if ($permission) {
                return redirect()->route('roles.index')
                    ->with('success','Role created successfully');
            } else {
                return redirect()->route('roles.index')
                    ->with('success','Fail in Created Role.');
            }
        }  else {
            return redirect()->route('roles.index')
                    ->with('success','Fail in Created Role.');
        }      
       
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('roles.show',compact('role','rolePermissions'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu       =  DB::table('menu')->get();

        $permission=[];
        $permissions_list = Permissions::get();
        foreach($permissions_list as $per) {
            $permission[$per->menu_id][$per->action] = $per->id;
        }

        $role = Roles::find($id);

        $rolepermissions = RolesPermissions::where("role_id",$id)
            ->whereNull('deleted_at')
            ->pluck('permission_id')
            ->all();
        
        return view('roles.edit',compact('role','menu','permission','rolepermissions'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $login_id = Auth::user()->id;
        $nowDate  = date('Y-m-d H:i:s', time());
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Roles::find($id);
        $role->name       = $request->input('name');
        $role->updated_by = $login_id;
        $role->updated_at = $nowDate;
        $res = $role->save();
 
        if ($res !== null) {
            $old_permissions = RolesPermissions::where("role_id",$id)
                                ->whereNull('deleted_at')
                                ->pluck('permission_id')
                                ->all();
            $permission = $request->permission;

            $del_permission    = array_values(array_diff($old_permissions,$permission));
            $insert_permission = array_values(array_diff($permission,$old_permissions));
            
            if (!empty($del_permission)) {
                $del_permissions_res = RolesPermissions::where("role_id", $id)
                                ->whereIn("permission_id", $del_permission)
                                ->delete();
            }

            if (!empty($insert_permission)) {
                for ($i=0;$i<count($insert_permission);$i++) {
                    $permission_insert[] = array(
                        'role_id'       =>$id,
                        'permission_id' =>$insert_permission[$i],
                        'created_by'    =>$login_id,
                        'updated_by'    =>$login_id,
                        'created_at'    =>$nowDate,
                        'updated_at'    =>$nowDate
                    );
                }

                $permission=RolesPermissions::insert($permission_insert);
                if (!$permission) {
                    return redirect()->route('roles.index')
                            ->with('success','Role updated Fail');
                }
            } 
            return redirect()->route('roles.index')
                            ->with('success','Role updated successfully');

        }  else {
            return redirect()->route('roles.index')
                        ->with('success','Role updated Fail');
        }    

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Roles::where('id',$id)->delete();
        RolesPermissions::where('role_id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }
}