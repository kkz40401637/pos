<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food\Category;
use App\POS\Table;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       $cate = Category::select('id', \DB::raw('concat(name, "-" , name_kh) as text'))->get();
       $tabl = Table::select('id', 'name as text')->get();
       return view('home', ['category' => $cate, 'table' => $tabl]);
    }
}
