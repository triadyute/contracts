<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**if(Auth::user()->hasRole('SuperUser')){
            $users = User::all();
        }
        elseif(Auth::user()->hasRole('Admin'))
        {
            $users = User::where('company_id', Auth::user()->company_id)->get();
        }**/
        $users = User::all();
        return view('users.index', compact('users'));
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
            'password' => $data['password'],
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
        return view('users.show', compact('user'));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
