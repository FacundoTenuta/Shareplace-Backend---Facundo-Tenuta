<?php

namespace App\Http\Controllers\Requestion;

use App\Http\Controllers\ApiController;
use App\Requestion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoanController extends ApiController
{


    public function __construct()
    {
        // $this->middleware('jwt', ['except' => ['login']]);
    }


    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $loans = Requestion::all()->where('isLoan', true)->where('active', true);
        return $this->showAll($loans);
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

        $reglas = [
            'publication' => 'required',
            'user' => 'required',
            'reason' => 'required',
            // 'images' => 'required',
            // 'conditions' => 'required',
        ];

        $this->validate($request, $reglas);


        //
        $loan = new Requestion();
        $loan->title = $request->title;
        // $solicitud->fromDate = $request->fromDate;
        // $solicitud->untilDate = $request->untilDate;
        $loan->reason = $request->reason;
        $loan->active = true;
        $loan->isLoan = false;
        $loan->publication_id = $request->publication;
        $loan->requester_id = $request->user;
        $loan->fromDate = $request->fromDate;
        $loan->untilDate = $request->untilDate;

        $loan->save();

        return $this->showOne($loan, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Requestion $loan)
    {
        //
        //$solicitud = App\Request::findOrFail($request->$id);

        return $this->showOne($loan);
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
    public function update(Request $request, Requestion $loan)
    {
        //
        $loan = Requestion::findOrFail($loan->id);

        // $requestion->title = $request->title;
        // $requestion->fromDate = $request->fromDate;
        // $requestion->untilDate = $request->untilDate;
        // $requestion->reason = $request->reason;
        // $requestion->publication_id = $request->publication_id;
        // $requestion->requester_id = $request->requester_id;

        $loan->isLoan = $request->isLoan;
        if ($request->has('startDate')) {
            $loan->startDate = $request->startDate;
        }
        if ($request->has('endDate')) {
            $loan->endDate = $request->endDate;
        }
        $loan->active = $request->active;
        

        $loan->save();

        return $this->showOne($loan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requestion $loan)
    {
        //
        //$solicitud = App\Request::findOrFail($request->$id);

        $loan->delete();

        return $this->showOne($loan);
    }
}
