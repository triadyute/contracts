<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Role;
use App\Company;
use App\Contract;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('SuperUser')){
            $users = User::all();
        }
        elseif(Auth::user()->hasRole('Admin'))
        {
            $users = User::where('company_id', Auth::user()->company_id)->get();
        }
        $contract_alerts = Contract::where('created_by', Auth::user()->id);
        return view('users.index', compact('users', 'contract_alerts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
            //'role' => 'required|string|max:255'
        ]);
        //return $random_password;
        //return $confirmation_token;
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if(request()->guest_role_select == 'role_admin'){
            $role = 3;
        }
        else{
                if(request()->role_select == 'role_admin'){
                    $role = 3;
                }
        
                if(request()->guest_role_select == 'role_admin'){
                    $role = 3;
                }
        
                if(request()->role_select == 'role_editor'){
                    $role = 2;
                }
                if(request()->role_select == 'role_user'){
                    $role = 1;
            }    
        }

        $user->roles()->attach($role);

        /**if(Auth::check())
        {
            $user->company_id = request()->company;//Auth::user()->company_id;
            $user->save();
            Mail::to($user->email)->queue(new AdditionalUserRegistration($user, $random_password));
            return redirect()->route('users.index')->with('status', 'Account created');
        }
        else
        {
            $user->save();
            Mail::to($user->email)->queue(new NewUserRegistration($user, $confirmation_token, $random_password));
            return redirect()->route('login')->with('status', 'Account created, please confirm');
        }**/
        $user->save();
        return 'user saved';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //return $user;
        //dd(request()->all());
        $contract_alerts = Contract::where('created_by', Auth::user()->id)->get();
        foreach($contract_alerts as $contract_alert)
        {
            $contract_alert->primary_contact = User::find($contract_alert->primary_contact);
        }
        return view('users.show', compact('user', 'contract_alerts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        //dd(request()->all());
        request()->validate([
        'name' => 'string|max:255',
        'email' => 'string|email|max:255|unique:users,email,'.$user->id,
        ]);

        $user->name = empty(request()->name) ? $user->name : request()->name;
        $user->email = empty(request()->email) ? $user->email : request()->email;
        //$user->save();

        //assignment of roles
        $roles = array();
        request()->role_select == 'role_user' ? array_push($roles, 1) : '';
        request()->role_select == 'role_editor' ? array_push($roles, 2) : '';
        request()->role_select == 'role_admin' ? array_push($roles, 3) : '';
        
        //return $roles;

        $user->roles()->detach();
        $user->roles()->attach($roles);
        $user->update();
        return redirect()->route('users.index')->with('status', 'User udpated'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->action('UserController@index')->with('status', $user->name .' removed');
    }
}
