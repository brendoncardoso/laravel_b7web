<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Visitor;
use App\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $pagePie = [];

        $days = intval($request->input('days'));

        $dateLimit5Minutes = date('Y-m-d H:i:s', strtotime('-5 minutes'));

        if($request->days > 120){
            $days = 120;
        }

        if($days != ""){
            // 0. Seta o Limite de Dias, Horas e Minutos.
            $dateLimit = date('Y-m-d H:i:s', strtotime("-".$days." days"));
        }else{
            // 0. Seta o Limite de Dias, Horas e Minutos.
            $dateLimit = date('Y-m-d H:i:s', strtotime('-5 minutes'));
        }

        // 1. Visitas no Total.
        $visitorsCount = Visitor::select()->where('data_access', '>=' ,$dateLimit)->count();

        // 3. Lista de Visitas no Graphic.
        $graphicVisitor = Visitor::selectRaw('page, COUNT(page) as visitors')->where('data_access', '>=', $dateLimit)->groupBy('page')->get();

        foreach($graphicVisitor as $item => $values){
            $pagePie[$values->page] = $values->visitors;
        }
        
        $pageLabels = \json_encode(array_keys($pagePie));
        $pageValues = \json_encode(array_values($pagePie));

        return view('admin.home', [
            'visitorsCount' => $visitorsCount,
            'pagesCount' => Page::count(),
            'usersCount' => User::count(),
            'onlineCount' => Visitor::select()->where('data_access', '>=', $dateLimit5Minutes)->groupBy('ip')->count(),
            'pageLabels' => $pageLabels,
            'pageValues' => $pageValues
        ]);
    }
}
