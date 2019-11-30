<?php

namespace App\Http\Controllers\Condition;

use App\Condition;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class ConditionController extends ApiController
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
        $condiciones = Condition::all();
        return $this->showAll($condiciones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function create()
    //{
        //
    //}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $condicion = new Condition();
        $condicion->name = $request->name;
        
        $condicion->save();

        return $this->showOne($condicion, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Condition  $condition
     * @return \Illuminate\Http\Response
     */
    public function show(Condition $condition)
    {
        return $this->showOne($condition);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Condition  $condition
     * @return \Illuminate\Http\Response
     */
    /*public function edit(Condition $condition)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Condition  $condition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Condition $condition)
    {
        $condition->name = $request->name;

        $condition->save();

        return $this->showOne($condition);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Condition  $condition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Condition $condition)
    {
        $condition->delete();

        return $this->showOne($condition);
    }
}
