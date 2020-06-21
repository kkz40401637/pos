<?php

namespace App\Http\Controllers\Food;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Food\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        // return view('food.product',['prods' =>Category::all()]);
        return view('food.category');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'name_kh' => 'required',
            'dsc' => 'required',
        ]);
        $category = Category::create([
            'name' => $request['name'],
            'name_kh' => $request['name_kh'],
            'dsc' => $request['dsc']
        ]);
        return response()->json(['message' => "Category', $customer->name save complated."]);
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
        $category = Category::find($id);
        return response()->json(['message' => 'Complate']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'name' => 'required',
            'name_kh' => 'required',
            'dsc' => 'required',
        ]);
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return response()->json(['message' => 'Complate']);
       
    

        
        // $this->validate($request,[
        //     'name' => 'required|string|max:255',
        //     'phone' => 'required|string|max:255',
        //     'address' => 'required|string|max:255',
        // ]);

        // $customer = Customer::findOrFail($id);
        // $customer->update($request->all());

        // return response()->json(['message' => 'Complate']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
        return response()->json(['message' => 'complate']);
    }
    public function getRow(){

        $category = Category::orderBy('id','desc')->paginate(5);
        return $category;
    }
}
