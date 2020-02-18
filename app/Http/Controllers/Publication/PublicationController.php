<?php

namespace App\Http\Controllers\Publication;

use App\Condition;
use App\Http\Controllers\ApiController;
use App\Image;
use App\Publication;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class PublicationController extends ApiController
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
        $publications = Publication::where('state', true)->with('images', 'conditions', 'categories')->orderBy('created_at', 'desc')->get();
        return $this->showAll($publications);
    }



    // public function index2(User $user)
    // {
    //     $publications = $user->publications;

    //     return $this->showAll($publications);
    // }

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
            'title' => 'required',
            'description' => 'required',
            'user_id' => 'required',
            // 'images' => 'required',
            // 'conditions' => 'required',
        ];

        $this->validate($request, $reglas);


        DB::beginTransaction();
        try{
            $publication = new Publication();
            $publication->title = $request->title;
            $publication->description = $request->description;
            $publication->user_id = $request->user_id;
            $publication->createDate = Carbon::now();
            $publication->state = true;

            if($request->has('principalImage')){
                $publication->principalImage = $request->file('principalImage')->store('', 'images');
            }

            $publication->save();

            

            $image_ids = array();

            if($request->has('images')){

                $images = $request->file('images');

                if (!empty($images)) {
                    for ($i=0; $i < count($images); $i++) {

                        $image = new Image();
                        $image->path = $images[$i]->store('', 'images');
                        $image->date = Carbon::now();
                        $image->publication()->associate($publication);
                        $image->save();
                        $id = $image->id;

                        array_push($image_ids, $id);

                    };
                }
            }
            

            $condition_ids = array();

            if($request->has('images')){

                $conditions = $request->conditions;

                if (!empty($conditions)) {
                    for ($i=0; $i < count($conditions); $i++) {
                        
                        $aux = Condition::select('id')->where('name', strtolower($conditions[$i]))->first();
                        if (empty($aux)) {
                            $condition = new Condition();
                            $condition->name = $conditions[$i];
                            $condition->save();
                        }else{
                            
                            $condition = Condition::findOrFail($aux->id);
                        }

                        
                        $id = $condition->id;

                        array_push($condition_ids, $id);

                    };

                    $publication->conditions()->attach($condition_ids);
                }
            }
            DB::commit();
            $publication = $publication->fresh('images', 'conditions');
            return $this->showOne($publication, 201);
            
        }catch (\Exception $e){
            DB::rollback();
            throw $e;
            
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function show(Publication $publication)
    {
        $publication = $publication->fresh('images', 'conditions', 'categories');
        return $this->showOne($publication);
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

        // $reglas = [
            // 'title' => 'required',
            // 'description' => 'required',
            // 'user_id' => 'required',
            // 'images' => 'required',
            // 'conditions' => 'required',
        // ];

        // $this->validate($request, $reglas);

        DB::beginTransaction();
        try{

            if($request->has('title')){
                $publication->title = $request->title;
            }
            if($request->has('description')){
                $publication->description = $request->description;
            }
            if($request->has('state')){
                $publication->state = $request->state;
            }


            if($request->has('deletedImages')){
                $images_ids = $request->deletedImages;

                for ($i=0; $i < count($images_ids); $i++) { 
                    Image::find($images_ids[$i])->delete();
                }
            }

            if($request->has('principalImage')){
                $publication->principalImage = $request->file('principalImage')->store('', 'images');
            }

            $publication->save();


            // foreach ($publication->images as $image) {
            //         Storage::disk('images')->delete($image->path);
            //     };

            // $publication->images()->delete();

            

            if($request->has('images')){

                $image_ids = array();
                $images = $request->file('images');

                if (!empty($images)) {
                    for ($i=0; $i < count($images); $i++) {

                        $image = new Image();
                        $image->path = $images[$i]->store('', 'images');
                        $image->date = Carbon::now();
                        $image->publication()->associate($publication);
                        $image->save();
                        $id = $image->id;

                        array_push($image_ids, $id);

                    };
                }
            }else{

                
            }




            


            if($request->has('conditions')){

                $condition_ids = array();

                $conditions = $request->conditions;

                if (!empty($conditions)) {
                
                    for ($i=0; $i < count($conditions); $i++) {
                            
                        $aux = Condition::select('id')->where('name', strtolower($conditions[$i]))->first();
                        if (empty($aux)) {
                            $condition = new Condition();
                            $condition->name = $conditions[$i];
                            $condition->save();
                        }else{
                                
                            $condition = Condition::findOrFail($aux->id);
                        }

                            
                        $id = $condition->id;

                        array_push($condition_ids, $id);

                    };
                    $publication->conditions()->sync($condition_ids);
                }
            }else{
                if (!$request->has('state')) {
                    $publication->conditions()->detach();
                }
            }
            

            
            
            
            

            DB::commit();


            $publication = $publication->fresh('images', 'conditions', 'categories');
            return $this->showOne($publication);
        }catch (\Exception $e){
            DB::rollback();
            throw $e;
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publication $publication)
    {

        DB::beginTransaction();
        try{

            if (!($publication->principalImage == 'FondoDePublicacion.jpg')) {
                Storage::disk('images')->delete($publication->principalImage);
            }
            
            foreach ($publication->images as $image) {
                Storage::disk('images')->delete($image->path);
            };

            $publication->images()->delete();
            $publication->conditions()->detach();
            $publication->categories()->detach();
            $publication->delete();

            DB::commit();
            return $this->showOne($publication);

        }catch (\Exception $e){

            DB::rollback();
            throw $e;
            
        }
        
    }


    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request){

        $dato = $request->input('busqueda');

        // where('state', true)->with('images', 'conditions', 'categories')->orderBy('created_at', 'desc')->get();

        $publicaciones = Publication::with('images', 'conditions', 'categories')
            ->where('title', 'like', '%'.$dato.'%')
            ->where('state', '=', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->showAll($publicaciones);
    }
}
