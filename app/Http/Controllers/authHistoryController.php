<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TravelBooking;
use App\Utils\JsonResponse;
use App\Models\AuthHistory;


class AuthHistoryController extends Controller
{

    public function index($id) {
        $id = decode($id);
        $auth_histories = AuthHistory::where('auth_histories.booking_id', $id)->get();
        return view('web.mail-history.index',compact('auth_histories'));
    }


    public function sendSms($id) {
       try{
            #$booking = TravelBooking::findOrFail($id);
            #Mail::to($booking->email)->send(new AuthEmail($booking));
            return JsonResponse::success('SMS has been Sent.', 201,'201');
        }
        catch(ValidationException $e){
            return JsonResponse::error($e->validator->errors()->first(),422,'422');
        }
        catch(QueryException $e){
            return JsonResponse::error('Failed to Query',500,'500');
        }
        catch(\Exception $e){
            return JsonResponse::error('Internal Server Error',500,'500');
        }
    }


    public function sendWhatsApp($id) {
        $booking = TravelBooking::findOrFail($id);
        $phone = preg_replace('/[^0-9]/', '', $booking->phone);
        $message = urlencode("Hi {$booking->name}, your booking is confirmed.");
        return redirect("https://wa.me/{$phone}?text={$message}");
    }

}
