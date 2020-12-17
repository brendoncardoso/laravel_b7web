<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
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
    protected $redirectTo = '/painel';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        return view('admin.login');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function logar(Request $request){
        $user = $request->only(['email', 'password']);

        $validator = $this->validator($user);

        $remember = $request->input('remember', false);

        if($validator->fails()){
            return redirect()->route('login')->withErrors($validator)->withInput();
        }else{
            if(Auth::attempt($user, $remember)){
                return redirect()->route('painel');
            }else{
                return redirect()->route('login')->with('warning', 'Email e/ou Senha estão incorretas.');
            }
        }
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:4'],
        ]);
    }
}
