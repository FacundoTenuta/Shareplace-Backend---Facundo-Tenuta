<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\ApiController;
use App\Loan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoanController extends ApiController
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
        $prestamos = Loan::all();
        return $this->showAll($prestamos);
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

        $prestamo = new Loan();
        $prestamo->startDate = Carbon::now();
        $prestamo->endDate = $request->endDate;
        $prestamo->requestion_id = $request->requestion_id;


        $prestamo->save();

        return $this->showOne($prestamo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {

        return $this->showOne($loan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    //public function edit(Loan $loan)
    //{
        //
    //}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        
        //$prestamo = Loan::findOrFail($loan->$id);

        $loan->startDate = $request->startDate;
        $loan->endDate = $request->endDate;
        $loan->requestion_id = $request->requestion_id;

        $loan->save();

        return $this->showOne($loan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {

        $loan->delete();

        return $this->showOne($loan);
    }
}
