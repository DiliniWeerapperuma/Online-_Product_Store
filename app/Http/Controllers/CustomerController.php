<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::all();
        return view('customer.index', compact('customers'));

}


public function add(){

    $customer = 'C' . str_pad(Customer::max('id') + 1, 2, '0', STR_PAD_LEFT);


    return view('customer.add', compact('customer'));
}

public function store(Request $request){

    // dd($request->all());
    $customer = new Customer() ;

    $customer-> customer_name = $request-> customer_name ;
    $customer-> customer_code = $request-> customer_code ;
    $customer-> customer_address = $request-> customer_address ;
    $customer-> customer_contact = $request-> customer_contact ;

    $customer-> save();

    return redirect()->route('customer.index');

 }

 public function edit($id){
    $customer = Customer::where('id',$id)->first();
  return view('customer.edit', compact('customer'));

}

public function update(Request $request,$customer_id){
    $customer = Customer::where('id', $customer_id) ->first();
    $customer-> customer_name = $request->customer_name;
    $customer-> customer_code = $request->customer_code;
    $customer-> customer_address = $request->customer_address;
    $customer-> customer_contact = $request->customer_contact;



    $customer->save();

    return redirect() ->route('customer.index');
  }


  public function show( $id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.show', compact('customer'));


        return redirect() ->route('customer.index');
 }






}
