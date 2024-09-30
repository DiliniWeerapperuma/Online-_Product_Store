<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('product.index', compact('products'));

}


public function add(){

    $product = 'P' . str_pad(Product::max('id') + 1, 2, '0', STR_PAD_LEFT);


    return view('product.add', compact('product'));
}

public function store(Request $request){

    // dd($request->all());
    $product = new Product() ;

    $product-> product_name = $request-> product_name ;
    $product-> product_code = $request-> product_code ;
    $product-> price = $request-> price ;
    $product-> discount = $request-> discount ;
    $product-> expiry_date = $request-> expiry_date ;
    $product-> save();

    return redirect()->route('product.index');

 }

 public function edit($id){
    $product = Product::where('id',$id)->first();
  return view('product.edit', compact('product'));

}

public function update(Request $request,$product_id){
    $product = Product::where('id', $product_id) ->first();
    $product-> product_name = $request->product_name;
    $product-> product_code = $request->product_code;
    $product-> price = $request->price;
    $product-> discount = $request-> discount ;
    $product-> expiry_date = $request->expiry_date;


    $product->save();

    return redirect() ->route('product.index');
  }


  public function show( $id)
    {
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));


        return redirect() ->route('product.index');
 }






}
