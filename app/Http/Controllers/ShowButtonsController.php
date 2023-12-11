<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowButtonsController extends Controller
{

    public function index(Request $request){
        $email = $request->input('email');
        $first_name= $request->input('first_name');
        $last_name= $request->input('last_name');
        return view('PaymentChoice',compact('email','first_name','last_name'));
    }
}
