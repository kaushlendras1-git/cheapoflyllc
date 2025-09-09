<?php

namespace App\Http\Controllers;

use App\Utils\JsonResponse;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CountryStateController extends Controller
{
    public function state($id){
        try{
            $state = \DB::table('states')->where('country_id',$id)->get();
            return JsonResponse::successWithData('Data fetched',200, $state,'200');
        }
        catch (QueryException $e){
            return JsonResponse::error('Failed to query'.$e, 500,'500');
        }
        catch(\Exception $e){
            return JsonResponse::error('Internal Server Error', 500,'500');
        }
    }
    public function country(){
        try{
            $state = \DB::table('countries')->select('id','name')->get();
            return JsonResponse::successWithData('Data fetched',200, $state,'200');
        }
        catch (QueryException $e){
            return JsonResponse::error('Failed to query', 500,'500');
        }
        catch(\Exception $e){
            return JsonResponse::error('Internal Server Error', 500,'500');
        }
    }
}
