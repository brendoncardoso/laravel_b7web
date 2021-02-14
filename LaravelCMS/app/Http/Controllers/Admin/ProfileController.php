<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();

        return view('admin.profile.edit', [
            'user' => $user
        ]);
    }

    public function save(Request $request){
        $logged = Auth::user();
        $user = User::find($logged->id);

        if($user){
            $data = $request->only([
                'name',
                'email',
                'password',
                'password_confirmation'
            ]);

            $validator = Validator::make([
                'name' => $data['name'],
                'email' => $data['email']
            ], 
            [
                'name' => ['required', 'string', 'max:500'],
                'email' => ['required', 'string', 'email', 'max:500'],
            ]);

            // 1. Alteração do Nome
            $user->name = $data['name'];

            // 2. Alteração do e-mail
            if($user->email != $data['email']){
                $hasEmail = User::where('email', $data['email'])->get();
                if(count($hasEmail) === 0){
                    $user->email = $data['email'];
                }else{
                    $validator->errors()->add('email', __('validation.unique', [
                        'attribute' => 'email'
                    ]));
                }
            }

            // 3. Alteração da Senha
            if(!empty($data['password'])){
                if(strlen($data['password']) >= 4){
                    if($data['password'] === $data['password_confirmation']) {
                        $user->password = Hash::make($data['password']);
                    } else {
                        $validator->errors()->add('password', __('validation.confirmation', [
                            'attribute' => 'password'
                        ]));
                    }
                } else { 
                    $validator->errors()->add('password', __('validation.min.string', [
                        'attribute' => 'password',
                        'min' => 4
                    ]));
                }
            }

            if(count($validator->errors()) > 0) {
                return redirect()->route('profile', [
                    'user' => $logged->id
                ])->withErrors($validator);
            }

            $user->save();
            return redirect()->route('profile')->with('success', 'Perfil atualizado com Sucesso!');

        }

        return redirect()->route('profile');
    }
}
