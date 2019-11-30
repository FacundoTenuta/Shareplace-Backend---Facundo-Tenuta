<?php

namespace App\Http\Controllers\Publication;

use App\Http\Controllers\ApiController;
use App\Image;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ImageController extends ApiController
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
        $images = Image::all();
        return $this->showAll($images);
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
            'publication_id' => 'required',
            'path' => 'required',
        ];

        $this->validate($request, $reglas);

        $image = new Image();
        $image->path = $request->path;
        $image->publication_id = $request->publication_id;
        $image->date = Carbon::now();

        $image->save();

        return $this->showOne($image, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PublicationImage  $publicationImage
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = Image::find($id);
        
        return $this->showOne($image);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PublicationImage  $publicationImage
     * @return \Illuminate\Http\Response
     */
    // public function edit(PublicationImage $publicationImage)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PublicationImage  $publicationImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        
        $image->path = $request->path;
        $image->publication_id = $request->publication_id;

        $image->save();

        return $this->showOne($image);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PublicationImage  $publicationImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $image->delete();

        return $this->showOne($image);
    }
}
