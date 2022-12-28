<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//agregamos lo siguiente
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Sin paginación
        /* $usuarios = User::all();
        return view('usuarios.index',compact('usuarios')); */

        //Con paginación
        $usuarios = User::paginate(5);
        return view('usuarios.index', compact('usuarios'));

        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $usuarios->links() !!}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //aqui trabajamos con name de las tablas de users
        $clientes = Cliente::pluck('nombrecompleto', 'nombrecompleto')->all();
        $roles = Role::pluck('name', 'name')->all();
        return view('usuarios.crear', compact('roles', 'clientes'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            'clientes' => 'required',
            'economico' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
            'rol' => implode($input['roles']),
            'clientes' => implode($input['clientes']),
            'economico' =>$input['economico'],
        ]);
        $user->assignRole($request->input('roles'));

        return redirect()->route('usuarios.index');
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
        $clientes = Cliente::pluck('nombrecompleto', 'nombrecompleto')->all();
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('usuarios.editar', compact('user', 'roles', 'userRole', 'clientes'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'rol' => 'required',
            'clientes' => 'required',
            'economico' => 'required',
        ]);
        $input = $request->all();
        $user = User::find($id);
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
            $user->update(
                [
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'password' => $input['password'],
                    'rol' => $input['rol'],
                    'clientes' => $input['clientes'],
                    'economico' => $input['economico'],
                ]
            );
        } else {
            $input = Arr::except($input, array('password'));
            $user->update(
                [
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'rol' => $input['rol'],
                    'clientes' => $input['clientes'],
                    'economico' => $input['economico'],
                ]
            );
        }
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('rol'));
        return redirect()->route('usuarios.index');
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
        return redirect()->route('usuarios.index');
    }
}
