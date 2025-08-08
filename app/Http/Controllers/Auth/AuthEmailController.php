<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TravelBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AuthEmail;
use App\Utils\JsonResponse;


class AuthEmailController extends Controller
{
    public function index()
    {
          $id =73;
          $booking = TravelBooking::findOrFail($id);
          $booking->email= 'credentials@cheapoflytravel.com';

        //try{
            
            Mail::to($booking->email)->send(new AuthEmail($booking));
            return JsonResponse::success('Auth Email sent successfully.', 201,'201');

    //     }
    //     catch(ValidationException $e){
    //         return JsonResponse::error($e->validator->errors()->first(),422,'422');
    //     }
    //     catch(QueryException $e){
    //         return JsonResponse::error('Failed to Query',500,'500');
    //     }
    //     catch(\Exception $e){
    //         return JsonResponse::error('Internal Server Error',500,'500');
    //     }    
        
        
     }
}
