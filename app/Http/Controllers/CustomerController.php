<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
class CustomerController extends Controller
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
        return view('customer');
        
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
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);
        $customer = Customer::create([
            'name' => $request['name'],
            'gender' => $request['gender'], 
            'phone' => $request['phone'],
            'address' => $request['address']
        ]);
        return response()->json(['message' => "Customer', $customer->name save complated."]);
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
         $customer = Customer::find($id);
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
        // $customer = Customer::whereId($id)->findOrFail();

        
        // $customer->name = $request->name;
        // $customer->gender = $request->gender;
        // $customer->phone = $request->phone;
        // $customer->address = $request->address;
        // $customer->update();
        // return response()->json(['message' => 'Complate']);




      

        $this->validate($request,[
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return response()->json(['message' => 'Complate']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::destroy($id);
        return response()->json(['message' => 'complate']);
        // $customer = Customer::findOrfail($id);
        // $customer->delete();

      
    }

    public function getRow(){

        $customer = Customer::orderBy('id','desc')->paginate(5);
        //$customer = Customer::paginate(5);

        return $customer;
    }
}
