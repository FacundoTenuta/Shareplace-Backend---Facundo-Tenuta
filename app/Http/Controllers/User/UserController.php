<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\ApiController;
use App\User;
use App\Link;
use Illuminate\Http\Request;

class UserController extends ApiController

{

    public function __construct()
    {
        //$this->middleware('jwt', ['except' => ['login']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $usuarios = User::with('links', 'abilities')->get();
        return $this->showAll($usuarios);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $reglas = [
            'name' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'dni' => 'required|unique:users'
        ];

        $this->validate($request, $reglas);

        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->lastName = $request->lastName;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->dni = $request->dni;
        $usuario->birthDate = $request->birthDate;
        $usuario->admin = false;
        $usuario->enabled = true;

        $usuario->save();

        return $this->showOne($usuario, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = User::findOrFail($id);

        return $this->showOne($user);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // public function edit($id)
    // {
    //     //
    // }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $usuario = User::findOrFail($id);

        $reglas = [
            'email' => 'email',
            'password' => 'min:6|confirmed',
        ];

        $this->validate($request, $reglas);

        $usuario->name = $request->name;
        $usuario->lastName = $request->lastName;
        $usuario->email = $request->email;
        $usuario->password = $request->password;
        $usuario->birthDate = $request->birthDate;

        $usuario->save();

        return $this->showOne($usuario);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $usuario = User::findOrFail($id);

        $usuario->delete();

        return $this->showOne($usuario);

    }


    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request){

        $dato = $request->input('busqueda');

        $usuarios = User::with('links', 'abilities')
            ->where('name', 'like', '%'.$dato.'%')
            ->orWhere('lastName', 'like', '%'.$dato.'%')
            ->orWhereHas('abilities', function($q) use ($dato){
                $q->where('name', 'like', '%'.$dato.'%');
            })
            ->get();

        return $this->showAll($usuarios);
    }
}
