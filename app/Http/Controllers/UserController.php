<?php
    
namespace App\Http\Controllers;
    
use DB;
use Auth;
use Hash;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
    
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->get();
        return view('users.index',compact('data'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'phone_no' => 'required|unique:users,phone_no',
            'roles' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $user = new User([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_no' => $request->phone_no,
            'about' => $request->about,
            'remark' => $request->remark,
            'start_working_date' => $request->start_working_date,
            'resignation_date' => $request->resignation_date,
            'address' => $request->address,
        ]);

        if ($request->hasFile('profile_photo')) {
            $profile_photo = $request->profile_photo;
            $imageName = time().rand(1,99).'.'.$profile_photo->extension();            
            $user->profile_photo = $imageName;
            $profile_photo->storeAs('public/user-photos', $imageName);
            // create thumbnail path
            $thumbnailPath = public_path('/thumbnails/user-photos/');
            
            $thumbnailImage = Image::make($profile_photo)->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });

            $thumbnailImage->save($thumbnailPath . DIRECTORY_SEPARATOR . $imageName);
        }

        if ($request->hasFile('document')) {
            $document = $request->document;
            $docName = time().rand(1,99).'.'.$document->extension();            
            $user->document = $docName;
            $document->storeAs('public/user-documents', $docName);
        }
        $user->save();

        $user->assignRole($request->input('roles'));        
        return redirect()->route('users.index')
                ->with('success','User created successfully');        
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('users.show',compact('user','roles','userRole'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','roles','userRole'));
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
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'username' => 'required|unique:users,username,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'phone_no' => 'required|unique:users,phone_no,'.$id,
            'roles' => 'required',
            'password' => 'same:confirm-password'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        if(!empty($request->password)){
           $old_password = $user->password;
           $current_password = Hash::make($request->current_password);
           if($old_password == $current_password){
                $user->password = Hash::make($request->password);
           }else{
                return Redirect::back()->withErrors(['Current Password is incorrect'])->withInput();
           }
        }
        $user->phone_no = $request->phone_no;
        $user->about = $request->about;
        $user->remark = $request->remark;
        $user->start_working_date = $request->start_working_date;
        $user->resignation_date = $request->resignation_date;
        $user->address = $request->address;

        if ($request->hasFile('profile_photo')) {
            Storage::delete('public/' . $user->profile_photo);
            $profile_photo = $request->profile_photo;
            $imageName = time().rand(1,99).'.'.$profile_photo->extension();            
            $user->profile_photo = $imageName;
            $profile_photo->storeAs('public/user-photos', $imageName);
            // create thumbnail path
            $thumbnailPath = public_path('/thumbnails/user-photos/');
            
            $thumbnailImage = Image::make($profile_photo)->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });

            $thumbnailImage->save($thumbnailPath . DIRECTORY_SEPARATOR . $imageName);
        }

        if ($request->hasFile('document')) {
            Storage::delete('public/' . $user->document);
            $document = $request->document;
            $docName = time().rand(1,99).'.'.$document->extension();            
            $user->document = $docName;
            $document->storeAs('public/user-documents', $docName);
        }
        $user->update();

        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->back()->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }


    public function disabled($id){
        $user = User::find($id);
        if($user->status == 1){
            $status = 'disabled';
            $user->status = 0;
        }else{
            $status = 'activated';
            $user->status = 1;

        }

        $user->update();
        
        return back()->with('success','User '. $status .' successfully');
    }
}