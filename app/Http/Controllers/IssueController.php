<?php

namespace App\Http\Controllers;
use App\Models\Issue;
use App\Models\Product;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function index(){
       $issues = Issue::join('products as p', 'p.id', 'issues.purchase_product')
       -> select([
        'issues.id as issue_id',
        'issues.free_issue_label as free_issue_label',
        'issues.type as type',
        'issues.free_product as free_product',
        'issues.purchase_quantity as purchase_quantity',
        'issues.free_quantity as free_quantity',
        'issues.lower_limit as lower_limit',
        'issues.upper_limit as upper_limit',
        'issues.purchase_product as product_id',
        'p.product_name as product_name'

       ])
       ->get();


        return view('issue.index', compact('issues'));
    }

    public function add(){
        $products = Product::all();
        return view('issue.add', compact('products'));

    }




        public function store(Request $request){

            $issue = new Issue() ;

            $issue-> free_issue_label = $request-> free_issue_label ;
            $issue-> type = $request-> type ;
            $issue-> purchase_product = $request-> product ;
            $issue-> free_product = $request-> free_product ;
            $issue-> purchase_quantity = $request-> purchase_quantity ;
            $issue-> free_quantity = $request-> free_quantity ;
            $issue-> lower_limit = $request-> lower_limit ;
            $issue-> upper_limit = $request-> upper_limit ;


            $issue-> save();
            return redirect()->route('issue.index');

            }



            public function edit($id){
                $issue = Issue::where('id',$id)->first();
                $products = Product::all();
              return view('issue.edit', compact('issue' , 'products'));

            }

            public function update(Request $request,$issue_id){

                // dd($request->all());
              $issue = Issue::where('id', $issue_id) ->first();

                $issue->free_issue_label = $request-> free_issue_label ;
                $issue->type = $request->type ;
                $issue->purchase_product = $request->product ;
                // $issue->free_product = $request->free_product ;
                $issue->purchase_quantity = $request->purchase_quantity ;
                $issue->free_quantity = $request->free_quantity ;
                $issue->lower_limit = $request->lower_limit ;
                $issue->upper_limit = $request->upper_limit ;



              $issue->save();

              return redirect() ->route('issue.index');
            }

            // public function edit($issue_id){
            //     $issue = Issue::where('id',$issue_id)->first();

            //     $products = Product::all();
            //   return view('issue.edit', compact('issue' , 'products'));


            // }

            // public function update(Request $request){

            //     $issue_id = $request->input('issue_id');
            //   $issue = Issue::where('id', $issue_id) ->first();

            // // dd($request->all());

            // try {
            //     $issue = Issue::findOrFail($issue_id);
            // } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            //     return redirect()->back()->withErrors(['error' => 'Issue not found!']);
            // }

            //   $issue-> free_issue_label = $request-> free_issue_label ;
            //   $issue-> type = $request-> type ;
            //   $issue-> purchase_product = $request-> product ;
            //   $issue-> free_product = $request-> free_product ;
            //   $issue-> purchase_quantity = $request-> purchase_quantity ;
            //   $issue-> free_quantity = $request-> free_quantity ;
            //   $issue-> lower_limit = $request-> lower_limit ;
            //   $issue-> upper_limit = $request-> upper_limit ;

            //   $issue->save();

            //   return redirect() ->route('issue.index');
            // }

//             public function show( $issue_id){

//         $issues = Issue::join('products as p', 'p.id', 'issues.product')
//         -> select([

//         'issues.id as issue_id',
//         'issues.free_issue_label as free_issue_label',
//         'issues.type as type',
//         'issues.free_product as free_product',
//         'issues.purchase_quantity as purchase_quantity',
//         'issues.free_quantity as free_quantity',
//         'issues.lower_limit as lower_limit',
//         'issues.upper_limit as upper_limit',
//         'issues.purchase_product as product_id',
//         'p.product_name as product_name'
//         ])
//         ->first();

//         return view('issue.show', compact('issues'));
//  }



// public function show( $id)
//     {
//         $issues = Issue::join('products as p', 'p.id', 'issues.product')
//         -> select([
//             'issues.id as issue_id',
//             'issues.free_issue_label as free_issue_label',
//             'issues.type as type',
//             'issues.free_product as free_product',
//             'issues.purchase_quantity as purchase_quantity',
//             'issues.free_quantity as free_quantity',
//             'issues.lower_limit as lower_limit',
//             'issues.upper_limit as upper_limit',
//             'issues.purchase_product as product_id',
//             'p.product_name as product_name'
//         ])
//         // ->first();

//         ->where('issues.id', $id) // Ensure you are filtering by the correct issue ID
//         ->first();


//         return view('issue.show', compact('issues'));

//  }



public function show($id)
{
    $issues = Issue::join('products as p', 'p.id', '=', 'issues.purchase_product') // Correct column name here
        ->select([
            'issues.id as issue_id',
            'issues.free_issue_label as free_issue_label',
            'issues.type as type',
            'issues.free_product as free_product',
            'issues.purchase_quantity as purchase_quantity',
            'issues.free_quantity as free_quantity',
            'issues.lower_limit as lower_limit',
            'issues.upper_limit as upper_limit',
            'issues.purchase_product as product_id',
            'p.product_name as product_name'
        ])
        ->where('issues.id', $id) // Ensure you are filtering by the correct issue ID
        ->first();

    return view('issue.show', compact('issues'));
}


}
