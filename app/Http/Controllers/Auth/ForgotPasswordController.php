<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Pregunta;
use App\User;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm(){
        $preguntas = Pregunta::all();
        return view('auth.passwords.email')->with('preguntas',$preguntas);
    }

    public function validateQuestionsForm(Request $request){
        //dd($request);
        $userReset = User::where('email',$request->email)->first();
        if($userReset){
            if($userReset->preguntas()->count()){
                $userAns1 = $userReset->preguntas[0]->pivot->respuesta;
                $userAns2 = $userReset->preguntas[1]->pivot->respuesta;
                $userAns3 = $userReset->preguntas[2]->pivot->respuesta;

                if($userAns1===$request->pregunta1 && $userAns2===$request->pregunta2 && $userAns3===$request->pregunta3){
                    return view('auth.passwords.resetQ')->with('user',$userReset);
                }else{
                    return Redirect::back()->withErrors('Las preguntas de segurida no coinciden');
                }
            }else{
                return Redirect::back()->withErrors('El usuario asociado al correo no tiene preguntas de seguridad');
            }
        }else{
            return Redirect::back()->withErrors('Correo no encontrado');
        }
    }

    public function resetPassword(Request $request){
        
        $userReset = User::where('email',$request->email)->first();
        $userReset->password = bcrypt($request->password);
        $userReset->save();
        Auth::loginUsingId($userReset->id);
        return redirect('/');
    }
}
