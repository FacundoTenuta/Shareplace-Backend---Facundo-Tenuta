<?php
 
 namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

 trait ApiResponser{

 	private function successResponse($data, $code){

 		return response()->json($data, $code);

 	}

 	protected function errorResponse($message, $code){

 		return response()->json(['error' => $message, 'code' => $code], $code);

 	}

 	protected function showAll(Collection $collection, $code = 200){

 		$collection = $this->paginate($collection);

 		return $this->successResponse($collection, $code);


 	}

 	protected function showOne(Model $instance, $code = 200){

 		return $this->successResponse(['data' => $instance], $code);

 	}

 	protected function paginate(Collection $collection){
 		$page = LengthAwarePaginator::resolveCurrentPage();

 		$perPage = 10;

 		$results = $collection->slice(($page - 1) * $perPage, $perPage)->values();

 		$paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
 				'path' => LengthAwarePaginator::resolveCurrentPath()]
 			);

 		$paginated->appends(request()->all());

 		return $paginated;
 	}

 }