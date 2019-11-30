<?php

namespace App\Http\Controllers\Link;

use App\Http\Controllers\ApiController;
use App\Link;
use Illuminate\Http\Request;

class LinkController extends ApiController
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
        $links = Link::all();
        return $this->showAll($links);
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
            'user_id' => 'required',
        ];

        $this->validate($request, $reglas);

        $link = new Link();
        $link->name = $request->name;
        $link->user_id = $request->user_id;


        $link->save();

        return $this->showOne($link, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        return $this->showOne($link);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    // public function edit(Link $link)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Link $link)
    {
        
        $link->name = $request->name;
        $link->user_id = $request->user_id;


        $link->save();

        return $this->showOne($link, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        $link->delete();

        return $this->showOne($link);
    }
}
