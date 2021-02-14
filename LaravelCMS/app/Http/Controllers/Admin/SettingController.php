<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('can:edit-setting');
    }

    public function index(){
        $settingsAll = Setting::all();

        foreach($settingsAll as $values){
            $setting[$values->name] = $values->content;
        }
    
        return view('admin.settings.index', [
            'setting' => $setting
        ]);
    }

    public function save(Request $request){
        $data = $request->only(['title', 'subtitle', 'email', 'bgcolor', 'textcolor']);

        $validator = $this->validator($data);

        if($validator->fails() > 0){
            return redirect()->route('settings')
                ->withErrors($validator);
        }
        
        $selectAll = Setting::all();

        foreach($data as $item => $values){ 
            if(count($selectAll) == 0){
                $setting = new Setting();
                $setting->name = $item;
                $setting->content = $values;
                $setting->save();
            }else{
                Setting::where('name', $item)
                    ->update([
                        'content' => $values
                    ]);
            }
        }
        
        return redirect()->route('settings')->with('success', 'As configurações do site foram alteradas com Sucesso!');
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'title' => ['string', 'max: 100'],
            'subtitle' => ['string', 'max: 100'],
            'email' => ['string', 'max: 100'],
            'bgcolor' => ['string', 'max: 100'],
            'textcolor' => ['string', 'max: 100']
        ]);
    }


    

}
