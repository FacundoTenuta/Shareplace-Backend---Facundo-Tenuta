<?php

namespace App\Http\Controllers\Requestion;

use App\Http\Controllers\ApiController;
use App\Requestion;
use Illuminate\Http\Request;

class RequestionController extends ApiController
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
        //
        $solicitudes = Requestion::all();
        return $this->showAll($solicitudes);
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
        //
        $solicitud = new Requestion();
        $solicitud->title = $request->title;
        $solicitud->fromDate = $request->fromDate;
        $solicitud->untilDate = $request->untilDate;
        $solicitud->reason = $request->reason;
        $solicitud->state = 'activo';
        $solicitud->publication_id = $request->publication_id;
        $solicitud->requester_id = $request->requester_id;

        $solicitud->save();

        return $this->showOne($solicitud, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Requestion $requestion)
    {
        //
        //$solicitud = App\Request::findOrFail($request->$id);

        return $this->showOne($requestion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    //public function edit(Request $request)
    //{
        //
    //}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requestion $requestion)
    {
        //
        //$solicitud = Requestion::findOrFail($id);

        $requestion->title = $request->title;
        $requestion->fromDate = $request->fromDate;
        $requestion->untilDate = $request->untilDate;
        $requestion->reason = $request->reason;
        $requestion->publication_id = $request->publication_id;
        $requestion->requester_id = $request->requester_id;

        $requestion->save();

        return $this->showOne($requestion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requestion $requestion)
    {
        //
        //$solicitud = App\Request::findOrFail($request->$id);

        $requestion->delete();

        return $this->showOne($requestion);
    }
}
