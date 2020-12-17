<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $user;

    public function __construct(){
        $this->user = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('admin.users.users', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.users.cadaster');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $campos = $request->only(['email', 'name', 'password', 'password_confirmation']);
        $validator = $this->validator($campos);

        $email = $request->input('email');
        $verifyEmailExists = User::where('email', $email)->first();

        if(!$verifyEmailExists){
            if($validator->fails()){
                return redirect()->route('cadaster_user')->withErrors($validator)->withInput();
            }else{
                $user = new User();
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->telephone = $request->input('telephone');
                $user->password = Hash::make($request->input('password'));
                $user->save();
                return redirect()->route('cadaster_user')->with('success', 'Usuário cadastrado com Sucesso!');
            }
            
        }else{
            return redirect()->route('cadaster_user')->with('warning', 'O email inserido está em uso.')->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        if(User::find($id)){
            $nome = $request->input('name');
            $telephone = $request->input('telephone');

            if(!empty($nome)){
                $user = User::find($id);
                $user->name = $nome;
                $user->telephone = $telephone;
                $user->save();
                
                return redirect()->route('edit', $id)->with('success', 'Usuário alterado com Sucesso!');
            }
        }else{
            return redirect()->route('users');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $user = User::find($id);
        if($user){
            User::destroy($id);
            return redirect()->route('users');
        }else{
            return redirect()->route('users');
        }
    }

    public function settings(){
        return view('admin.settings');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:500'],
            'email' => ['required', 'string', 'email', 'max:500', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }
}
