<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Carbon\Carbon;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view_users', ['only' => ['index']]);
        $this->middleware('permission:add_users', ['only' => ['create','store']]);
        $this->middleware('permission:edit_users', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_users', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = User::latest()->paginate(10);

        return view('user.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id');

        return view('user.new', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'bail|required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'roles' => 'required|min:1'
        ]);

        // hash password
        $request->merge(['password' => Hash::make($request->get('password'))]);
        $request->request->add(['email_verified_at' => Carbon::now()]);

        // Create the user
        if ( $user = User::create($request->except('roles', 'permissions')) ) {

            $this->syncPermissions($request, $user);

            flash('User has been created.');

        } else {
            flash()->error('Unable to create user.');
        }

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $roles = Role::pluck('name', 'id');
        $permissions = Permission::all('name', 'id');

        return view('user.edit', compact('user', 'roles', 'permissions'));
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
        $this->validate($request, [
            'name' => 'bail|required|min:2',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required|min:1'
        ]);

        // Get the user
        $user = User::findOrFail($id);

        // Update user
        $user->fill($request->except('roles', 'permissions', 'password'));

        // check for password change
        if($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
        }

        // Handle the user roles
        $this->syncPermissions($request, $user);

        $user->save();

        flash()->success('User has been updated.');

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function destroy($id)
    {
        if ( Auth::user()->id == $id ) {

            flash()->warning('Deletion of currently logged in user is not allowed :(')->important();
            return redirect()->back();
        }

        if( User::findOrFail($id)->delete() ) {
            flash()->success('User has been deleted');
        } else {
            flash()->success('User not deleted');
        }

        return redirect()->back();
    }

    /**
     * Sync roles and permissions
     *
     * @param Request $request
     * @param $user
     * @return string
     */
    private function syncPermissions(Request $request, $user)
    {
        // Get the submitted roles
        $roles = $request->get('roles', []);
        $permissions = $request->get('permissions', []);

        // Get the roles
        $roles = Role::find($roles);

        // check for current role changes
        if( ! $user->hasAllRoles( $roles ) ) {
            // reset all direct permissions for user
            $user->permissions()->sync([]);
        } else {
            // handle permissions
            $user->syncPermissions($permissions);
        }

        $user->syncRoles($roles);

        return $user;
    }

    public function profile()
    {
        $user = User::find(Auth::user()->id);

        return view('admin.profile',compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $this->validate(request(),[
            'email'=>'required|max:255|email|string||unique:users,email,'.$user->id,
        ]);
        if (request('email')) {
            $user->email = request('email');
        }

        if (request('password')) {
            $user->password = Hash::make(request('password'));
        }

        $user->save();

        return redirect()->back()->with('success', trans('lang.saveb'));
    }
}
