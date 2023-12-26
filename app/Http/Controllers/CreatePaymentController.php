<?php

namespace App\Http\Controllers;


use App\Models\Cliente;
use App\Mail\AppErrorMail;
use App\Mail\LowHoursEmail;
use Illuminate\Http\Request;
use App\Actions\CreatePaymentAction;
use Illuminate\Support\Facades\Mail;

class CreatePaymentController extends Controller
{

    public function index(Request $request){
        $email=$request->input('email');
        $cliente=Cliente::where('email',$email)->first();
        if (!$cliente) {
            Mail::to(getenv('MAIL_USERNAME'))->queue(new AppErrorMail('Al intentar enviar email de horas bajas no se encontró cliente asociado al email '.$email));
            return response()->json(['error' => 'No se encontro el cliente'], 404);

        }
        $first_name=$cliente->first_name;
        $last_name=$cliente->last_name;
        
        $pay_action=new CreatePaymentAction();
        $internal_code=$pay_action->handle($email);
        Mail::to($email)->queue(new LowHoursEmail($internal_code,$first_name,$last_name));

    }
}
