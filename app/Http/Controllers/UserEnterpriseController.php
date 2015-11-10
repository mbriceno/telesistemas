<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Bican\Roles\Models\Role;
use App\Profile;
use App\User;
use App\Enterprise;
use Mail;

class UserEnterpriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function create_user($id)
    {
        $roles = Role::where('level', '<=', 20)->lists('name', 'id');
        return view('user_enterprise.create', compact('id', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Profile::$rules);
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
        $user->attachRole($request->input('role_id'));
        $data_profile = array_merge($request->all(), array('user_id' => $user->id));
        $profile = Profile::create($data_profile);
        $enterprise = Enterprise::find($request->input('enterprise_id'));
        $enterprise->staff()->attach($user->id);

        Mail::send('emails.new_staff', ['data' => $request->all(),'empresa'=>$enterprise], function ($m) use ($enterprise, $user, $profile) {
            $m->to($user->email, $profile->nombre . ' ' . $profile->apellido)
                ->cc($enterprise->email, $enterprise->razon_social)
                ->subject('Nuevo usuario para la empresa: ' . $enterprise->razon_social);
        });

        return redirect()
                ->route('admin.empresa.staff', $request->input('enterprise_id'))
                ->with('message', '<div class="alert alert-success" style="margin-top:15px">Usuario creado con Éxito. Un email ha sido enviado con sus datos de sesión</div>');
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
        $roles = Role::where('level', '<=', 20)->lists('name', 'id');

        return view('user_enterprise.edit', compact('user', 'roles'));
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
        $this->validate($request, Profile::$rules_update);

        $user = User::findOrFail($id);
        $user->detachAllRoles();
        $user->attachRole($request->input('role_id'));
        $user->status = $request->input('status');
        $profile = Profile::findOrFail($user->profile->id);
        $profile->update($request->all());
        $enterprise = $user->enterprise;

        if($request->input('password') != ''){
            $this->validate($request, [
                'password' => 'required|confirmed|min:6',
            ]);
            
            $user->password = bcrypt($request->input('password'));
            $user->save();
            
            Mail::send('emails.change_passwd_staff', ['data' => $request->all(), 'empresa' => $enterprise], 
                function ($m) use ($enterprise, $user, $profile) {
                    $m->to($user->email, $profile->nombre . ' ' . $profile->apellido)
                        ->cc($enterprise->email, $enterprise->razon_social)
                        ->subject('Cambio de contraseña, usuario: ' . $user->name);
                }
            );
        }else{
            $user->save();
        }

        return redirect()
                ->route('admin.empresa.staff', $enterprise[0]->id)
                ->with('message', '<div class="alert alert-success" style="margin-top:15px">Usuario actualizado con Éxito.</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $enterprise = $user->enterprise;
        $user->delete();

        return redirect()
                ->route('admin.empresa.staff', $enterprise[0]->id)
                ->with('message', '<div class="alert alert-success" style="margin-top:15px">Usuario eliminado con Éxito.</div>');
    }
}
