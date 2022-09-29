<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Cargo;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = DB::table('usuarios')->join('cargos', 'cargos.id', '=', 'usuarios.cargo_id')->join('area', 'area.id', '=', 'usuarios.area_id')->select('cargos.nombre as cargo', 'usuarios.nombre as nombre', 'usuarios.apellido', 'usuarios.id', 'area.nombre as area')->get();
        //return $usuario;
        return view('usuario.index', compact('usuario'));
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
        return view('usuario.create', compact('areas', 'cargos'));
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
            'nombre' => 'required',
            'apellido' => 'required',
            'area_id' => 'required',
            'cargo_id' => 'required',
            'ci' => 'required'
        ]);

        $usuario = Usuario::create([
            'nombre' => $request['nombre'],
            'apellido' => $request['apellido'],
            'area_id' => $request['area_id'],
            'cargo_id' => $request['cargo_id'],
            'ci' => $request['ci'],
        ]);
        $pass = Hash::make($request['password']);
        $id = Usuario::latest('id')->first()->id;


        $users = new User();
        $users->name = $request['apellido'];
        $users->email = $request['email'];
        $users->password = $pass;
        $users->usuario_id = $id;
        $users->save();

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
        $user = User::all();
        $areas = Area::all();
        return view('usuario.edit', compact('usuario', 'cargos', 'user', 'areas'));
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
        $user_id = User::where('users.usuario_id', $id)->first();

        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'area_id' => 'required',
            'cargo_id' => 'required',
            'ci' => 'required'
        ]);

        $usuario = Usuario::find($id);
        $usuario->nombre = $request['nombre'];
        $usuario->apellido = $request['apellido'];
        $usuario->area_id = $request['area_id'];
        $usuario->cargo_id = $request['cargo_id'];
        $usuario->ci = $request['ci'];
        $usuario->save();
        $pass = Hash::make($request['password']);
        $users = User::find($user_id->id);
        $users->name = $request['apellido'];
        $users->email = $request['email'];
        $users->password = $pass;
        $users->save();

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
