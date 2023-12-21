<?php

namespace App\Http\Controllers;

use App\Models\PaymentModel;
use Illuminate\Http\Request;

class ShowButtonsController extends Controller
{

    public function index(Request $request){
        $uuid=$request->input('uuid');
        $payment=PaymentModel::find($uuid);
        if ($payment === null) {
            // Handle the case when no payment record is found
            // You can return a 404 response or perform any other appropriate action.
            abort(404, 'Payment not found');
        }

        if ($payment->payment_status === 'paid') {
            if ($payment->document_created===false)
                return view('post-compra', [
                    'internal_code' => $payment->id
                ]);
            else {
                return view('process-success');
            }
        }
        $email=$payment->email;
        $first_name=$payment->first_name;
        $last_name=$payment->last_name;
        $internal_code=$payment->id;


        // $email = $request->input('email');
        // $first_name= $request->input('first_name');
        // $last_name= $request->input('last_name');
        return view('PaymentChoice',compact('email','first_name','last_name','internal_code'));
    }
}
