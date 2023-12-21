<?php

namespace App\Http\Controllers;

use App\Models\PaymentModel;
use Illuminate\Http\Request;

class PurchaseSelectController extends Controller
{

    public function index(Request $request){
        $uuid=$request->input('uuid');
        $payment=PaymentModel::find($uuid);
        if ($payment === null) {
            // Handle the case when no payment record is found
            // You can return a 404 response or perform any other appropriate action.
            abort(404, 'Payment not found');
        }
        else{
            if ($payment->payment_status === 'paid') {
                if($payment->invoice_or_receipt==null){
                    return view('post-compra', [
                        'internal_code' => $uuid
                    ]);
                }
                else{
                    return view('success');
                }
                
            }
            else {
                $email=$payment->cliente->email;
                $first_name=$payment->cliente->first_name;
                $last_name=$payment->cliente->last_name;
                $internal_code=$payment->id;
                return view('PaymentChoice',compact('email','first_name','last_name','internal_code'));
            }
        }
        return view('payment-choice', [
            'internal_code' => $uuid
        ]);
    }
}
