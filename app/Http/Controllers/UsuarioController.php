<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Cargo;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::all();
        //return $usuario;
        return view('usuario.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::all();
        $cargos = Cargo::all();
        $roles = Role::all();
        return view('usuario.create', compact('areas', 'cargos', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'area_id' => 'required|numeric',
            'cargo_id' => 'required|numeric',
            'ci' => 'required',
            'email' => 'required|email',
            'rol_id' => 'required|numeric',
            'password' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
            'apellido.required' => 'El campo apellido es obligatorio',
            'area_id.required' => 'El campo area es obligatorio',
            'cargo_id.required' => 'El campo cargo es obligatorio',
            'ci.required' => 'El campo ci es obligatorio',
            'email.required' => 'El campo correo es obligatorio',
            'rol_id.required' => 'El campo rol es obligatorio',
            'password.required' => 'El campo contraseña es obligatorio',
        ]);

        $usuario = Usuario::create([
            'nombre' => $request['nombre'],
            'apellido' => $request['apellido'],
            'area_id' => $request['area_id'],
            'cargo_id' => $request['cargo_id'],
            'ci' => $request['ci'],
        ]);
        $pass = Hash::make($request['password']);

        $users = new User();
        $users->name = $request['apellido'];
        $users->email = $request['email'];
        $users->password = $pass;
        $users->usuario_id = $usuario->id;
        $users->save();

        // vincular rol
        $users->assignRole($request['rol_id']);

        return redirect()->route('usuario.index', $usuario);
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
    public function edit(Usuario $usuario)
    {
        $cargos = Cargo::all();
        $user = User::find($usuario->user->id);
        $areas = Area::all();
        $roles = Role::all();
        $rol = $user->roles->first();
        return view('usuario.edit', compact('usuario', 'cargos', 'user', 'areas', 'roles', 'rol'));
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
        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'ci' => 'required',
            'email' => 'required|email',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
            'apellido.required' => 'El campo apellido es obligatorio',
            'ci.required' => 'El campo ci es obligatorio',
            'email.required' => 'El campo correo es obligatorio',
        ]);

        $usuario = Usuario::find($id);
        $user = User::find($usuario->user->id);

        $usuario->update($request->all());

        $request['password'] ? $pass = Hash::make($request['password']) : $pass = $user->password;
        $user->update([
            'name' => $request['apellido'],
            'email' => $request['email'],
            'password' => $pass,
        ]);

        // vincular rol
        $request['rol_id'] ? $user->syncRoles($request['rol_id']) : '';

        return redirect()->route('usuario.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        $id = $usuario->id;
        $user = User::where('users.usuario_id', $id)->first();
        $usuario->delete();
        $user->delete();
        return back()->with('mensaje', 'Eliminado Correctamente');
    }
}
