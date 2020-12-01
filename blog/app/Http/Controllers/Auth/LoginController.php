<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public $timestamps = false;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/tarefas';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(Request $request){
        $tentativas = $request->session()->get('tentativa_login', 0);
        return view('login', [
            'tentativas' => $tentativas
        ]);
    }

    public function authentication(Request $request){
        $tentativas = $request->session()->get('tentativa_login', 0);
        
        $creds = $request->only([
            'email',
            'password'
        ]);
           
        if(Auth::attempt($creds) == false){
            $tentativas++;
            $request->session()->put('tentativa_login', $tentativas);
            return redirect()->route('login')->with('warning', 'Email e/ou Senha estão incorretas');    
        }else{
            $request->session()->put('tentativa_login', 0);
            return redirect()->route('tarefas.list');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
