<?php

namespace App\Http\Controllers\User;

use App\Condition;
use App\Image;
use App\Publication;
use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Http\Request;


class UserPublicationController extends ApiController
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
    public function index(User $user)
    {
        $publications = $user->publications->fresh('images', 'conditions');

        return $this->showAll($publications);
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
    public function store(Request $request, User $user)
    {

        $reglas = [
            'title' => 'required',
            'description' => 'required',
            'user_id' => 'required',
        ];

        $this->validate($request, $reglas);

        $publication = new Publication();
        $publication->title = $request->title;
        $publication->description = $request->description;
        $publication->user_id = $user->id;
        $publication->createDate = Carbon::now();
        $publication->state = 'disponible';


        return $this->showOne($publication, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function show(Publication $publication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    // public function edit(Publication $publication)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publication $publication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Publication $publication)
    {
        

    }
}
